<?php

namespace App\Http\Controllers\Admin;

use App\Models\SageToken;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SageController extends Controller
{
    public function sageConect($url_token)
    {
        $curl = \curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url_token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function callback()
    {
        $code = isset($_GET['code']) ? $_GET['code'] : null;
        $client_id = 'b3e8437702845e4388c6';
        $client_secret = '5c195f686b8acded15b0f4f08628d5ccf93f68de';
        $signing_secret = 'a79cccbd1035b9a244da151e5af5313422338e79';
        $grant_type = 'authorization_code';
        $redirect_uri = 'https://138.68.183.161/callback';

        if($code){
            $url_token = "https://api.sageone.com/oauth2/token?client_id=$client_id&client_secret=$client_secret&code=$code&grant_type=$grant_type&redirect_uri=$redirect_uri";

            $sage = $this->sageConect($url_token);
            $sage = json_encode($sage);

            SageToken::create([
                'token' => $sage->token,
                'refresh_token' => $sage->refresh_token,
            ]);

            return redirect()->route('admin.encomendas');
        }
    }
}
