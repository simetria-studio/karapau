<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tamanho;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TamanhosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tamanhos = Tamanho::orderBy('created_at', 'desc')->paginate(15);
        return view('painel.pages.tamanho.index', compact('tamanhos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.pages.tamanho.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save = Tamanho::create($request->all());

        return redirect()->route('admin.tamanhos')->with('success', "criado com sucesso!");;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tamanho = Tamanho::find($id);
        return view('painel.pages.tamanho.show', compact('tamanho'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $tamanho = Tamanho::find($id);
        $tamanho->name = $request->name;
        $tamanho->save();

        return redirect()->route('admin.tamanhos')->with('success', "Alterado com sucesso!");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tamanho = Tamanho::find($id);
        $tamanho->delete();
        return redirect()->route('admin.tamanhos')->with('success', "Deletado com sucesso!");;
    }
}
