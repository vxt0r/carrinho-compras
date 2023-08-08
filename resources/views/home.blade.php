@extends('layouts.app')

@section('content')

    @if (Route::currentRouteName() == 'home')
        <h1>Escolha produtos e adicione no seu carrinho</h1>
    @endif

    @component('_components.search_form') @endcomponent

    @isset($_GET['busca'])
        <a href="{{route('home')}}" class="bg-dark text-white p-1 rounded text-decoration-none">Ver todos os produtos</a>
    @endisset

    @if (Route::currentRouteName() == 'admin.index')
        <a href="{{ route('admin.create')}}" class="bg-success text-white p-1 rounded text-decoration-none">Adicionar Produto</a>    
    @endif

    @component('_components.products',['products'=>$products]) @endcomponent

    @if (Route::currentRouteName() == 'home')
    <a href="{{route('carrinho')}}" class="bg-primary text-white p-1 rounded text-decoration-none">Ir para o carrinho</a>
    @endif

@endsection
