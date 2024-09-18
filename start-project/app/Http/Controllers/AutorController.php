<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use App\Models\Livro;
use Dompdf\Dompdf;

class AutorController extends Controller
{

    private $regras = 
    [
        'name' => 'required|max:50|min:3|unique:autors',
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
        $data = Autor::with('livro')->get();

        return view('autor.index', compact(['data']));
    }

    public function create()
    {
        return view('autor.create');
    }

    public function store(Request $request)
    {
        $autor = new Autor();
        $autor->name = $request->name;
        $autor->save();

        return redirect()->route('autor.index');
    }

    public function show($id)
    {
        $autor = Autor::find($id);

        if(isset($autor))
        {
            return view('autor.show', compact('autor'));
        }

        return "<h1>AUTOR NÂO ENCONTRADO</h1>";
    }

    public function edit($id)
    {
        $autor = Autor:: find($id);

        if(isset($autor))
        {
            return view('autor.edit', compact('autor'));
        }

        return '<h1>AUTOR NÂO ENCONTRADO</h1>';
    }

    public function update(Request $request, $id)
    {
        $autor = Autor::find($id);

        if(isset($autor))
        {
            $autor->name = $request -> nome;
            $autor->save();

            return redirect()->route('autor.index');
        }

        return "<h1>Autor não encontrado!!!</h1>";
    }

    public function destroy($id)
    {
        $autor = Autor:: find($id);

        if(isset($autor))
        {
            $autor -> delete();

            return redirect() -> route('autor.index');
        }

        return '<h1>AUTOR NÃO ENCONTRADO</h1>';
    }

    public function report($id)
    {
        $livros = Livro::where('autor_id', $id)->get();

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('autor.report', compact('livros')));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Autor-Livro.pdf", array("Attachment" => false));
    }

    public function graph()
    {
        $autors = Autor::with('livro')->orderBy('name')->get();


        $data = [
            ["AUTOR", "NÚMERO DE LIVROS"]
        ];

        $cont = 1;
        foreach ($autors as $item) 
        {
            $data[$cont] = [
                $item->name, count($item->livro)
            ];

            $cont++;
        }

        //dd($data);
        $data = json_encode($data);

        return view('autor.graph', compact(['data']));
    }
}
