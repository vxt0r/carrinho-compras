<form action="{{route('pedido.confirmar')}}" method="POST" class="w-25 d-flex flex-column mx-auto">
    @csrf
    <input type="hidden" name="total" value="{{$total}}"">
    <select name="forma-pagamento" class="rounded my-2 border border-0">
        <option value="Cartão de Crédito">Cartão de Crédito</option>
        <option value="Boleto">Boleto</option>
        <option value="Pix">Pix</option>
    </select>
    <button type="submit" class="bg-success text-white my-3 border border-0 rounded">Confirmar</button>
</form>
<a href="{{route('carrinho')}}" class="bg-danger p-2 rounded text-center text-white mx-auto mt-5 text-decoration-none">Cancelar</a>