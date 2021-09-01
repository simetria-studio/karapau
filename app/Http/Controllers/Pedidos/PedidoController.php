<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use App\Models\PescadorPedido;
use App\Models\UserOrder;
use App\Models\UserProduct;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function getStatus($id)
    {
        $transactionID = $id;

        $curl = curl_init();
        $post_url = 'https://spg.qly.site1.sibs.pt/api/v1/payments/' . $transactionID . '/status';
        curl_setopt($curl, CURLOPT_URL, $post_url);
        $headers = array(
            'X-IBM-Client-Id: 681275a2-4647-4e95-b090-98637e7a2bd0',
            // 'Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJqdGkiOiI1OTBlYjVkMC05YWY0LTQyZjgtOGY1ZS0zOTNmNGM1MzNhYzMiLCJleHAiOjAsIm5iZiI6MCwiaWF0IjoxNjI4NTI0NzAyLCJpc3MiOiJodHRwczovL3Nzby5zaXRlMS5zeXMuc2licy5wdC9hdXRoL3JlYWxtcy9QUkQuU1BHLkFQSSIsImF1ZCI6IlBSRC5TUEcuQVBJLUNMSSIsInN1YiI6IjJlMTdhYjVhLTc2MjctNDA4YS1iMjVkLTczZmQyZTQ0N2JmOSIsInR5cCI6Ik9mZmxpbmUiLCJhenAiOiJQUkQuU1BHLkFQSS1DTEkiLCJzZXNzaW9uX3N0YXRlIjoiMWM4ZjRiNWMtNTQ2Mi00YjllLWFjNjAtZmMwMjU3MGNkNDU2IiwiY2xpZW50X3Nlc3Npb24iOiIwYmJlYWNhNy00OGI2LTRmNTMtOWE1Yy1lN2YyYWNhM2YxOTYiLCJyZWFsbV9hY2Nlc3MiOnsicm9sZXMiOlsib2ZmbGluZV9hY2Nlc3MiXX0sInJlc291cmNlX2FjY2VzcyI6eyJhY2NvdW50Ijp7InJvbGVzIjpbIm1hbmFnZS1hY2NvdW50Iiwidmlldy1wcm9maWxlIl19fX0.dBYQtNNepYJN0jig7V0SFZ-Dbn0paaLMZ-ZVhEyFlCh_Sx_V6PKMzx9B_ou1XbS6fFdn7Myr6hSpVlH9hOSvfDHzRH0DTNGe-ZA6mtMFWF1iO49GiBS8ZiwwW2Uee2ox6IRHsqJ9_0-OUH7o7AMTVcS1fuqOUaHX1pMlxFQ4MznT25nMnHXrKUjgOUSVdGF3BR5MmoZYZbxtAS9Yv6jw0fEReWG3wPficCsJQXdd1g37UfGB_OstJXnHQplqTslfZPShCif81tal8VoRiRHMY-y5lXKMBTbR07cleiGexKciLKA2cWiAT3F_Px1f7hqaSm3JIEBwnVLUJwVV3b-R-w.eyJtYyI6IjQ5MjY1MSIsInRjIjoiMTI2NjYyNyJ9.19E90C567A210C3417EB478CFF41BE29B669CE28E5AC02ED3CBCC9C7E1D119F4',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJlNzYyMzE3Yi03N2IxLTQ0ZWItYTUzYy0zMjY1ZDY5NTllZGIifQ.eyJpYXQiOjE2MjYzMzQ5NDcsImp0aSI6ImVlMmRkNDdlLWNiMGUtNDNiYy1hYzA0LWU1YTc0ZTJkZDM1NiIsImlzcyI6Imh0dHBzOi8vcWx5LnNpdGUxLnNzby5zeXMuc2licy5wdC9hdXRoL3JlYWxtcy9RTFkuU1BHLkFQSSIsImF1ZCI6Imh0dHBzOi8vcWx5LnNpdGUxLnNzby5zeXMuc2licy5wdC9hdXRoL3JlYWxtcy9RTFkuU1BHLkFQSSIsInN1YiI6IjkxZTBkNzgyLTM5YzUtNGIyMy04ZTY3LTE4OTVlODliYTdlNSIsInR5cCI6Ik9mZmxpbmUiLCJhenAiOiJRTFkuU1BHLkFQSS1DTEkiLCJzZXNzaW9uX3N0YXRlIjoiNmQxMWM1ZjctNGU5Yy00ODAyLWFiODktZGI2ZjAxZWU3ZjQ1Iiwic2NvcGUiOiJvcGVuaWQgb2ZmbGluZV9hY2Nlc3MifQ.gvJe153ziOuM0Rlq9ErYZHQPqbovwv5QCIUCs4fUevg.eyJtYyI6Ijk5OTk5OTkiLCJ0YyI6IjUwOTk5In0=.98764F889348F59773374549EF7DCFED7D121C0EA1BBA01141F81651A37405A2',
            'Content-Type: application/json'
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;

    }

    public function userPedido()
    {


        $codeStatus = [
            'Pending'   => 0,
            'Success'   => 2,
            'Declined'  => 3,
        ];
        $user_orders = UserOrder::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        foreach($user_orders as $order){
            $status = $this->getStatus($order->transaction_id);
            $status = json_decode($status);
            // print_r($status);
            if(!isset($status->paymentStatus)){
                continue;
            }
            if($order->status != $codeStatus[$status->paymentStatus]){

                UserOrder::find($order->id)->update([
                    'status' => $codeStatus[$status->paymentStatus],
                ]);
            }
        }
        $user_orders = $user_orders->fresh();
        return view('app-front.store.pages.encomenda', compact('user_orders'));
    }

    public function pedidoDatalheUser($id)
    {

        $user_order = UserOrder::with('enderecos')->find($id);
        $orders  = PescadorPedido::where('order_id', $id)->with('adresses', 'pescador', 'orders', 'products')->get();
        return view('app-front.store.pages.pedido-list', compact('orders', 'user_order'));
    }

    public function produtoStatus(Request $request)
    {

        $id = $request->modalId;
        $porto = UserProduct::find($id);
        $porto->status = $request->get('status');
        $porto->save();
        return redirect()->back();
    }
}
