@extends('layouts.app')

@php
    $sub_total = 0;
    $total = 0;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white p-3">
                @forelse ($carrinho[0]->produto as $i=>$item)
                <div class="w-75 d-flex justify-content-between mx-auto mb-2">
                    <span class="fs-5">
                        {{$item->nome}} - R$ {{$item->preco}} - Quantidade : {{$carrinho[0]->carrinhoProdutos[$i]->qtd}}
                    </span>
                    
                    <a href="{{route('carrinho.remove',['id'=>$carrinho[0]->carrinhoProdutos[$i]->id])}}" 
                        class="bg-danger text-white text-decoration-none fs-5 p-1 rounded">
                        Remover
                    </a>
                </div>

                @php
                    $sub_total = (float)$item->preco * (int)$carrinho[0]->carrinhoProdutos[$i]->qtd;
                    $total += $sub_total;
                @endphp

                @empty
                    <p class="my-auto text-center fs-4">Seu carrinho está vazio. Adicione um produto</p>
                @endforelse

                @if (isset($_GET['finalizar']))
                    <span class="fs-5 mx-auto mt-5">Total : R$ {{$total}}</span>
                    @component('_components.form',['total'=>$total]) @endcomponent

                @elseif ($total != 0)
                    <span class="mx-auto mt-5 bg-success rounded p-2">
                        <a href="{{route('carrinho.finalizar')}}" class="text-white text-decoration-none">Finalizar Compra</a>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row w-25 mx-auto mt-4">
        <a href="{{route('home')}}" class="bg-dark p-1 fs-5 mb-3 text-center text-light rounded text-decoration-none">Voltar para a página inicial</a>
        <a href="{{route('carrinho.limpar',['id'=>$carrinho[0]->id])}}" class="bg-danger fs-5 p-1 text-center text-white rounded text-decoration-none">Limpar carrinho</a>
    </div>
</div>
@endsection