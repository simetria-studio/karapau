<?php

namespace App\Http\Controllers\Auth;

use App\Models\Mails;
use App\Mail\AdminMail;
use App\Models\Comprador;
use App\Models\AdressBuyer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BuyerInduvidual;
use App\Models\CompradorIndividual;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompradorIndividualMail;

class CompradorIndividualController extends Controller
{

    public function index()
    {
        return view('auth.comprador-individual.create');
    }

    public function home()
    {
        return view('auth.comprador-individual.home-create');
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
        $validated = $request->validate([
            'email' => 'required|unique:comprador_individuals|max:255',

        ]);

        $random = Str::random(9);
        $user = auth()->guard('consultor')->user()->id;
        $dados = $request->all();
        $comprador = Comprador::create([
            'user_id' => $user ? $user : 26,
            'name' => $request->name,
            'lastname' => $request->sobrenome,
            'email' => $request->email,
            'password' => Hash::make($random),
            'telemovel' => $request->telemovel,
            'codigo' =>  $random,
            'type' => 'individual',
        ]);


        $save = BuyerInduvidual::create([
            'comprador_id' => $comprador->id,
            'morada' => $request->morada,
            'nif' => $request->nif,
        ]);

        $save = AdressBuyer::create([
            'user_id' => $comprador->id,
            'codigo_postal' => $request->codigo_postal,
            'morada' => $request->morada,
            'regiao' => $request->regiao,
            'distrito' => $request->distrito,
            'conselho' => $request->conselho,
            'freguesia' => $request->freguesia,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'porta' => $request->porta,
        ]);




        return redirect()->route('consultor.comprador-individual.informativo');
    }

    public function storeHome(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:comprador_individuals|max:255',

        ]);

        $random = Str::random(9);

        $dados = $request->all();
        $comprador = Comprador::create([
            'user_id' => 26,
            'name' => $request->name,
            'lastname' => $request->sobrenome,
            'email' => $request->email,
            'password' => Hash::make($random),
            'telemovel' => $request->telemovel,
            'codigo' =>  $random,
            'type' => 'individual',
        ]);

        $save = BuyerInduvidual::create([
            'comprador_id' => $comprador->id,
            'morada' => $request->morada,
            'nif' => $request->nif,
        ]);

        $save = AdressBuyer::create([
            'user_id' => $comprador->id,
            'codigo_postal' => $request->codigo_postal,
            'morada' => $request->morada,
            'regiao' => $request->regiao,
            'distrito' => $request->distrito,
            'conselho' => $request->conselho,
            'freguesia' => $request->freguesia,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'porta' => $request->porta,
        ]);


        return redirect()->route('store.login');
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

        $rules = [
            'name' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => 'confirmed',
        ];

        $customMessages = [
            'required' => 'Este campo e requerido, por favor preencha!',
            'confirmed' => 'As senhas não são iguais'
        ];
        $this->validate($request, $rules, $customMessages);

        $compradorDados['name'] = $request->name;
        $compradorDados['lastname'] = $request->lastname;
        $compradorDados['telemovel'] = $request->telemovel;
        if($request->password) $compradorDados['password'] = Hash::make($request->password);

        $comprador = Comprador::find($id)->update($compradorDados);

        return redirect()->back()->with('success', 'alterado com sucesso!');
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

    public function individualInformativo()
    {
        return view('auth.comprador-individual.informativo');
    }
}
