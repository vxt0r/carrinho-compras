@php
    $subtotal = 0;
    $total = 0;
    $cart_product = $cart->carrinhoProdutos
@endphp

<div class="bg-dark p-3">
    @forelse ($cart->produto as $i=>$item)
    <div class="cart row d-flex justify-content-center mx-auto mb-5">
        <span class="col-sm-12 col-md-9">{{$item->nome}} - R$ {{$item->preco}} - Quantidade : {{$cart_product[$i]->qtd}}</span>        
        <a href="{{route('carrinho.remove',['id'=>$cart_product[$i]->id])}}" class="col-sm-3 bg-danger text-white text-decoration-none p-1 rounded">Remover</a>
    </div>

    @php
        $subtotal = (float)$item->preco * (int)$cart_product[$i]->qtd;
        $total += $subtotal;
    @endphp

    @empty
        <p class="my-auto text-center">Seu carrinho está vazio. Adicione um produto</p>
    @endforelse

    @if (isset($_GET['finalizar']))
        <span class="mx-auto mt-5">Total : R$ {{$total}}</span>
        @component('_components.checkout_form',['total'=>$total]) @endcomponent

    @elseif ($total != 0)
        <span class="mx-auto mt-5 bg-success rounded p-2">
            <a href="{{route('carrinho.finalizar')}}" class="text-white text-decoration-none">Finalizar Compra</a>
        </span>
    @endif
</div>