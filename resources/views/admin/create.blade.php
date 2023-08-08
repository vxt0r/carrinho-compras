@extends('layouts.app')

@php
    $btn = 'Adicionar'
@endphp

@section('content')
<div class="w-50 bg-dark rounded mx-auto d-flex justify-content-center">
    <form method="POST" action="{{route('admin.store')}}" class="d-flex flex-column align-items-center p-4" enctype="multipart/form-data">
        @component('_components.products_admin_form',['btn'=>$btn])
            
        @endcomponent
    </form>
</div>
<script src="{{asset('js/script.js')}}"></script>
@endsection