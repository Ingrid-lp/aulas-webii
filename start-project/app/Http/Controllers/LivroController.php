<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Editora;
use App\Models\Genero;

class LivroController extends Controller
{
    private $regras = 
    [
        'nome' => 'required|max:100|min:3|unique:livros',
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
        $data = Livro::with('autor')->get();
        $data = Livro::with('editora')->get();
        $data = Livro::with('genero')->get();
        return view('livro.index', compact('data'));
    }

    public function create()
    {
        $autors = Autor::orderBy('name')->get();
        $editoras = Editora::orderBy('nome')->get();
        $generos = Genero::orderBy('nome')->get();
        return view('livro.create', compact('autors', 'editoras', 'generos'));
    }

    public function store(Request $request)
    {
        $request->validate($this->regras,$this->msgs);
        $autor = Autor::find($request->autor);
        $editora = Editora::find($request->editora);
        $genero = Genero::find($request->genero);

        if(isset($autor))
        {
            $livro = new Livro();
            $livro->nome = mb_strtoupper($request->nome, 'UTF-8');
            $livro->pais= mb_strtoupper($request->pais, 'UTF-8');
            $livro->autor()->associate($autor);
            $livro->editora()->associate($editora);
            $livro->genero()->associate($genero);
            $livro->save();

            return redirect()->route('livro.index');
        }
        return "<h1>Livro não encontrado!!!</h1>";
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
        $editoras = Editora::orderBy('nome')->get();
        $generos = Genero::orderBy('nome')->get();

        if(isset($livro))
        {
            return view('livro.edit', compact(['livro', 'autors', 'editoras', 'generos']));
        }
    }

    public function update(Request $request, $id)
    {
        $livro = Livro::find($id);
        $autor = Autor::find($request->autor);
        $editora = Editora::find($request->editora);
        $genero = Genero::find($request->genero);

        if(isset($autor) && isset($livro) && isset($editora) && isset($genero))
        {
            $livro->nome = mb_strtoupper($request->nome, 'UTF-8');
            $livro->pais= mb_strtoupper($request->pais, 'UTF-8');
            $livro->autor()->associate($autor);
            $livro->editora()->associate($editora);
            $livro->genero()->associate($genero);
            $livro->save();

            return redirect()->route('livro.index');
        }
        return "<h1>Livro não encontrado!!!</h1>";
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
