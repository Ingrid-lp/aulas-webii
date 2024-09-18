<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneroController extends Controller
{
  
    public function index()
    {
        $data = Genero::with('livro')->get();

        return view('genero.index', compact(['data']));
    }

    public function create()
    {
        return view('genero.create');
    }

    public function store(Request $request)
    {
        $genero = new Genero();
        $genero->name = $request->name;
        $genero->save();

        return redirect()->route('genero.index');
    }

    public function show($id)
    {
        $genero = Genero::find($id);

        if(isset($genero))
        {
            return view('genero.show', compact('genero'));
        }

        return "<h1>GENERO NÂO ENCONTRADO</h1>";
    }

    public function edit($id)
    {
        $genero = Genero:: find($id);

        if(isset($genero))
        {
            return view('genero.edit', compact('genero'));
        }

        return '<h1>GENERO NÂO ENCONTRADO</h1>';
    }

    public function update(Request $request, $id)
    {
        $editora = Editora::find($id);

        if(isset($editora))
        {
            $editora->nome = $request -> nome;
            $editora->save();

            return redirect()->route('editora.index');
        }

        return "<h1>Autor não encontrado!!!</h1>";
    }

    public function destroy($id)
    {
        $genero = Genero:: find($id);

        if(isset($genero))
        {
            $genero -> delete();

            return redirect() -> route('genero.index');
        }

        return '<h1>GENERO NÃO ENCONTRADO</h1>';
    }
}
