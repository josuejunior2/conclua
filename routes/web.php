<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;

use App\Http\Controllers\AuthAdmin\LoginController as AdminLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ->middleware('verified'); // é pra pedir verificação do email
// Auth::routes();
//Auth::routes(['verify' => true]); // verifica se tá logado

// ====================================================== USER ==========================================================================
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware('auth:web')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/', function () { return view('welcome'); })->name('welcome');

// Importante: os midd funcionam em cascata, uma depois a outra na ordem que foi colocado.
Route::middleware(['auth:web', 'semestre_ativo'])->group(function () { // rotas para completar o cadastro do academico
    Route::get('academico/create', 'App\Http\Controllers\AcademicoController@create')->name('academico.create');
    Route::post('academico', 'App\Http\Controllers\AcademicoController@store')->name('academico.store');
    Route::get('academicoEstagio/create/{empresa}/{academico}', 'App\Http\Controllers\AcademicoEstagioController@create')->name('academicoEstagio.create');
    Route::post('academicoEstagio', 'App\Http\Controllers\AcademicoEstagioController@store')->name('academicoEstagio.store');
    Route::get('empresa/create', 'App\Http\Controllers\EmpresaController@create')->name('empresa.create');
    Route::post('empresa', 'App\Http\Controllers\EmpresaController@store')->name('empresa.store');
    Route::get('academicoTCC/create/{academico}', 'App\Http\Controllers\AcademicoTCCController@create')->name('academicoTCC.create');
    Route::post('academicoTCC', 'App\Http\Controllers\AcademicoTCCController@store')->name('academicoTCC.store');
    });
Route::resource('academico', App\Http\Controllers\AcademicoController::class)->except(['create', 'store', 'show', 'index', 'destroy']);

Route::middleware(['auth:web', 'primeiro_acesso', 'semestre_ativo'])->group(function () { //
    Route::get('academico/{user}', 'App\Http\Controllers\AcademicoController@show')->name('academico.show');

    Route::resource('academicoEstagio', App\Http\Controllers\AcademicoEstagioController::class)->except(['create', 'store']);
    Route::resource('empresa', App\Http\Controllers\EmpresaController::class)->except(['create', 'store']);
    Route::resource('solicitacao', App\Http\Controllers\SolicitacaoController::class)->names(['show' => 'solicitacao.show.web'])->except(['create', 'index']);
    Route::resource('academicoTCC', App\Http\Controllers\AcademicoTCCController::class)->except(['create', 'store', 'destroy']);
    Route::get('solicitacao/{orientador}/{academico}', 'App\Http\Controllers\SolicitacaoController@create')->name('solicitacao.create');

});

