@extends('templates.main')

@section('content')

<form action="{{route('eixo.update', $eixo->id)}}" method="POST">
    @csrf
    @method('PUT')
    <label class="mt-3">Nome</label>
    <input type="text" name="nome" class="form-control" value="{{$eixo->nome}}"/> 
    <label class="mt-3">Descricao</label>
    <input type="text" name="descricao" class="form-control" value="{{$eixo->descricao}}"/>

<input type="submit" value="Alterar" class="btn btn-danger mt-1">
</from>

@endsection