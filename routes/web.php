<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AuthAdmin\LoginController as AdminLoginController;

use App\Http\Controllers\AuthAdmin\ForgotPasswordController as AdminForgotPasswordController;
use App\Http\Controllers\AuthAdmin\ResetPasswordController as AdminResetPasswordController;
use App\Http\Controllers\AuthAdmin\VerificationController as AdminVerificationController;


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
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('email/reset', [VerificationController::class, 'resend'])->name('verification.resend');
// Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
// Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::middleware('auth:web')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/', function () { return view('welcome'); })->name('welcome');

// Importante: os midd funcionam em cascata, uma depois a outra na ordem que foi colocado.
Route::middleware(['auth:web' ])->group(function () { // rotas para completar o cadastro do academico
    Route::get('academico/create', 'App\Http\Controllers\AcademicoController@create')->name('academico.create');
    Route::post('academico', 'App\Http\Controllers\AcademicoController@store')->name('academico.store');
    Route::get('academicoEstagio/create/{empresa}/{academico}', 'App\Http\Controllers\AcademicoEstagioController@create')->name('academicoEstagio.create');
    Route::post('academicoEstagio', 'App\Http\Controllers\AcademicoEstagioController@store')->name('academicoEstagio.store');
    Route::get('empresa/create', 'App\Http\Controllers\EmpresaController@create')->name('empresa.create');
    Route::post('empresa', 'App\Http\Controllers\EmpresaController@store')->name('empresa.store');
    Route::get('academicoTCC/create/{academico}', 'App\Http\Controllers\AcademicoTCCController@create')->name('academicoTCC.create');
    Route::post('academicoTCC', 'App\Http\Controllers\AcademicoTCCController@store')->name('academicoTCC.store');
    Route::resource('academico', App\Http\Controllers\AcademicoController::class)->except(['create', 'store', 'show', 'index', 'destroy']);
});

Route::middleware(['auth:web', 'primeiro_acesso' ])->group(function () { //
    Route::get('academico/{user}', 'App\Http\Controllers\AcademicoController@show')->name('academico.show');

    Route::resource('academicoEstagio', App\Http\Controllers\AcademicoEstagioController::class)->except(['create', 'store']);
    Route::resource('empresa', App\Http\Controllers\EmpresaController::class)->except(['create', 'store']);
    Route::resource('solicitacao', App\Http\Controllers\SolicitacaoController::class)->names(['show' => 'solicitacao.show.web'])->except(['create', 'index']);
    Route::resource('academicoTCC', App\Http\Controllers\AcademicoTCCController::class)->except(['create', 'store', 'destroy']);
    Route::get('solicitacao/{orientador}/{academico}', 'App\Http\Controllers\SolicitacaoController@create')->name('solicitacao.create');

});

Route::middleware(['auth:web', 'primeiro_acesso' ])->group(function () {
    /**
     * Esta rota /home aqui vale apenas para academico, pq o /home para admin&orientador vai direto para /admin/home, e /admin/home na linha 93 nao tem o semestre_ativo
     */
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::post('arquivo-submissao/{submissao}', [App\Http\Controllers\ArquivoController::class, 'storeArquivoSubmissao'])->name('arquivo.store.arquivo.submissao');
    Route::delete('destroy/arquivo-submissao/{arquivo}', [App\Http\Controllers\ArquivoController::class, 'destroyArquivoSubmissao'])->name('arquivo.destroy.arquivo.submissao');
    Route::prefix('academico')->name('academico.')->group(function () {
        Route::get('atividade/{atividade}', [App\Http\Controllers\AtividadeAcademicoController::class, 'show'])->name('atividade.show');
        Route::post('atividade', [App\Http\Controllers\AtividadeAcademicoController::class, 'storeSubmissao'])->name('atividade.store.submissao');
        Route::delete('atividade/destroy/submissao/{submissao}', [App\Http\Controllers\AtividadeAcademicoController::class, 'destroySubmissao'])->name('atividade.destroy.submissao');
    });

    Route::get('academico/{user}', 'App\Http\Controllers\AcademicoController@show')->name('academico.show');
    Route::resource('academicoEstagio', App\Http\Controllers\AcademicoEstagioController::class)->except(['create', 'store']);
    Route::resource('empresa', App\Http\Controllers\EmpresaController::class)->except(['create', 'store']);
    Route::resource('solicitacao', App\Http\Controllers\SolicitacaoController::class)->names(['show' => 'solicitacao.show.web'])->except(['create', 'index']);
    Route::resource('academicoTCC', App\Http\Controllers\AcademicoTCCController::class)->except(['create', 'store', 'destroy']);
    Route::get('solicitacao/{orientador}/{academico}', 'App\Http\Controllers\SolicitacaoController@create')->name('solicitacao.create');
});

Route::post('download/arquivo/auxiliar/', 'App\Http\Controllers\ArquivoController@downloadArquivo')->name('download.arquivo');
Route::post('mudar/semestre', [App\Http\Controllers\SemestreController::class, 'mudar_semestre'])->name('semestre.mudar-semestre');
Route::resource('comentario', App\Http\Controllers\ComentarioController::class)->only(['store', 'update', 'destroy']);



