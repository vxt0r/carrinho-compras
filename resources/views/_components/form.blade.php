<form action="{{route('pedido')}}" method="POST" class="d-flex flex-column mx-auto">
    @csrf
    <input type="hidden" name="total" value="{{$total}}"">
    <select name="forma-pagamento" class="fs-5 rounded my-2 border border-0">
        <option value="Cartão de Crédito">Cartão de Crédito</option>
        <option value="Boleto">Boleto</option>
        <option value="Pix">Pix</option>
    </select>
    <button type="submit" class="mt-2 border border-0 rounded bg-success">Confirmar</button>
</form>
<a href="{{route('carrinho')}}" class="text-center text-danger mt-5">Cancelar</a>