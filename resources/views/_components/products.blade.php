<div class="col-sm-8 row bg-dark my-4 mx-auto rounded">
    @foreach ($products as $product)
        <div class="col-md-6 d-flex flex-column align-items-center fs-5 mb-5">
            <img src="/images/{{$product->imagem}}" class="mt-3">
            <span class="my-3">{{$product->nome}} - R$ {{$product->preco}}</span>
        
            @if (Route::currentRouteName() == 'admin.index')
                <a href="{{route('admin.edit',$product->id)}}" class="bg-primary text-white fs-5 p-1 rounded text-decoration-none">Editar</a>
            @else
            <div class="col-sm-3 col-md-5 col-lg-3">
                <form action="{{route('home.add')}}" method="POST" class="d-flex flex-column">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="number" name="qtd" min="1" max="15" value="1" class="mb-2">
                    <button type="submit" class="btn btn-success text-white rounded border border-0">Adicionar</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach

        @if (!isset($_GET['busca']))
            <div class="d-flex justify-content-center">{{$products->links()}}</div>    
        @endif
</div>