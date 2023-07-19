@extends('layouts.app')

@section('content')
<div class="text-white text-center mb-5">
    <h1 class="mb-3">Escolha produtos e adicione no seu carrinho</h1>
    <form class="mb-4">
        <label class="fs-4">Pesquise um produto</label><br>
        <input name="busca" type="text" class="w-25">
        <button class="bg-dark text-white p-1 border border-0">Pesquisar</button>
    </form>
    @isset($_GET['busca'])
        <a class="bg-success text-decoration-none text-white fs-5 p-2 rounded"href="{{route('home')}}">Ver todos os produtos</a>
    @endisset
</div>

<div class="produtos bg-dark rounded mx-auto">
    @foreach ($produtos as $produto)
        <div class="produto mt-5">
            <img src="/imagens/{{$produto->imagem}}" class="imagem mb-3"><br>
            <span class="text-white">{{$produto->nome}} - R$ {{$produto->preco}}</span><br>

            <form action="{{route('home.add')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$produto->id}}">
                <input type="number" name="qtd" id="" min="1" max="15" value="1"><br>
                <button type="submit" class="bg-success rounded my-3 border border-0 fs-5 text-white">Adicionar</button>
            </form>
        </div>
        @endforeach
</div>
<div class="mx-auto mt-5 mb-3 text-center">
    <a href="{{route('carrinho')}}" class="bg-danger text-white fs-5 p-2 rounded text-decoration-none">Ir para o carrinho</a>
</div>
@endsection
