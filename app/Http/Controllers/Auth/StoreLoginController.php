<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\CompradorColetivo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class StoreLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app-front.store.auth.login');
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

    public function login(Request $request)
    {
        if(Auth::guard('buyer')->validate(['email' => $request->email, 'password' => $request->password, 'status' => 0])){
            return response()->json(['invalid' => 'Cadastro inativo!'], 422);
        }

        $authValid = Auth::guard('buyer')->validate(['email' => $request->email, 'password' => $request->password]);

        if($authValid){
            if (Auth::guard('buyer')->attempt(['email' => $request->email, 'password' => $request->password])) {

                return response()->json('store-index', 200);
            }
        }else{
            return response()->json(['invalid' => 'Email ou senha invalidos'], 422);
        }
    }

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
