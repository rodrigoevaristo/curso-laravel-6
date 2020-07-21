@extends('admin.layouts.app')

@section('title', "Detalhes do produto {$product->name}")

@section('content')

<h1>Produto {{ $product->name}}</h1>
<a href="{{ route('products.index')}}">Voltar</a>

<ul class="list-group">
    <li class="list-group-item"><strong>Nome:</strong> {{ $product->name}}</li>
    <li class="list-group-item"><strong>Preço:</strong> {{ $product->price}}</li>
    <li class="list-group-item"><strong>Descrição:</strong> {{ $product->description}}</li>
</ul>

<form action="{{ route('products.destroy', $product->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="bt btn-danger">Deletar o produto: {{ $product->name}}</button>
</form>

@endsection
