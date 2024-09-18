<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Editora;
use App\Models\Autor;

class EditoraController extends Controller
{
    private $regras = 
    [
        'nome' => 'required|max:100|min:3|unique:editoras',
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
        $data = Editora::with('livro')->get();
        return view('editora.index', compact(['data']));
    }

    public function create()
    {
        return view('editora.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->regras,$this->msgs);
        $editora = new Editora();
        $editora->nome = $request->nome;
        $editora->save();

        return redirect()->route('editora.index');
    }

    public function show($id)
    {
        $editora = Editora::find($id);

        if(isset($editora))
        {
            return view('editora.show', compact('editora'));
        }

        return "<h1>EDITORA NÂO ENCONTRADO</h1>";
    }

    public function edit($id)
    {
        $editora = Editora:: find($id);

        if(isset($editora))
        {
            return view('editora.edit', compact('editora'));
        }

        return '<h1>EDITORA NÂO ENCONTRADO</h1>';
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
        $editora = Editora:: find($id);

        if(isset($editora))
        {
            $editora -> delete();

            return redirect() -> route('editora.index');
        }

        return '<h1>EDITORA NÃO ENCONTRADO</h1>';
    }
}
