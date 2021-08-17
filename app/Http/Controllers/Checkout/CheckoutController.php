<?php

namespace App\Http\Controllers\Checkout;

use App\Models\Porto;
use App\Models\Produto;
use App\Models\PayImage;
use App\Models\PortoTax;
use App\Models\Comprador;
use App\Models\UserOrder;
use App\Models\WalletCom;
use App\Models\AdressBuyer;
use App\Models\ShippingTax;
use App\Models\UserProduct;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Str;
use App\Models\SellToWallet;
use Illuminate\Http\Request;
use App\Models\PescadorPedido;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic;

class CheckoutController extends Controller
{
    public function adress()
    {
        $adresses = AdressBuyer::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
        return view('app-front.store.pages.adress', compact('adresses'));
    }
    public function index()
    {
        // $taxa = PortoTax::where('porto_id', $id)->orderBy('created_at', 'desc')->first();
        $adresses = AdressBuyer::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
        $shipping = ShippingTax::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();

        if (\Cart::isEmpty()) {
            return redirect()->route('store.porto');
        }

        return view('app-front.store.pages.checkout', compact('adresses', 'shipping'));
    }

    public function sibs($dados)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://spg.qly.site1.sibs.pt/api/v1/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dados),
            CURLOPT_HTTPHEADER => array(
                'X-IBM-Client-Id: 681275a2-4647-4e95-b090-98637e7a2bd0',
                // 'Authorization: Bearer eyJhbGciOiJSUzI1NiJ9.eyJqdGkiOiI1OTBlYjVkMC05YWY0LTQyZjgtOGY1ZS0zOTNmNGM1MzNhYzMiLCJleHAiOjAsIm5iZiI6MCwiaWF0IjoxNjI4NTI0NzAyLCJpc3MiOiJodHRwczovL3Nzby5zaXRlMS5zeXMuc2licy5wdC9hdXRoL3JlYWxtcy9QUkQuU1BHLkFQSSIsImF1ZCI6IlBSRC5TUEcuQVBJLUNMSSIsInN1YiI6IjJlMTdhYjVhLTc2MjctNDA4YS1iMjVkLTczZmQyZTQ0N2JmOSIsInR5cCI6Ik9mZmxpbmUiLCJhenAiOiJQUkQuU1BHLkFQSS1DTEkiLCJzZXNzaW9uX3N0YXRlIjoiMWM4ZjRiNWMtNTQ2Mi00YjllLWFjNjAtZmMwMjU3MGNkNDU2IiwiY2xpZW50X3Nlc3Npb24iOiIwYmJlYWNhNy00OGI2LTRmNTMtOWE1Yy1lN2YyYWNhM2YxOTYiLCJyZWFsbV9hY2Nlc3MiOnsicm9sZXMiOlsib2ZmbGluZV9hY2Nlc3MiXX0sInJlc291cmNlX2FjY2VzcyI6eyJhY2NvdW50Ijp7InJvbGVzIjpbIm1hbmFnZS1hY2NvdW50Iiwidmlldy1wcm9maWxlIl19fX0.dBYQtNNepYJN0jig7V0SFZ-Dbn0paaLMZ-ZVhEyFlCh_Sx_V6PKMzx9B_ou1XbS6fFdn7Myr6hSpVlH9hOSvfDHzRH0DTNGe-ZA6mtMFWF1iO49GiBS8ZiwwW2Uee2ox6IRHsqJ9_0-OUH7o7AMTVcS1fuqOUaHX1pMlxFQ4MznT25nMnHXrKUjgOUSVdGF3BR5MmoZYZbxtAS9Yv6jw0fEReWG3wPficCsJQXdd1g37UfGB_OstJXnHQplqTslfZPShCif81tal8VoRiRHMY-y5lXKMBTbR07cleiGexKciLKA2cWiAT3F_Px1f7hqaSm3JIEBwnVLUJwVV3b-R-w.eyJtYyI6IjQ5MjY1MSIsInRjIjoiMTI2NjYyNyJ9.19E90C567A210C3417EB478CFF41BE29B669CE28E5AC02ED3CBCC9C7E1D119F4',
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJlNzYyMzE3Yi03N2IxLTQ0ZWItYTUzYy0zMjY1ZDY5NTllZGIifQ.eyJpYXQiOjE2MjYzMzQ5NDcsImp0aSI6ImVlMmRkNDdlLWNiMGUtNDNiYy1hYzA0LWU1YTc0ZTJkZDM1NiIsImlzcyI6Imh0dHBzOi8vcWx5LnNpdGUxLnNzby5zeXMuc2licy5wdC9hdXRoL3JlYWxtcy9RTFkuU1BHLkFQSSIsImF1ZCI6Imh0dHBzOi8vcWx5LnNpdGUxLnNzby5zeXMuc2licy5wdC9hdXRoL3JlYWxtcy9RTFkuU1BHLkFQSSIsInN1YiI6IjkxZTBkNzgyLTM5YzUtNGIyMy04ZTY3LTE4OTVlODliYTdlNSIsInR5cCI6Ik9mZmxpbmUiLCJhenAiOiJRTFkuU1BHLkFQSS1DTEkiLCJzZXNzaW9uX3N0YXRlIjoiNmQxMWM1ZjctNGU5Yy00ODAyLWFiODktZGI2ZjAxZWU3ZjQ1Iiwic2NvcGUiOiJvcGVuaWQgb2ZmbGluZV9hY2Nlc3MifQ.gvJe153ziOuM0Rlq9ErYZHQPqbovwv5QCIUCs4fUevg.eyJtYyI6Ijk5OTk5OTkiLCJ0YyI6IjUwOTk5In0=.98764F889348F59773374549EF7DCFED7D121C0EA1BBA01141F81651A37405A2',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function mbway($checkout_response, $phone)
    {
        $checkout_response = json_decode($checkout_response);
        $transactionID = $checkout_response->transactionID;
        $transactionSig = $checkout_response->transactionSignature;

        $curl = curl_init();

        $post_url = 'https://spg.qly.site1.sibs.pt/api/v1/payments/' . $transactionID . '/mbway-id/purchase';
        curl_setopt($curl, CURLOPT_URL, $post_url);
        $headers = array(
            'X-IBM-Client-Id: 681275a2-4647-4e95-b090-98637e7a2bd0',
            'Content-type: application/json; charset=utf-8',
            'Authorization: Digest ' . $transactionSig
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, 1);
        $payload = json_encode(array('customerPhone' => $phone));
        // echo $payload . "\n";
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    public function payment(Request $request)
    {
        $timestamp = time();
        $status = 0;
        $status2 = 0;

        if ($request->payment_mothod == 'mbway') {
            $dados = [
                'merchant' => [
                    "terminalId" => 50999,
                    "channel" => "web",
                    "merchantTransactionId" => "Teste 1",
                ],
                'transaction' => [
                    "transactionTimestamp" => gmdate('Y-m-d\TH:i:s.v\Z', $timestamp),
                    "description" => "Pagamento pela sibs",
                    "moto" => false,
                    "paymentType" => "PURS",
                    "amount" => [
                        "value" => (int)$request->total,
                        "currency" => "EUR"
                    ],
                    "paymentMethod" => [
                        "REFERENCE",
                        "QRCODE",
                        "MBWAY"
                    ],
                    "paymentReference" => [
                        "initialDatetime" => gmdate('Y-m-d\TH:i:s.v\Z', $timestamp),
                        "finalDatetime" => gmdate('Y-m-d\TH:i:s.v\Z', $timestamp),
                        "maxAmount" => [
                            "value" => (int)$request->total,
                            "currency" => "EUR"
                        ],
                        "minAmount" => [
                            "value" => (int)$request->total,
                            "currency" => "EUR"
                        ],
                        "entity" => "24000"
                    ],
                ],

            ];

            $phone = $request->phone;

            $sibsDados = $this->sibs($dados);
            if (empty(json_decode($sibsDados)->transactionID)) {
                return response()->json('idnulo', 412);
            }

            $mbwayDados = $this->mbway($sibsDados, $phone);

            // dd($mbwayDados);
            if (empty(json_decode($mbwayDados)->paymentStatus)) {
                return response()->json(['erro', $mbwayDados], 412);
            }
            if (json_decode($mbwayDados)->paymentStatus != 'Success') {
                return response()->json(['erro', $mbwayDados], 412);
            }

            $status = 2;
            $status2 = 1;
        }

            $date = new \DateTime();
            $codigo = $request->sigla. '-' . $date->getTimestamp();
            $user_order = UserOrder::create([
                'adress' => $request->adress,
                'payment_mothod' => $request->payment_mothod,
                'shipping_mothod' => $request->shipment,
                'user_id' => auth()->user()->id,
                'user_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'telemovel' => auth()->user()->telemovel,
                'total' => $request->total,
                'frete' => $request->freteval,
                'sub_total' => \Cart::getSubTotal(),
                'status' => $status,
                'codigo' => $codigo,
            ]);


            $count = 1;
            foreach (\Cart::getContent() as $key => $item) {


                $itemQty = $item->price * $item->quantity;
                $value = $itemQty - $itemQty * ($item->attributes->margem / 100);
                $subir = $count++;


                $produtos = UserProduct::create([
                    'product_id' => $item->id,
                    'item' => $subir,
                    'name' => $item->name,
                    'price' => $item->price,
                    'value' => $value,
                    'total_value' => $itemQty,
                    'quantity' => $item->quantity,
                    'caixas' => $request->caixas,
                    'origem' => $item->attributes->porto,
                    'image' => $item->attributes->image,
                    'user_id' => auth()->user()->id,
                    'order_id' => $user_order->id,
                    'pescador_id' => $item->attributes->pescador_id,
                    'stutus' => $status2,
                ]);

                $wallet = SellToWallet::create([
                    'pescador_id' => $item->attributes->pescador_id,
                    'product_id' =>  $item->id,
                    'value' => $value,
                ]);

                $id = auth()->user()->id;
                $comprador = Comprador::with('comercial')->find($id);
                $valor = \Cart::getTotal() * (2 / 100);

                $walletCom = WalletCom::create([
                    'user_id' => $comprador->comercial->id,
                    'comprador_id' => $id,
                    'pescador_id' => $item->attributes->pescador_id,
                    'order_id' => $user_order->id,
                    'product_id' => $item->id,
                    'total' => \Cart::getTotal(),
                    'value' => $valor,
                ]);

                $quantidade = Produto::find($item->id);
                $quantidade->quantidade_kg = $quantidade->quantidade_kg - $item->quantity;
                $quantidade->save();

                $pedido =  PescadorPedido::create([
                    'pescador_id' => $item->attributes->pescador_id,
                    'order_id' => $user_order->id,
                    'adress' => $request->adress,
                    'produtos' => $produtos->id,
                    'wallet' => $wallet->id,
                    'user_id' => auth()->user()->id,

                ]);
            }



        \Cart::clear();
        return response()->json('success', 200);
    }

    public function thanks()
    {
        return view('store.pages.painel.thanks');
    }

    public function payImage(Request $request)
    {
        $data = $request->all();
        $img = ImageManagerStatic::make($data['comprovante']);
        $name = Str::random() . '.jpg';

        $originalPath = storage_path('app/public/comprovantes/');

        $img->save($originalPath . $name);

        $comprovante = PayImage::create([
            'user_id' => auth()->user()->id,
            'order_id' => $request->order_id,
            'path' => $name
        ]);
        $produto = UserOrder::find($request->order_id);
        $produto->status = 1;
        $produto->save();

        return redirect()->back()->with('success', 'Comprovante Enviado');
    }
}
