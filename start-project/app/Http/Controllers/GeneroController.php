<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Genero;
use App\Models\Autor;

class GeneroController extends Controller
{
    private $regras = 
    [
        'nome' => 'required|max:100|min:3|unique:generos',
    ];

    private $msgs = 
    [
        "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
        "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        "unique" => "Já existe um endereço cadastrado com esse [:attribute]!"
    ];    
  
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
        $request->validate($this->regras,$this->msgs);
        $genero = new Genero();
        $genero->nome = $request->nome;
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
        $genero = Genero::find($id);

        if(isset($genero))
        {
            $genero->nome = $request -> nome;
            $genero->save();

            return redirect()->route('genero.index');
        }

        return "<h1>Genero não encontrado!!!</h1>";
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
