<div class="row bg-dark w-50 my-4 mx-auto">
    @foreach ($products as $product)
        <div class="col-md-6 d-flex flex-column align-items-center fs-5 mb-5">
            <img src="/images/{{$product->imagem}}" class="mt-3">
            <span class="my-3">{{$product->nome}} - R$ {{$product->preco}}</span>
        
            @if (Route::currentRouteName() == 'admin.index')
                <a href="{{route('admin.edit',$product->id)}}" class="bg-primary text-white fs-5 p-1 rounded text-decoration-none">Editar</a>
            @else
                <form action="{{route('home.add')}}" method="POST" class="w-25 d-flex flex-column">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="number" name="qtd" min="1" max="15" value="1">
                    <button type="submit" class="bg-success text-white mt-2 rounded border border-0">Adicionar</button>
                </form>
            @endif
        </div>
        @endforeach

        @if (!isset($_GET['busca']))
            <div class="d-flex justify-content-center">{{$products->links()}}</div>    
        @endif
</div>