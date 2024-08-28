<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $eixo = Eixo:: find($id);

        if(isset($eixo))
        {
            $eixo -> name = $requerest -> name;
            $eixo -> description = $requerest -> description; 
            $eixo -> save();

            return redirect() -> route('eixo.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eixo = Eixo:: find($id);

        if(isset($eixo))
        {
            $eixo -> delete();

            return redirect() -> route('eixo.index');
        }

        return '<h1>EIXO NÂO ENCONTRADO</h1>';
    }
}
