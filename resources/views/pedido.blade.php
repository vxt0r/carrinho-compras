@extends('layouts.app')

@section('content')
<h3 class="text-center text-white">Seu pedido foi realizado com sucesso. Parabéns pela compra !</h3>
<ul class="fs-5 bg-light w-50 mx-auto rounded mt-3 list-unstyled p-2">
    @foreach ($carrinho[0]->produto as $i=>$item)
        <li>
            {{$item->nome}} - R$ {{$item->preco}} - Quantidade : {{$carrinho[0]->carrinhoProdutos[$i]->qtd}}
            Sub-total : R$ {{$item->preco * $carrinho[0]->carrinhoProdutos[$i]->qtd}}
        </li>
    @endforeach
    <li>Total : R$ {{$dados['total']}}</li>
    <li>{{$dados['forma-pagamento']}}</li>
    <li>{{$carrinho[0]->user->name}}</li>
</ul>

<div class="mx-auto mt-4 text-center">
    <a href="{{route('carrinho.limpar',['id'=> $carrinho[0]->id])}}" class="bg-dark p-2 fs-4 text-light rounded text-decoration-none">Voltar para o carrinho</a>
</div>
@endsection