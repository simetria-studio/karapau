<?php

namespace App\Http\Controllers\Auth;

use App\Models\Porto;
use App\Models\Pescador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PescadorRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portos = Porto::all();
        return view('auth.pescador.registro', compact('portos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = Pescador::create([
            'name'              => $request->name,
            'lastname'          => $request->lastname,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'telefone'          => $request->ddd_telemovel.' '.$request->telemovel,
            'nif'               => $request->nif,
            'iban'              => $request->iban,
            'porto'             => $request->porto,
            'nome_embarcacao'   => $request->nome_embarcacao_1,
            'nome_embarcacao2'  => $request->nome_embarcacao_2 ?? null,
            'nome_embarcacao3'  => $request->nome_embarcacao_3 ?? null,
            'codigo_postal'     => $request->codigo_postal,
            'morada'            => $request->morada,
            'regiao'            => $request->regiao,
            'porta'             => $request->porta,
            'distrito'          => $request->distrito,
            'conselho'          => $request->conselho,
            'freguesia'         => $request->freguesia,
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude,
            'nome_embarcacao3'  => $request->nome_embarcacao3,
        ]);

        return redirect()->route('pescador.successo');
    }

    public function successo()
    {
        return view('auth.pescador.registro-okay');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
