@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">            
            @component('_components.cart_products',['cart'=>$cart]) @endcomponent
        </div>
    </div>

    <div class="w-25 links row mx-auto mt-4">
        <a href="{{route('home')}}" class="bg-dark p-1 mb-3 text-center text-light rounded text-decoration-none">Voltar para a página inicial</a>
        <a href="{{route('carrinho.limpar',['id'=>$cart->id])}}" class="bg-dark p-1 text-center text-white rounded text-decoration-none">Limpar carrinho</a>
    </div>
</div>
@endsection