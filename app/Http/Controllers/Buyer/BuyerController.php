<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Comprador;
use App\Models\AdressBuyer;
use Illuminate\Http\Request;
use App\Models\CompradorIndividual;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function individual($id)
    {
        $user = Comprador::find($id);
        $adress = AdressBuyer::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
        return view('app-front.store.pages.perfil', compact('user', 'adress'));
    }
    public function edit($id)
    {
        $user = Comprador::with('adresses')->find($id);
        return view('app-front.store.pages.info-edit', compact('user'));
    }
    public function logout()
    {

        Auth::logout();

        return redirect('store-login-page');
    }
}
