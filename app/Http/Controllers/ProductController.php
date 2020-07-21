<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $request;
    protected $repository;

    public function __construct(Request $request, Product $product)
    {

        // dd($request);
        $this->request = $request;
        $this->repository = $product;
        //$this->middleware('auth')->only(['create','destroy','edit']);
        //$this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     * Exiba uma lista do recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$products = Product::all();
        $products = Product::paginate(15);
        //$products = Product::get();
        //$products = Product::all('name','price');

        return view('admin.pages.products.index', [
            'products' => $products,]);
    }

    /**
     * Show the form for creating a new resource.
     * Mostre o formulário para criar um novo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     * Armazene um recurso recém-criado no armazenamento.
     *
     * @param  App\Http\Requests\StoreUpdateProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {
        /*
        $request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'nullable|min:3|max:10000',
            'photo' => 'required|image',
        ]);
        */

        $data = $request->only('name','description','price');
        //$data = $request->all();

        //$product = Product::create($data);
        //Product::create($data);

        if($request->hasFile('image') && $request->image->isValid()) {
            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        }

        $this->repository->create($data);

        return redirect()->route('products.index');

        //dd('OK');

        //dd($request->all());
        //dd($request->name);
        //dd($request->only(['name', 'description']));
        //dd($request->input('name', 'default'));
        //dd($request->except('_token'));
        if ($request->file('photo')->isValid()) {
            //dd($request->photo->getclientoriginalname());
            $nameFile = $request->name . '.' . $request->photo->extension();
            dd($request->file('photo')->storeAs('products', $nameFile));
        }
    }

    /**
     * Display the specified resource.
     * Exibe o recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$product = Product::where('id', $id)->first();
        //$product = Product::find($id);

        //if (!$product = Product::find($id)) {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }
        //dd($product);

        return view('admin.pages.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * Mostre o formulário para editar o recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return 'teste';
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }
        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     * Atualize o recurso especificado no armazenamento.
     *
     * @param  App\Http\Requests\StoreUpdateProductRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {
        if (!$product = $this->repository->find($id))
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {

            if($product->image && Storage::exists($product->image)){
                Storage::delete($product->image);
            }


            $imagePath = $request->image->store('products');
            $data['image'] = $imagePath;
        }

        //$product->update($request->all());
        $product->update($data);

        //dd("Editando o produto {{$id}}");
        return redirect()-> route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     * Remova o recurso especificado do armazenamento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->repository->where('id', $id)->first();
        if (!$product) {
            return redirect()->back();
        }

        if($product->image && Storage::exists($product->image)){
            Storage::delete($product->image);
        }

        //dd($product);

        //dd("Deletando o registro do produto $id");
        $product->delete();

        return redirect()-> route('products.index');
    }

    /**
     * Search Products
     */
    public function search(Request $request)
    {
        //dd($request->all());
        //$filters = $request->all();
        $filters = $request->except('_token');


        $products = $this->repository->search($request->filter);
        //dd($products);
        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => $filters,
        ]);
    }

}
