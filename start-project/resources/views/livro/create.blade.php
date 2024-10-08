@extends('templates.main')

@section('content')

<form action="{{route('livro.store')}}" method="POST">
    @csrf
    <label class="mt-3">Nome</label>
    <input type="text" name="nome" class="form-control"/> 
    <label class="mt-3">Pais</label>
    <input type="text" name="pais" class="form-control"/>
    <label class="mt-3">Autor</label>
    <select name="autor" class="form-control">
        <option selected disabled></option>
        @foreach ($autors as $item)
            <option value="{{$item->id}}">{{ $item->name }}</option>
        @endforeach
    </select>

        <label class="mt-3">Editora</label>
    <select name="editora" class="form-control">
        <option selected disabled></option>
        @foreach ($editoras as $item)
            <option value="{{$item->id}}">{{ $item->nome }}</option>
        @endforeach
    </select>
    
        <label class="mt-3">Genero</label>
    <select name="genero" class="form-control">
        <option selected disabled></option>
        @foreach ($generos as $item)
            <option value="{{$item->id}}">{{ $item->nome }}</option>
        @endforeach
    </select>
    <a href="{{route('livro.index')}}" class="btn btn-secondary mt-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
        </svg>
    </a>   

<input type="submit" value="Salvar" class="btn btn-danger mt-2">
</from>

@endsection