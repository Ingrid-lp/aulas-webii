@extends('templates.main')

@section('content')


    <label class="mt-3">Nome</label>
    <input type="text" name="name" class="form-control" value="{{$eixo->name}}" disabled/>
    <label class="mt-3">Descrição</label>
    <textarea name="description" rows="5" class="form-control mt-1" disabled>
        {{$eixo -> description}}
    </textarea>

    <ul class="list-group mt-2">
        <li class="list-group-item active" aria-current="true">CURSOS DE {{$eixo->name}}</li>

        @foreach($eixo->curso as $item)
            <li class="list-group-item">{{$item->nome}}</li>
        @endforeach
    </ul>

    <a href="{{route('eixo.index')}}" class="btn btn-secondary mt-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
        </svg>
    </a>    


@endsection