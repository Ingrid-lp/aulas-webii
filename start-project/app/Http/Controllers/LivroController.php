<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Editora;

class LivroController extends Controller
{
    
    public function index()
    {
        $data = Livro::with('autor')->get();
        return view('livro.index', compact('data'));
    }

    public function create()
    {
        $autors = Autor::orderBy('name')->get();
        return view('livro.create', compact('autors'));
    }

    public function store(Request $request)
    {
        $autor = Autor::find($request->autor);

        if(isset($autor))
        {
            $livro = new Livro();
            $livro->nome = mb_strtoupper($request->nome, 'UTF-8');
            $livro->pais= mb_strtoupper($request->pais, 'UTF-8');
            $livro->autor()->associate($autor);
            //$livro->editora()->associate($editora);
            $livro->save();

            return redirect()->route('livro.index');
        }
        return "<h1>Autor não encontrado!!!</h1>";
    }

    public function show($id)
    {
        $livro = Livro::find($id);

        if(isset($livro))
        {
            return view('livro.show', compact('livro'));
        }

        return "<h1>Livro não encontrado!!!</h1>";
    }

    public function edit($id)
    {
        $livro = Livro::find($id);
        $autors = Autor::orderBy('name')->get();

        if(isset($livro))
        {
            return view('livro.edit', compact(['livro', 'autors']));
        }
    }

    public function update(Request $request, $id)
    {
        $livro = Livro::find($id);
        $autor = Autor::find($request->autor);

        if(isset($autor) && isset($livro))
        {
            $livro->nome = mb_strtoupper($request->nome, 'UTF-8');
            $livro->pais= mb_strtoupper($request->pais, 'UTF-8');
            $livro->autor()->associate($autor);
            $livro->save();

            return redirect()->route('livro.index');
        }
        return "<h1>Autor não encontrado!!!</h1>";
    }

    public function destroy($id)
    {
        $livro = Livro::find($id);

        if(isset($livro))
        {
            $livro->delete();
            return redirect()->route('livro.index');
        }

        return "<h1>Livro não encontrado!!!</h1>";
    }
}
