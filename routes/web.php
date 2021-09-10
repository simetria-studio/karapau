<?php

use App\Models\CompradorIndividual;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\Admin\KmController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArtesController;
use App\Http\Controllers\Admin\PortoController;

use App\Http\Controllers\Buyer\BuyerController;

use App\Http\Controllers\Store\StoreController;

use App\Http\Controllers\Admin\PainelController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\EspecieController;
use App\Http\Controllers\Adress\AdressController;
use App\Http\Controllers\Auth\PescadorController;
use App\Http\Controllers\Admin\TamanhosController;
use App\Http\Controllers\Pedidos\PedidoController;
use App\Http\Controllers\Admin\ComercialController;
use App\Http\Controllers\Auth\StoreLoginController;
use App\Http\Controllers\Admin\EncomendasController;
use App\Http\Controllers\Admin\EntregadorController;
use App\Http\Controllers\Auth\PescadorRegController;
use App\Http\Controllers\Comercial\WalletController;
use App\Http\Controllers\Pescador\ProdutoController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Auth\LoginConsultorController;
use App\Http\Controllers\Admin\EstatiscaDiariaController;
use App\Http\Controllers\Auth\CompradorColetivoController;
use App\Http\Controllers\Pescador\PainelPescadorController;
use App\Http\Controllers\Auth\CompradorIndividualController;
use App\Http\Controllers\Comercial\ComercialPainelController;
use App\Http\Controllers\Admin\PescadorController as AdminPescadorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('url-teste', [CheckoutController::class, 'urlTeste']);

Route::any('notification', [CheckoutController::class, 'webhook']);

Route::get('/', function () {
    return view('auth.login');
});

Route::get('consultor-login', function () {
    return view('auth.consultor.login');
});

Auth::routes();

