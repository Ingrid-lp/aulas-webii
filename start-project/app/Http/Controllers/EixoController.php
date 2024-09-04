<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;
use App\Models\Curso;
use Dompdf\Dompdf;

class EixoController extends Controller
{

    public function index()
    {
        $data = Eixo::with('curso')->get();

        return view('eixo.index', compact(['data']));
    }


    public function create()
    {
        return view('eixo.create');
    }

    public function store(Request $request)
    {
        $eixo = new Eixo();
        $eixo->name = $request->name;
        $eixo->description = $request->description;
        $eixo->save();

        return redirect()->route('eixo.index');
    }

    public function show($id)
    {
        $eixo = Eixo::find($id);

        if(isset($eixo))
        {
            return view('eixo.show', compact('eixo'));
        }

        return "<h1>EIXO NÂO ENCONTRADO</h1>";
    }

    public function edit($id)
    {
        $eixo = Eixo:: find($id);

        if(isset($eixo))
        {
            return view('eixo.edit', compact('eixo'));
        }

    return '<h1>EIXO NÂO ENCONTRADO</h1>';

    }

    public function update(Request $request, $id)
    {
        $eixo = Eixo::find($id);

        if(isset($eixo))
        {
            $eixo->name = $request -> nome;
            $eixo->description = $request -> descricao; 
            $eixo->save();

            return redirect()->route('eixo.index');
        }

        return "<h1>Eixo não encontrado!!!</h1>";
    }

    public function destroy($id)
    {
        $eixo = Eixo:: find($id);

        if(isset($eixo))
        {
            $eixo -> delete();

            return redirect() -> route('eixo.index');
        }

        return '<h1>EIXO NÃO ENCONTRADO</h1>';
    }

    public function report($id)
    {
        $cursos = Curso::where('eixo_id', $id)->get();

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('eixo.report', compact('cursos')));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("relatorio-horas-turma.pdf", array("Attachment" => false));
    }

    public function graph()
    {
        
    }
}
