@extends('admin.layouts.app')

@section('title', 'Gestão de Produtos')

@section('content')
    <h1>Exibindo os produtos</h1>

    <a href="{{ route('products.create') }}">Cadastrar</a>
    <hr>

    <!-- Aula 25 - struturas de controle -->
    @if ($teste === '123')
        É igual
    @elseif($teste == 123)
        É igual numero 123
    @else
        É diferente
    @endif

    @unless($teste === '123')
        <P>unless para variavel $teste é falso, por isso está exibindo</P>
    @endunless

    @isset($teste2)
        <P>variavel $teste2 existe</P>
    @else
        <p>Variável $teste2 não existe ou não foi declarada</p>
    @endisset

    @empty($teste3)
        <p>Variável $teste3 está vazia</p>
        @else
            <p>Variável $teste3 não está vazia</p>
    @endempty

    <!--Verifica se está autenticado-->
    @auth
        Autenticado
        @else
            Não autenticado
    @endauth

    <!--Verifica se é convidado não autenticado -->
    @guest
        <p>Convidado não autenticado</p>
    @endguest

    @switch($teste)
        @case(1)
            Igual a 1
            @break
        @case(2)
            Igual a 2
        @case(12)
            Igual a 12
            @break
        @default
            valor default
    @endswitch

    <hr>
    <!-- Aula 26 - Estruturas de repetição Blade-->
    Usando foreach
    @if (isset($products))
        @foreach ($products as $product)
        <ul>
            <li class="@if ($loop->last) last @endif">{{ $product}}</li>
        </ul>
        <!-- <p>{{ $product}}</p>-->
        @endforeach
    @endif

    <hr>
    Usando forelse
    @forelse ($products as $product)
        <ul>
            <li class="@if ($loop->first) last @endif">{{ $product}}</li>
        </ul>
    @empty
        <p>Não existem produtos</p>
    @endforelse

@endsection

@push('styles')
    <style>
        .last {background: #CCC;}
    </style>
@endpush

<!-- Aula 27 - Includes, Components e Slots no Blade Laravel-->

@push('scripts')
    <script>document.body.style.background = '#f2efef'</script>
@endpush

@include('admin.includes.alerts', ['content'=> 'Alerta de preços de produtos'])
<hr>
