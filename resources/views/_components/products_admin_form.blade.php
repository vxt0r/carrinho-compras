
@csrf
<label>Nome</label>
<span class="text-danger" >{{$errors->has('nome') ? $errors->first() : ''}}</span>
<input type="text" name="nome" value="{{ isset($product) ? $product->nome : '' }}" class="mb-3">

<label>Preço</label>
<span class="text-danger" >{{$errors->has('preco') ? $errors->first() : ''}}</span>
<input type="text" name="preco" value="{{ isset($product) ? $product->preco : '' }}" class="mb-3">

<label for="file" class="label-file bg-warning text-dark rounded p-1" role="button" tabindex="0">Imagem</label>
<span class="text-danger">{{$errors->has('imagem') ? $errors->first() : ''}}</span>
<input type="file" name="imagem" id="file" class="input-file d-none">

<button type="submit" class="bg-success rounded my-3 text-white border border-0">{{$btn}}</button>


