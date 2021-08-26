<?php

namespace App\Http\Controllers\Admin;

use App\Models\Porto;
use App\Models\Especie;
use App\Models\Pescador;
use App\Models\Comprador;
use App\Models\Consultor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PainelController extends Controller
{
    public function index()
    {
        $pescadores = Pescador::all();
        $clientes = Comprador::all();
        return view('painel.pages.index', compact('pescadores', 'clientes'));
    }
    public function especies()
    {
        $especies = Especie::paginate(15);
        return view('painel.pages.especies.index', compact('especies'));
    }

    public function porto()
    {
        $portos = Porto::paginate(15);
        return view('painel.pages.porto.index', compact('portos'));
    }

}
