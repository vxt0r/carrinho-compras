@extends('layouts.app')

@section('content')
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
<div class="mx-auto mt-4 text-center">
    <a href="{{route('carrinho')}}" class="text-white">Voltar para a página inicial</a>
</div>
@endsection