/*  Painel Routes  */
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('layout', function () {
        return view('layouts.painel.index');
    });

    Route::prefix('cadastro')->group(function () {
        Route::get('especies', [PainelController::class, 'especies'])->name('admin.especies');
        Route::get('porto', [PainelController::class, 'porto'])->name('admin.porto');
        Route::get('tamanhos', [TamanhosController::class, 'index'])->name('admin.tamanhos');
        Route::get('artes', [ArtesController::class, 'index'])->name('admin.artes');
    });

    Route::prefix('configs')->group(function () {
        Route::get('km/cadastro', [KmController::class, 'index'])->name('admin.km');
        Route::post('km/cadastro/store', [KmController::class, 'store'])->name('admin.km.store');
    });

    Route::get('/home', [PainelController::class, 'index']);

    Route::get('/entregadores', [EntregadorController::class, 'index'])->name('entregador');
    Route::get('/entregador/dados/{id}', [EntregadorController::class, 'indexDados'])->name('entregador.dados');
    Route::post('/entregador/aceito', [EntregadorController::class, 'entregaAceito'])->name('entregador.aceito');
    Route::post('/entregador/caixa_devolvida', [EntregadorController::class, 'caixaDevolvida'])->name('entregador.caixa_devolvida');
    Route::post('/entregador/entregue', [EntregadorController::class, 'entregue'])->name('entregador.entregue');
    Route::post('/entregador/atribuir', [EntregadorController::class, 'entregadorAtribuir'])->name('entregador.atribuir');

    Route::get('tamanhos/create', [TamanhosController::class, 'create'])->name('admin.tamanhos.create');
    Route::post('tamanhos/store', [TamanhosController::class, 'store'])->name('admin.tamanhos.store');
    Route::post('tamanhos/update/{id}', [TamanhosController::class, 'update'])->name('admin.tamanhos.update');
    Route::get('tamanhos/show/{id}', [TamanhosController::class, 'show'])->name('admin.tamanhos.show');
    Route::any('tamanhos/delete/{id}', [TamanhosController::class, 'destroy'])->name('admin.tamanhos.delete');

    Route::get('artes/create', [ArtesController::class, 'create'])->name('admin.artes.create');
    Route::post('artes/store', [ArtesController::class, 'store'])->name('admin.artes.store');
    Route::post('artes/update/{id}', [ArtesController::class, 'update'])->name('admin.artes.update');
    Route::get('artes/show/{id}', [ArtesController::class, 'show'])->name('admin.artes.show');
    Route::any('artes/delete/{id}', [ArtesController::class, 'destroy'])->name('admin.artes.delete');

    Route::get('usuarios', [UserController::class, 'index'])->name('admin.users');
    Route::post('usuarios/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('usuarios/update', [UserController::class, 'update'])->name('admin.users.update');

    Route::get('especies/create', [EspecieController::class, 'create'])->name('admin.especies.create');
    Route::post('especies/store', [EspecieController::class, 'store'])->name('admin.especies.store');
    Route::get('especies/show/{id}', [EspecieController::class, 'show'])->name('admin.especies.show');
    Route::post('especies/update/{id}', [EspecieController::class, 'update'])->name('admin.especies.update');
    Route::any('especies/delete/{id}', [EspecieController::class, 'destroy'])->name('admin.especies.delete');

    Route::get('pescador', [AdminPescadorController::class, 'index'])->name('admin.pescador');
    Route::get('pescador/produtos/{id}', [AdminPescadorController::class, 'showProducts'])->name('admin.pescador.produtos');
    Route::get('pescador/edit/{id}', [AdminPescadorController::class, 'show'])->name('admin.pescador.edit');
    Route::post('pescador/update/{id}', [AdminPescadorController::class, 'update'])->name('admin.pescador.update');
    Route::any('pescador/update/status/{id}', [AdminPescadorController::class, 'updateStatus'])->name('admin.pescador.update.status');
    Route::any('pescador/update/produto/status/{id}', [AdminPescadorController::class, 'updateProdutoStatus'])->name('admin.pescador.produto.status');
    Route::any('pescador/edit/produto/{id}', [AdminPescadorController::class, 'editProduto'])->name('admin.pescador.produto.edit');
    Route::post('pescador/update/produto/{id}', [AdminPescadorController::class, 'updateProduto'])->name('admin.pescador.produto.update');
    Route::get('pescador/pedidos/{id}', [AdminPescadorController::class, 'pedidos'])->name('admin.pescador.pedidos');
    Route::get('pedidos/completo/{id}', [EncomendasController::class, 'pedidoDatalheUser'])->name('admin.pedidos.completo');
    Route::any('pescador/delete/{id}', [AdminPescadorController::class, 'destroy'])->name('admin.pescador.produtos.delete');

    Route::post('pedidos/anexar', [EncomendasController::class, 'pedidoAnexar'])->name('admin.pedidos.anexar');
    Route::get('pedidos/anexo/{id?}', [EncomendasController::class, 'pedidoAnexo'])->name('admin.pedidos.anexo');

    Route::get('/pescador-cadastro-produto/{id}', [AdminPescadorController::class, 'pecadorCadastroProduto'])->name('admin.pescador.cadastro.produto');
    Route::post('/pescador-cadastro-produto/store', [AdminPescadorController::class, 'pecadorCadastroProdutoStore'])->name('admin.pescador.produto.store');

    Route::get('porto/create', [PortoController::class, 'create'])->name('admin.porto.create');
    Route::post('porto/store', [PortoController::class, 'store'])->name('admin.porto.store');
    Route::any('porto/delete/{id}', [PortoController::class, 'destroy'])->name('admin.porto.delete');
    Route::get('porto/edit/{id}', [PortoController::class, 'edit'])->name('admin.porto.edit');
    Route::post('porto/update/{id}', [PortoController::class, 'update'])->name('admin.porto.update');
    Route::any('porto/update/status/{id}', [PortoController::class, 'status'])->name('admin.porto.update.status');
    Route::get('porto/tax/{id}', [PortoController::class, 'tax'])->name('admin.porto.tax');
    Route::post('porto/tax/store', [PortoController::class, 'taxStore'])->name('admin.porto.tax.store');

    Route::get('adress/cep', [PortoController::class, 'buscaCep'])->name('adress.cep.admin');

    Route::get('estatistica/{id}', [EstatiscaDiariaController::class, 'index'])->name('admin.estatistica');
    Route::post('estatistica/store', [EstatiscaDiariaController::class, 'store'])->name('admin.estatistica.store');

    Route::get('cliente', [ClienteController::class, 'index'])->name('admin.clientes');
    Route::get('cliente/edit-ind/{id}', [ClienteController::class, 'editInd'])->name('admin.clientes.edit-ind');
    Route::get('cliente/edit-col/{id}', [ClienteController::class, 'editCol'])->name('admin.clientes.edit-col');
    Route::post('cliente-ind-update/{id}', [ClienteController::class, 'updateIndividual'])->name('admin.update.individual');
    Route::post('cliente-col-update/{id}', [ClienteController::class, 'updateColetivo'])->name('admin.update.coletivo');
    Route::any('cliente-status/{id}', [ClienteController::class, 'ativar'])->name('admin.update.status');

    Route::get('consultor', [ComercialController::class, 'index'])->name('admin.consultores');
    Route::get('consultor-create', [ComercialController::class, 'create'])->name('admin.consultores.create');
    Route::post('consultor-store', [LoginConsultorController::class, 'store'])->name('admin.consultores.store');
    Route::any('consultor-delete/{id}', [LoginConsultorController::class, 'destroy'])->name('admin.consultores.delete');
    Route::any('consultor-edit/{id}', [LoginConsultorController::class, 'edit'])->name('admin.consultores.edit');
    Route::any('consultor-update/{id}', [LoginConsultorController::class, 'update'])->name('admin.consultores.update');
    Route::get('consultor-clientes/{id}', [ComercialController::class, 'clientes'])->name('admin.consultores.clientes');
    Route::get('consultor-email-individual/{id}', [ComercialController::class, 'emailIndividual'])->name('admin.consultores.email.individual');
    Route::get('consultor-email-coletivo/{id}', [ComercialController::class, 'emailColetivo'])->name('admin.consultores.email.coletivo');

    Route::get('encomendas', [EncomendasController::class, 'index'])->name('admin.encomendas');
    Route::get('encomenda/remover/{id}', [EncomendasController::class, 'encomendaRemover'])->name('admin.encomenda.remover');
    Route::get('faturados', [EncomendasController::class, 'faturados'])->name('admin.faturas');
    Route::get('encomendas/download/{id}', [EncomendasController::class, 'download'])->name('admin.encomendas.download');
    Route::any('user/order/status/{id}', [EncomendasController::class, 'status']);
    Route::any('user/produto/status', [EncomendasController::class, 'statusProduto'])->name('admin.status.produto');

    Route::any('user/fatura/{id}', [EncomendasController::class, 'fatura'])->name('admin.status.fatura');
});

