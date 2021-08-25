<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comprador;
use App\Models\AdressBuyer;
use Illuminate\Http\Request;
use App\Models\BuyerColective;
use App\Models\BuyerInduvidual;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {
        if(isset($_GET['email'])){
            $compradores = Comprador::where('email', 'like', '%'.$_GET['email'].'%');

            if($_GET['status'] !== '') $compradores = Comprador::where('status', $_GET['status']);

            $compradores = $compradores->with('individuais', 'coletivos', 'comercial')->orderBy('created_at', 'desc')->paginate(15);
        }else{
            $compradores = Comprador::with('individuais', 'coletivos', 'comercial')->orderBy('created_at', 'desc')->paginate(15);
        }

        return view('painel.pages.clientes.index', compact('compradores'));
    }

    public function editInd($id)
    {
        $comprador = Comprador::with('individuais', 'coletivos', 'comercial', 'adresses2')->find($id);
        return view('painel.pages.clientes.edit-ind', compact('comprador'));
    }
    public function editCol($id)
    {
        $comprador = Comprador::with('individuais', 'coletivos', 'comercial', 'adresses2')->find($id);
        return view('painel.pages.clientes.edit-col', compact('comprador'));
    }


    public function updateIndividual(Request $request, $id)
    {
        $comprador = Comprador::with('individuais', 'coletivos')->find($id);


        $comprador->name =     $request->get('name');
        $comprador->lastname = $request->get('lastname');
        $comprador->email = $request->get('email');
        if($request->get('password')) $comprador->password = Hash::make($request->get('password'));
        $comprador->telemovel = $request->get('telemovel');
        $comprador->save();

        $ind = BuyerInduvidual::where('comprador_id', $comprador->id)->update(array(
            'morada' => $request->get('morada'),
            'nif' => $request->get('nif'),
        ));

        AdressBuyer::create([
            'user_id' => $id,
            'morada' => $request->morada,
            'codigo_postal' => $request->codigo_postal,
            'regiao' => $request->regiao,
            'distrito' => $request->distrito,
            'conselho' => $request->conselho,
            'freguesia' => $request->freguesia,
            'porta' => $request->porta,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Comprador alterado com sucesso!');
    }

    public function updateColetivo(Request $request, $id)
    {
        $comprador = Comprador::with('individuais', 'coletivos')->find($id);


        $comprador->name =     $request->get('name');
        $comprador->email = $request->get('email');
        $comprador->telemovel = $request->get('telemovel');
        if($request->get('password')) $comprador->password = Hash::make($request->get('password'));
        $comprador->save();


        $ind = BuyerColective::where('comprador_id', $comprador->id)->update(array(
            'morada' => $request->get('morada'),
            'nif' => $request->get('nif'),
            'telefone' => $request->get('telefone'),
            'telemovel_empresa' => $request->get('telemovel_empresa'),
            'contato' => $request->get('contato'),
            'tipo' => $request->get('tipo'),
        ));

        AdressBuyer::create([
            'user_id' => $id,
            'morada' => $request->morada,
            'codigo_postal' => $request->codigo_postal,
            'regiao' => $request->regiao,
            'distrito' => $request->distrito,
            'conselho' => $request->conselho,
            'freguesia' => $request->freguesia,
            'porta' => $request->porta,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Comprador alterado com sucesso!');
    }

    public function ativar(Request $request, $id)
    {
        $comprador = Comprador::with('individuais', 'coletivos')->find($id);
        $comprador->status = $request->get('status');
        $comprador->save();
        return redirect()->back();
    }
}
