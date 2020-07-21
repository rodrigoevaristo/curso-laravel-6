@extends('admin.layouts.app')

@section('title', 'Cadastrar Novo Produto')

@section('content')
    <h1>Cadastrar novo produto</h1>

    <form action="{{ route('products.store')}}" method="post" enctype="multipart/form-data">
        @include('admin.pages.products._partials.form')
    </form>
@endsection