Route::get('consultor-login', [LoginConsultorController::class, 'index'])->name('consultor.login-page');
Route::post('consultor-entrar', [LoginConsultorController::class, 'login'])->name('consultor.login');

Route::middleware(['auth:consultor'])->group(function () {
    Route::get('consultor', [ComercialPainelController::class, 'index'])->name('consultor');
    Route::get('comprador-cad', [ComercialPainelController::class, 'compradorCad']);
    Route::get('comprador-individual-create', [CompradorIndividualController::class, 'index'])->name('consultor.comprador-individual.create');
    Route::post('comprador-individual-store', [CompradorIndividualController::class, 'store'])->name('consultor.comprador-individual.store');
    Route::get('comprador-individual-informativo', [CompradorIndividualController::class, 'individualInformativo'])->name('consultor.comprador-individual.informativo');

    Route::get('comprador-coletivo-create', [CompradorColetivoController::class, 'index'])->name('consultor.comprador-coletivo.create');
    Route::post('comprador-coletivo-store', [CompradorColetivoController::class, 'store'])->name('consultor.comprador-coletivo.store');
    Route::get('comprador-coletivo-informativo', [CompradorColetivoController::class, 'coletivoInformativo'])->name('consultor.comprador-coletivo.informativo');

    Route::get('comprador-status/{filter?}', [ComercialPainelController::class, 'compradorStatus'])->name('comprador.status');
    Route::get('comprador-detalhe/{id}/{filter?}', [ComercialPainelController::class, 'compradorDetalhe'])->name('comprador.detalhe');

    Route::get('wallet', [WalletController::class, 'index'])->name('wallet');
    Route::post('wallet-draw', [WalletController::class, 'store'])->name('wallet.draw');
    Route::get('draw-requested', [WalletController::class, 'requested'])->name('draw.requested');

    Route::get('consultor-compradores-ativos', [ComercialPainelController::class, 'compradorListAtivo'])->name('consultor.compradores.ativo');
    Route::get('consultor-compradores-inativos', [ComercialPainelController::class, 'compradorListInativo'])->name('consultor.compradores.inativo');

    Route::get('consultor-list-individual/{id}', [ComercialPainelController::class, 'listIndividual'])->name('consultor.list.individual');
    Route::get('consultor-list-coletivo/{id}', [ComercialPainelController::class, 'listColetivo'])->name('consultor.list.coletivo');

    Route::any('consultor-logout', [LoginConsultorController::class, 'logout'])->name('consultor.logout');

    Route::get('consultor-incompletos', [ComercialPainelController::class, 'incompleto'])->name('consultor.list.incompletos');

    Route::get('consultor-ind-edit/{id}', [ComercialPainelController::class, 'editIndividual'])->name('consultor.edit.individual');
    Route::get('consultor-col-edit/{id}', [ComercialPainelController::class, 'editColetivo'])->name('consultor.edit.coletivo');

    Route::post('consultor-ind-update/{id}', [ComercialPainelController::class, 'updateIndividual'])->name('consultor.update.individual');
    Route::post('consultor-col-update/{id}', [ComercialPainelController::class, 'updateColetivo'])->name('consultor.update.coletivo');

    Route::get('consultor-lead', [ComercialPainelController::class, 'lead'])->name('consultor.lead');
    Route::get('consultor-lead-form1', [ComercialPainelController::class, 'leadForm1'])->name('consultor.lead.individual');
    Route::get('consultor-lead-form2', [ComercialPainelController::class, 'leadForm2'])->name('consultor.lead.coletivo');
    Route::any('teste', [TesteController::class, 'index']);

    Route::get('extractos/{filter?}', [ComercialPainelController::class, 'extracto'])->name('consultor.extracto');
    Route::get('ver-extractos/{id}', [ComercialPainelController::class, 'verExtracto'])->name('consultor.extracto.ver');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*  Login Pescador */

Route::get('login-pescador', [PescadorController::class, 'index'])->name('login.pescador');
Route::get('pescador-create', [PescadorRegController::class, 'index'])->name("pescador.create");
Route::post('pescadores-store', [PescadorRegController::class, 'store'])->name('pescador.store');
Route::post('pescador-login', [PescadorController::class, 'store'])->name('pescador.login');
Route::get('pescadores-sucesso', [PescadorRegController::class, 'successo'])->name('pescador.successo');

Route::middleware('auth:pescador')->group(function () {
    Route::get('pescador', [PainelPescadorController::class, 'index'])->name('pescador.index');
    Route::get('produto', [ProdutoController::class, 'index'])->name('pescador.produto');
    Route::post('produto-store', [ProdutoController::class, 'store'])->name('pescador.produto.store');
    Route::any('produto-delete/{id}', [ProdutoController::class, 'destroy'])->name('pescador.produto.delete');
    Route::get('produto-list', [ProdutoController::class, 'list'])->name('pescador.produto.list');
    Route::get('pescador-logout', [PescadorController::class, 'logout'])->name('pescador.logout');

    Route::get('pescador/pedidos', [PainelPescadorController::class, 'pedidos'])->name('pescador.pedidos');
    Route::any('pescador/produto/status/{id}', [PainelPescadorController::class, 'produtoStatus']);
});

Route::get('store-login-page', [StoreLoginController::class, 'index'])->name('store.login');
Route::post('store-login', [StoreLoginController::class, 'login'])->name('store.login.post');

Route::group(['middleware' => ['auth:buyer']], function () {
    Route::get('store-index', [StoreController::class, 'index'])->name('store.index');
    Route::get('store-index-2', [StoreController::class, 'index'])->name('store.index.2');
    Route::get('store-porto', [StoreController::class, 'porto'])->name('store.porto');
    Route::get('store-produtos/{id}', [StoreController::class, 'produtos'])->name('store.produto');
    Route::get('store-produto-single/{id}', [StoreController::class, 'produto'])->name('store.produto.single');
    Route::get('store-produto-info/{id}', [StoreController::class, 'produtoInfo'])->name('store.produto.info');
    Route::any('store/cart/add', [CartController::class, 'cartAdd'])->name('store.cart.add');
    Route::any('store/cart/clear', [CartController::class, 'clear'])->name('store.cart.clear');

    Route::get('store/cart', [CartController::class, 'cart'])->name('store.cart');
    Route::any('store/cart/remove/{id}', [CartController::class, 'itemRemove'])->name('store.cart.remove');

    Route::get('store/checkout', [CheckoutController::class, 'index'])->name('store.checkout');

    Route::get('store/user/edit-ind/{id}', [BuyerController::class, 'individual'])->name('store.user.edit-ind');
    Route::get('store/user/edit/{id}', [BuyerController::class, 'edit'])->name('store.user.edit');

    Route::post('store/user/update-ind/{id}', [CompradorIndividualController::class, 'update'])->name('store.user.update');


    Route::get('store/checkout/adress', [CheckoutController::class, 'adress'])->name('store.checkout.adress');

    Route::get('store/adress', [AdressController::class, 'index'])->name('store.adress');
    Route::get('adress/cep', [AdressController::class, 'buscaCep'])->name('adress.cep');

    Route::post('store/adress/save', [AdressController::class, 'store'])->name('store.adress.save');

    Route::post('store/checkout/store', [CheckoutController::class, 'payment'])->name('store.checkout.payment');

    Route::get('store/thanks', [CheckoutController::class, 'thanks'])->name('store.thanks');
    Route::post('payimage/store', [CheckoutController::class, 'payImage'])->name('pay.image.store');

    Route::get('porto/buscar', [StoreController::class, 'portoSearch'])->name('store.porto.buscar');
    Route::get('produto/buscar', [StoreController::class, 'produtoSearch'])->name('store.produto.buscar');

    Route::get('store/pedidos', [PedidoController::class, 'userPedido'])->name('user.pedidos');
    Route::get('store/pedidos/produtos/{id}', [PedidoController::class, 'pedidoDatalheUser'])->name('user.pedido.produto');

    Route::any('user/produto/status/', [PedidoController::class, 'produtoStatus'])->name('user.produto.status');

    Route::get('user-logout', [BuyerController::class, 'logout'])->name('user.logout');
});

Route::get('consultor/adress/cep', [AdressController::class, 'buscaCep']);
Route::get('comprador-create', [CompradorIndividualController::class, 'home'])->name('comprador.create');
Route::post('comprador-create-store', [CompradorIndividualController::class, 'storeHome'])->name('comprador.create.store');

Route::get('front/status', function () {
    return view('store.pages.user.status');
});
Route::get('front/encomenda', function () {
    return view('store.pages.user.encomenda');
});
