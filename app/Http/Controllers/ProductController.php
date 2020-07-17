<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
       // dd($request);
        $this->request = $request;
        //$this->middleware('auth')->only(['create','destroy','edit']);
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     * Exiba uma lista do recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$teste = '<script>alert("Alerta!")</script>';
        $teste = 123;
        $teste2 = 123456;
        $teste3 = [];

        $products = ['TV','Geladeira','Fogão','Sofá','Micro-ondas'];

        //return view('teste', compact('teste') );
        return view('admin.pages.products.index', compact('teste','teste2','teste3','products'));
    }

    /**
     * Show the form for creating a new resource.
     * Mostre o formulário para criar um novo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Exibindo o formumário para criar um novo produto';
    }

    /**
     * Store a newly created resource in storage.
     * Armazene um recurso recém-criado no armazenamento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return "Detalhes do produto: {$id}";
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
        //
    }

    /**
     * Update the specified resource in storage.
     * Atualize o recurso especificado no armazenamento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        //
    }
}
