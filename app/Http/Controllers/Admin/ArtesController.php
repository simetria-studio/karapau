<?php

namespace App\Http\Controllers\Admin;

use App\Models\Arte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artes = Arte::orderBy('created_at', 'desc')->paginate(15);
        return view('painel.pages.artes.index', compact('artes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.pages.artes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save = Arte::create($request->all());

        return redirect()->route('admin.artes')->with('success', "criado com sucesso!");;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arte = Arte::find($id);
        return view('painel.pages.artes.show', compact('arte'));
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
        $arte = Arte::find($id);
        $arte->name = $request->name;
        $arte->save();

        return redirect()->route('admin.artes')->with('success', "Alterado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arte = Arte::find($id);
        $arte->delete();
        return redirect()->route('admin.artes')->with('success', "Deletado com sucesso!");
    }
}
