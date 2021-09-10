<?php

namespace App\Http\Controllers\Comercial;

use App\Models\DrawCom;
use App\Models\WalletCom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallet = WalletCom::where('user_id', auth()->user()->id)->with('orders')->get();
        $draws = DrawCom::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
        return view('comercial.pages.wallet', compact('wallet', 'draws'));
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



            $draw = DrawCom::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'qty' => $request->qty,
                'status' => 0,
            ]);

            $negativado = WalletCom::create([
                'user_id' => auth()->user()->id,
                'comprador_id' => 0,
                'pescador_id' => 0,
                'product_id' => 0,
                'order_id' => 0,
                'total' => 0,
                'value' => -$request->qty,
            ]);

            return redirect('draw-requested');
    }

    public function requested()
    {
        return view('comercial.pages.solicitado');
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
