<?php

namespace App\Http\Controllers\Auth;

use App\Models\Mails;
use App\Mail\AdminMail;
use App\Models\Comprador;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CompradorColetivo;
use App\Mail\CompradorColetivoMail;
use App\Http\Controllers\Controller;
use App\Models\BuyerColective;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CompradorColetivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.comprador-coletivo.create');
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
        // $validated = $request->validate([
        //     'email' => 'required',
        //     'nome' => 'required',
        // ]);

        $random = Str::random(9);
        $user = auth()->guard('consultor')->user()->id;
        $dados = $request->all();
      
        $comprador = Comprador::create([
            'user_id' => $user,
            'name' =>  $request->name,
            'lastname' => 'coletivo',
            'telemovel' => $request->ddd_telemovel_propietario.' '.$request->telemovel_propietario,
            'email' => $request->email,
            'password' => Hash::make($random),
            'codigo' =>  $random,
            'type' => 'coletivo',
        ]);

        $save = BuyerColective::create([
            'comprador_id' => $comprador->id,
            'name' =>  $request->name_empresa,
            'codigo_postal' => $request->codigo_postal,
            'morada' => $request->morada,
            'regiao' => $request->regiao,
            'distrito' => $request->distrito,
            'conselho' => $request->conselho,
            'freguesia' => $request->freguesia,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'porta' => $request->porta,
            'nif' => $request->nif,
            'contato' => $request->contato,
            'telefone' => $request->ddd_telefone_empresa.' '.$request->telefone_empresa,
            'telemovel_empresa' => $request->ddd_telemovel_empresa.' '.$request->telemovel_empresa,
            'tipo' => $request->tipo,
        ]);



        return redirect()->route('consultor.comprador-coletivo.informativo');
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

    public function coletivoInformativo()
    {
        return view('auth.comprador-coletivo.informativo');
    }
}
