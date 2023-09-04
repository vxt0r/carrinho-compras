@extends('layouts.app')

@php
    $cart_product = $cart->carrinhoProdutos
@endphp

@section('content')
<h3 class="text-center">Seu pedido foi realizado com sucesso. Parabéns pela compra !</h3>
<ul class="order-ul w-50 bg-light text-dark text-start mx-auto rounded mt-3 list-unstyled p-2">
    @foreach ($cart->produto as $i=>$item)
        <li class="row order-list">
            <span class="col-sm-6">{{$item->nome}}</span>
            <span class="col-sm-6">R$ {{$item->preco}}</span>
            <span class="col-sm-6">Quantidade : {{$cart_product[$i]->qtd}}</span>
            <span class="col-sm-6">Sub-total : R$ {{$item->preco * $cart_product[$i]->qtd}}</span>
        </li>
        <br>
    @endforeach
    <li>Total : R$ {{$order['total']}}</li>
    <li>{{$order['forma-pagamento']}}</li>
    <li>{{$cart->user->name}}</li>
</ul>

<div class="mx-auto mt-4 text-center">
    <a href="{{route('carrinho.limpar',['id'=> $cart->id])}}" class="bg-dark p-2 fs-4 text-light rounded text-decoration-none">Voltar para o carrinho</a>
</div>
@endsection