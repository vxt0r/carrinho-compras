@extends('layouts.app')

@php
    $btn = 'Atualizar'
@endphp

@section('content')

<div class="admin-div bg-dark rounded mx-auto d-flex flex-column justify-content-center">
    <form action="{{route('admin.update',$product->id)}}" method="POST" class="d-flex flex-column align-items-center p-4" enctype="multipart/form-data">
        @method('PUT')
        @component('_components.products_admin_form',['btn'=>$btn,'product'=>$product])
            
        @endcomponent
    </form>
    
    <form action="{{route('admin.destroy',$product->id)}}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="bg-danger rounded my-3 text-white border border-0">Deletar Produto</button>
    </form>
</div>

<script src="{{asset('js/script.js')}}"></script>
@endsection