// =========================================================================== ADMIN & ORIENTADOR ==========================================

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login.index');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('password.update');
    // Route::post('email/reset', [AdminVerificationController::class, 'resend'])->name('verification.resend');
    // Route::get('email/verify', [AdminVerificationController::class, 'show'])->name('verification.notice');
    // Route::get('email/verify/{id}/{hash}', [AdminVerificationController::class, 'verify'])->name('verification.verify');

    Route::middleware(['auth:admin'])->group(function () {                                 // rotas ADMIN c prefixo ANTES DE ATIVAR O SEMESTRE
        Route::get('/', function () { return redirect()->route('admin.home'); });

        Route::get('/permission', 'App\Http\Controllers\Admin\PermissionController@index')->name('permission.index');
        Route::resource('role', App\Http\Controllers\Admin\RoleController::class);
        Route::get('role/edit/permissoes/{role}', 'App\Http\Controllers\Admin\RoleController@edit_permissions')->name('role.edit-permissions');
        Route::post('role/update/permissoes/{role}', 'App\Http\Controllers\Admin\RoleController@update_permissions')->name('role.update-permissions');
        Route::resource('semestre', App\Http\Controllers\SemestreController::class);

        Route::post('orientador/download/modelo/planilha', 'App\Http\Controllers\OrientadorAdminController@downloadModeloPlanilha')->name('orientador.download.modelo.planilha');
        Route::post('cadastro/orientador/planilha', 'App\Http\Controllers\OrientadorAdminController@import_orientadores')->name('cadastro.planilha.orientador');
        Route::resource('orientador', App\Http\Controllers\OrientadorAdminController::class);
        
        Route::resource('academico', App\Http\Controllers\AcademicoAdminController::class);
        Route::post('desvincular/academico/tcc/{tcc}', 'App\Http\Controllers\AcademicoAdminController@desvincular_academico_tcc')->name('academico.desvincular.tcc');
        Route::post('academico/download/modelo/planilha', 'App\Http\Controllers\AcademicoAdminController@downloadModeloPlanilha')->name('academico.download.modelo.planilha');
        Route::post('desvincular/academico/estagio/{estagio}', 'App\Http\Controllers\AcademicoAdminController@desvincular_academico_estagio')->name('academico.desvincular.estagio');
        Route::post('cadastro/academico/planilha', 'App\Http\Controllers\AcademicoAdminController@import_academicos')->name('cadastro.planilha.academico');
        
        Route::resource('atividade', App\Http\Controllers\AtividadeAdminController::class)->except(['create', 'store', 'edit', 'update']);
        
        Route::get('orientacao', 'App\Http\Controllers\OrientacaoAdminController@index')->name('orientacao.index');
        Route::post('orientacao/pdf', 'App\Http\Controllers\OrientacaoAdminController@exportPdf')->name('orientacao.exportPdf');
    });
});




Route::middleware(['auth:admin' , 'primeiro_acesso'])->group(function () {          // ROTAS ORIENTADOR
    Route::get('admin/home', [AdminHomeController::class, 'index'])->name('admin.home');
    
    Route::get('orientador/academico/{academico}', [App\Http\Controllers\OrientadorController::class, 'showAcademico'])->name('orientador.academico.show');
    Route::resource('orientador/atividade', App\Http\Controllers\AtividadeOrientadorController::class, ['as' => 'orientador']);
    
    Route::delete('destroy/arquivo-aux/{arquivo}', 'App\Http\Controllers\AtividadeOrientadorController@destroyArquivoAux')->name('arquivo.destroy.arquivo.aux');
    
    Route::prefix('orientador')->name('orientador.')->group(function () {
        Route::put('avaliacao/final/{orientacao}', [App\Http\Controllers\OrientadorController::class, 'avaliar'])->name('avaliacao.store');
        Route::post('aceitar/solicitacao/{solicitacao}', [App\Http\Controllers\SolicitacaoOrientadorController::class, 'aceitar_solicitacao'])->name('solicitacao.aceitar');
        Route::post('rejeitar/solicitacao/{solicitacao}', [App\Http\Controllers\SolicitacaoOrientadorController::class, 'rejeitar_solicitacao'])->name('solicitacao.rejeitar');
        Route::get('solicitacao/{solicitacao}', [App\Http\Controllers\SolicitacaoOrientadorController::class, 'show'])->name('solicitacao.show');
        
        Route::post('atividade/arquivo-aux/{atividade}', 'App\Http\Controllers\ArquivoController@storeArquivoAux')->name('atividade.store.arquivo.aux');
        Route::post('atividade/avaliar/{atividade}', 'App\Http\Controllers\AtividadeOrientadorController@avaliar')->name('atividade.avaliar');
    }); 
});


Route::middleware(['auth:admin' ])->group(function () { // ROTAS ORIENTADOR
    Route::get('orientador/create', 'App\Http\Controllers\OrientadorController@create')->name('orientador.create');
    Route::post('orientador/{orientador}', 'App\Http\Controllers\OrientadorController@store')->name('orientador.store');
    Route::get('orientador/{orientador}', [App\Http\Controllers\OrientadorController::class, 'show'])->name('orientador.show');
    Route::get('orientador/{orientador}/edit', [App\Http\Controllers\OrientadorController::class, 'edit'])->name('orientador.edit');
    Route::put('orientador/{orientador}', [App\Http\Controllers\OrientadorController::class, 'update'])->name('orientador.update');
});




// Route::middleware('auth')->group(function () {
// });

// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware(['auth', 'is_admin', 'role:admin'])->name('index');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