Route::middleware(['auth:web', 'primeiro_acesso', 'semestre_ativo'])->group(function () {
    /**
     * Esta rota /home aqui vale apenas para academico, pq o /home para admin&orientador vai direto para /admin/home, e /admin/home na linha 93 nao tem o semestre_ativo
     */
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


Route::post('mudar/semestre', [App\Http\Controllers\SemestreController::class, 'mudar_semestre'])->name('semestre.mudar-semestre');

// =========================================================================== ADMIN & ORIENTADOR ==========================================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login.index');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin'])->group(function () {                                 // rotas ADMIN c prefixo ANTES DE ATIVAR O SEMESTRE
        Route::get('/', function () { return redirect()->route('admin.home'); });

        Route::get('/permission', 'App\Http\Controllers\Admin\PermissionController@index')->name('permission.index');
        Route::resource('role', App\Http\Controllers\Admin\RoleController::class);
        Route::get('role/edit/permissoes/{role}', 'App\Http\Controllers\Admin\RoleController@edit_permissions')->name('role.edit-permissions');
        Route::post('role/update/permissoes/{role}', 'App\Http\Controllers\Admin\RoleController@update_permissions')->name('role.update-permissions');
        Route::resource('semestre', App\Http\Controllers\SemestreController::class);
        // Route::post('ativar/semestre/{semestre}', [App\Http\Controllers\SemestreController::class, 'ativar'])->name('semestre.ativar');
        // Route::post('desativar/semestre/{semestre}', [App\Http\Controllers\SemestreController::class, 'desativar'])->name('semestre.desativar');

        Route::post('orientador/download/modelo/planilha', 'App\Http\Controllers\OrientadorAdminController@downloadModeloPlanilha')->name('orientador.download.modelo.planilha');
        Route::get('orientador/{orientador}', 'App\Http\Controllers\OrientadorAdminController@show')->name('orientador.show');
        Route::delete('orientador/{orientador}', 'App\Http\Controllers\OrientadorAdminController@destroy')->name('orientador.destroy');
        Route::get('orientador', 'App\Http\Controllers\OrientadorAdminController@index')->name('orientador.index');
        Route::post('cadastro/orientador', 'App\Http\Controllers\OrientadorAdminController@import_orientadores')->name('cadastro-orientador');
        
        Route::post('academico/download/modelo/planilha', 'App\Http\Controllers\AcademicoAdminController@downloadModeloPlanilha')->name('academico.download.modelo.planilha');
        Route::post('desvincular/academico/estagio/{estagio}', 'App\Http\Controllers\AcademicoAdminController@desvincular_academico_estagio')->name('academico.desvincular.estagio');
        Route::post('desvincular/academico/tcc/{tcc}', 'App\Http\Controllers\AcademicoAdminController@desvincular_academico_tcc')->name('academico.desvincular.tcc');
        Route::post('cadastro/academico', 'App\Http\Controllers\AcademicoAdminController@import_academicos')->name('cadastro-academico');
        Route::delete('academico/delete/{academico}', 'App\Http\Controllers\AcademicoAdminController@destroy')->name('academico.destroy');
        Route::get('academico', 'App\Http\Controllers\AcademicoAdminController@index')->name('academico.index');
        Route::get('academico/{academico}', 'App\Http\Controllers\AcademicoAdminController@show')->name('academico.show');
    });
});


Route::middleware(['auth:admin', 'semestre_ativo'])->group(function () {
    Route::get('orientador/create', 'App\Http\Controllers\OrientadorController@create')->name('orientador.create');
    Route::post('orientador/{orientador}', 'App\Http\Controllers\OrientadorController@store')->name('orientador.store');
});

Route::middleware(['auth:admin', 'semestre_ativo', 'primeiro_acesso'])->group(function () { // rotas normal ANTES DE ATIVAR O SEMESTRE
    Route::get('admin/home', [AdminHomeController::class, 'index'])->name('admin.home');
    Route::resource('orientador', App\Http\Controllers\OrientadorController::class)->except(['create', 'store', 'index', 'destroy']);
    
    Route::resource('atividade', App\Http\Controllers\AtividadeController::class);
});

Route::middleware(['auth:admin', 'semestre_ativo', 'primeiro_acesso'])->group(function () { // ORIENTADOR. SEMESTRE ATIVO

    Route::post('orientador/aceitar/solicitacao/{solicitacao}', [App\Http\Controllers\SolicitacaoOrientadorController::class, 'aceitar_solicitacao'])->name('solicitacao.orientador.aceitar');
    Route::post('orientador/rejeitar/solicitacao/{solicitacao}', [App\Http\Controllers\SolicitacaoOrientadorController::class, 'rejeitar_solicitacao'])->name('solicitacao.orientador.rejeitar');
    Route::get('orientador/solicitacao/{solicitacao}', [App\Http\Controllers\SolicitacaoOrientadorController::class, 'show'])->name('solicitacao.orientador.show');
    // essas abaixo eu nao pensei ainda
});

// Route::middleware('auth')->group(function () {
// });

// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware(['auth', 'is_admin', 'role:admin'])->name('index');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


