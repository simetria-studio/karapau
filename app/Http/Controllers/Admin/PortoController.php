<?php

namespace App\Http\Controllers\Admin;

use App\Models\Porto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Especie;
use App\Models\EspecieToPorto;
use Illuminate\Support\Facades\Http;
use App\Models\PortoTax;
use Intervention\Image\ImageManagerStatic;

class PortoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especies = Especie::all();

        return view('painel.pages.porto.create', compact('especies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $img = ImageManagerStatic::make($data['image']);
        $name = Str::random() . '.jpg';

        $originalPath = storage_path('app/public/portos/');

        $img->save($originalPath . $name);

        $porto = Porto::create([
            'nome' => $data['nome'],
            'registro' => $request->input('registro'),
            'descarga' => $request->input('descarga'),
            'controle_veterinario' => $data['veterinario'] ? $data['controle_veterinario'] : null,
            'image' => $name,
            'sigla' => $request->input('sigla'),
            'codigo_postal' => $request->input('codigo_postal'),
            'morada' => $request->input('morada'),
            'regiao' => $request->input('regiao'),
            'porta' => $request->input('porta'),
            'distrito' => $request->input('distrito'),
            'conselho' => $request->input('conselho'),
            'freguesia' => $request->input('freguesia'),
            'latitude' => $request->input('latitude'),
            'longitude'  => $request->input('longitude'),


        ]);
        if ($porto) {

            foreach ($data['especies'] as $key => $especi) {
                EspecieToPorto::create([
                    'porto_id' => $porto->id,
                    'especie_id' => $especi,
                ]);
            }
        }


        return redirect()->route('admin.porto')->with('success', "Porto $porto->nome criado com sucesso!");
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
        $porto = Porto::findOrFail($id);
        $especies = Especie::all();
        $especiePortos = EspecieToPorto::where('porto_id', $id)->get();
        $especieDePorto = [];
        foreach($especiePortos as $especiePorto){
            $especieDePorto[$especiePorto->especie_id] = $especiePorto->especie_id;
        }
        return view('painel.pages.porto.edit', compact('porto', 'especies', 'especieDePorto'));
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
        $porto = Porto::find($id);

        $data = $request->all();

        if ($request->image != '') {
            $path = storage_path('app/public/portos/');

            //code for remove old file
            if ($porto->image != ''  && $porto->image != null) {
                $file_old = $path . $porto->image;
                unlink($file_old);
            }

            //upload new file
            $img = ImageManagerStatic::make($data['image']);


            $name = Str::random() . '.jpg';

            $originalPath = storage_path('app/public/portos/');

            $img->save($originalPath . $name);

            //for update in table
            $porto->update(['image' => $name]);
        }


        $porto->nome =     $request->get('nome');
        $porto->registro = $request->get('registro');
        $porto->descarga = $request->get('descarga');
        $porto->controle_veterinario = $request->get('veterinario') ? $request->get('controle_veterinario') : null;
        // $porto->especies = $request->get('especies');
        $porto->sigla = $request->get('sigla');
        $porto->codigo_postal = $request->get('codigo_postal');
        $porto->morada = $request->get('morada');
        $porto->regiao = $request->get('regiao');
        $porto->porta = $request->get('porta');
        $porto->distrito = $request->get('distrito');
        $porto->conselho = $request->get('conselho');
        $porto->freguesia = $request->get('freguesia');
        $porto->latitude = $request->get('latitude');
        $porto->longitude = $request->get('longitude');



        $porto->save();

        // if ($porto) {

        //     foreach ($data['especies'] as $key => $especi) {
        //         EspecieToPorto::create([
        //             'porto_id' => $porto->id,
        //             'especie_id' => $especi,
        //         ]);
        //     }
        // }
        return redirect()->route('admin.porto')->with('success', 'porto alterado com sucesso!');
    }

    public function status(Request $request, $id)
    {
        $porto = Porto::find($id);
        $porto->status = $request->get('status');
        $porto->save();
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $porto = Porto::findOrFail($id);
        $porto->delete();
        return redirect()->route('admin.porto')->with('success', "Porto $porto->nome deletado com sucesso!");
    }

    public function tax($id)
    {
        $porto = Porto::find($id);
        $taxa = PortoTax::where('porto_id', $id)->orderBy('created_at', 'desc')->first();
        return view('painel.pages.porto.taxas', compact('porto', 'taxa'));
    }

    public function taxstore(Request $request)
    {
        $porto = PortoTax::create($request->all());
        return redirect()->route('admin.porto')->with('success', "Taxa criado com sucesso!");
    }

    public function buscaCep(Request $request)
    {
        $valor = $request->search;
        $cep = str_replace('-', '', $valor);

        $url = Http::get('https://api.duminio.com/ptcp/ptapi60ec808f3e8951.33243239/' . $cep);

        return $url->collect();
    }
}
