<?php

namespace App\Http\Controllers\Auth;

use App\Models\Porto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PescadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portos = Porto::all();
        return view('auth.pescador.login', compact('portos'));
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
        if(Auth::guard('pescador')->validate(['email' => $request->email, 'password' => $request->password, 'status' => 0])){
            return response()->json(['invalid' => 'Cadastro inativo!'], 422);
        }

        $authValid = Auth::guard('pescador')->validate(['email' => $request->email, 'password' => $request->password]);

        if($authValid){
            if (Auth::guard('pescador')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json('pescador', 200);
            }
        }else{
            return response()->json(['invalid' => 'Email ou senha invalidos'], 422);
        }
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

    public function logout()
    {

        Auth::logout();

        return redirect('login-pescador');
    }
}
