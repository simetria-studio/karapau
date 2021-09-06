<?php

namespace App\Http\Controllers\Admin;

use App\Models\Arte;
use App\Models\Porto;
use App\Models\Especie;
use App\Models\Produto;
use App\Models\Tamanho;
use App\Models\Pescador;
use App\Models\UserOrder;
use App\Models\AdressBuyer;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use App\Models\PescadorPedido;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PescadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pescadores = Pescador::with('produtos')->paginate(15);

        return view('painel.pages.pescador.index', compact('pescadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showProducts($id)
    {
        $produtos = Produto::with('especies')->where('pescador_id', $id)->get();
        return view('painel.pages.pescador.produtos', compact('produtos'));
    }


    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pescador = Pescador::findOrFail($id);

        return view('painel.pages.pescador.edit-pescador', compact('pescador'));
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
        $pescador = Pescador::find($id);

        $pescador->name             = $request->get('name');
        $pescador->lastname         = $request->get('lastname');
        $pescador->email            = $request->get('email');
        if($request->get('password')) $pescador->password = Hash::make($request->get('password'));
        $pescador->telefone         = $request->get('telefone');
        $pescador->morada           = $request->get('morada');
        $pescador->nif              = $request->get('nif');
        $pescador->iban             = $request->get('iban');
        $pescador->nome_embarcacao  = $request->get('nome_embarcacao');
        $pescador->codigo_postal    = $request->get('codigo_postal');
        $pescador->regiao           = $request->get('regiao');
        $pescador->porta            = $request->get('porta');
        $pescador->distrito         = $request->get('distrito');
        $pescador->conselho         = $request->get('conselho');
        $pescador->freguesia        = $request->get('freguesia');
        $pescador->latitude         = $request->get('latitude');
        $pescador->longitude        = $request->get('longitude');

        $pescador->save();

        return redirect()->route('admin.pescador')->with('success', 'Pescador alterado com sucesso!');
    }


    public function updateStatus(Request $request, $id)
    {
        $pescador = Pescador::find($id);
        $pescador->status = $request->get('status');
        $pescador->save();
        return redirect()->back();

    }

    public function editProduto($id)
    {
        $especies = Especie::all();
        $portos = Porto::all();
        $produto = Produto::with('especies', 'portos')->find($id);

        return view('painel.pages.pescador.edit-produto', compact('produto', 'especies', 'portos'));
    }

    public function updateProduto(Request $request, $id)
    {
        $pescador = Produto::find($id);

        $pescador->especie_id =     $request->get('especie_id');
        $pescador->porto_id = $request->get('porto_id');
        $pescador->embarcacao = $request->get('embarcacao');
        $pescador->zona = $request->get('zona');
        $pescador->tamanho = $request->get('tamanho');
        $pescador->quantidade_kg = $request->get('quantidade_kg');
        $pescador->preco = $request->get('preco');
        $pescador->unidade = $request->get('unidade');

        $pescador->save();

        return redirect()->route('admin.pescador')->with('success', 'Produto alterado com sucesso!');
    }

    public function updateProdutoStatus(Request $request, $id)
    {
        $produto = Produto::find($id);
        $produto->status = $request->get('status');
        $produto->save();
        return redirect()->back();

    }

    public function pedidos($id)
    {
        $pedidos = PescadorPedido::with('orders', 'products', 'adresses')->where('pescador_id', $id)->get();
        return view('painel.pages.pescador.pedidos', compact('pedidos'));
    }
    public function pedidosCompletos($id)
    {
        $pedido = PescadorPedido::with('orders', 'products', 'adresses')->find($id);
        // dd($pedido);
        // $produtos = UserProduct::where('order_id', $id)->get();

        return view('painel.pages.pescador.pedidos-completo', compact('pedido'));
    }

    public function destroy($id)
    {
        Produto::find($id)->delete();
        return redirect()->back()->with('success', 'Produto Excluido com sucesso!');
    }

    public function pecadorCadastroProduto($id)
    {
        $id_pescador = $id;
        $portos = Porto::all();
        $especies = Especie::all();
        $pescador = Pescador::find($id);
        $tamanhos = Tamanho::all();
        $artes = Arte::all();

        return view('painel.pages.pescador.cadastro-produto', compact('portos', 'especies', 'pescador', 'id_pescador', 'tamanhos', 'artes'));
    }

    public function pecadorCadastroProdutoStore(Request $request)
    {
        $user = $request->id_pescador;

        $produto = Produto::create([
            'pescador_id' => $user,
            'especie_id' => $request->especie_id,
            'porto_id' => $request->porto_id,
            'embarcacao' => $request->embarcacao,
            'zona' => $request->zona,
            'tamanho' => $request->tamanho,
            'quantidade_kg' => $request->quantidade_kg ? $request->quantidade_kg : $request->total_kg,
            'quantidade_unidade' => $request->quantidade_unidade,
            'arte' => $request->arte,
            'preco' => $request->preco,
            'unidade' => $request->unidade,
            // 'kg' => $request->kg,
            // 'image' => $request->image,
            // 'status' => $request->status,
        ]);
        return redirect()->route('admin.pescador')->with('success', 'Produto criado com sucesso!');
    }
}
