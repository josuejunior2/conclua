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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::middleware('auth:web')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


// =========================================================================== ADMIN & ORIENTADOR ==========================================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login.index');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', function () { return redirect()->route('admin.home'); });
        Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
        Route::resource('semestre', App\Http\Controllers\SemestreController::class);
        Route::post('ativar/{semestre}', [App\Http\Controllers\SemestreController::class, 'ativar'])->name('semestre.ativar');
        Route::post('desativar/{semestre}', [App\Http\Controllers\SemestreController::class, 'desativar'])->name('semestre.desativar');
        Route::post('cadastro/orientador', [AdminController::class, 'import_orientadores'])->name('cadastro-orientador');
        Route::post('cadastro/academico', [AdminController::class, 'import_academicos'])->name('cadastro-academico');
        Route::get('listar/orientadores', [AdminController::class, 'listar_orientadores'])->name('listar.orientadores')->middleware('semestre_ativo');
        Route::get('listar/academicos', [AdminController::class, 'listar_academicos'])->name('listar.academicos');
    });
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
});
Route::middleware(['auth:admin', 'auth', 'primeiro_acesso'])->group(function () {
    // coloquei estas rotas sem middleware para nao dar loop                                                     VVVVVV
    Route::get('orientadorgeral/create', 'App\Http\Controllers\OrientadorGeralController@create')->name('orientadorgeral.create')->withoutMiddleware(['primeiro_acesso']);
    Route::post('orientadorgeral', 'App\Http\Controllers\OrientadorGeralController@store')->name('orientadorgeral.store')->withoutMiddleware(['primeiro_acesso']);
    Route::get('orientador/create/{orientadorgeral_id}', 'App\Http\Controllers\OrientadorController@create')->name('orientador.create')->withoutMiddleware(['primeiro_acesso']);
    Route::post('orientador', 'App\Http\Controllers\OrientadorController@store')->name('orientador.store')->withoutMiddleware(['primeiro_acesso']);
    // se eu colocar ^ os create abaixo dos resource, vai dar ERR_TOO_MANY_REDIRECTS, APESAR de ter o except ali V .... ???

    // essas abaixo eu nao pensei ainda
    Route::resource('orientadorgeral', App\Http\Controllers\OrientadorGeralController::class)->except(['create', 'store']);
    Route::resource('academico', App\Http\Controllers\AcademicoController::class)->except(['create', 'store']);
    Route::resource('academicoEstagio', App\Http\Controllers\AcademicoEstagioController::class)->except(['create', 'store']);
    Route::resource('empresa', App\Http\Controllers\EmpresaController::class)->except(['create', 'store']);
    Route::resource('academicoTCC', App\Http\Controllers\AcademicoTCCController::class)->except(['create', 'store']);
    Route::resource('orientador', App\Http\Controllers\OrientadorController::class)->except(['create', 'store']);


});





// ====================================================== USER ==========================================================================
Route::middleware(['auth', 'primeiro_acesso'])->group(function () { //
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', function () { return view('welcome'); });

    // coloquei estas rotas sem middleware para nao dar loop                                                     VVVVVV
    Route::get('academico/create', 'App\Http\Controllers\AcademicoController@create')->name('academico.create')->withoutMiddleware(['primeiro_acesso']);
    Route::post('academico', 'App\Http\Controllers\AcademicoController@store')->name('academico.store')->withoutMiddleware(['primeiro_acesso']);
    Route::get('academicoEstagio/create/{empresa}', 'App\Http\Controllers\AcademicoEstagioController@create')->name('academicoEstagio.create')->withoutMiddleware(['primeiro_acesso']);
    Route::post('academicoEstagio', 'App\Http\Controllers\AcademicoEstagioController@store')->name('academicoEstagio.store')->withoutMiddleware(['primeiro_acesso']);
    Route::get('empresa/create', 'App\Http\Controllers\EmpresaController@create')->name('empresa.create')->withoutMiddleware(['primeiro_acesso']);
    Route::post('empresa', 'App\Http\Controllers\EmpresaController@store')->name('empresa.store')->withoutMiddleware(['primeiro_acesso']);
    Route::get('academicoTCC/create', 'App\Http\Controllers\AcademicoTCCController@create')->name('academicoTCC.create')->withoutMiddleware(['primeiro_acesso']);
    Route::post('academicoTCC', 'App\Http\Controllers\AcademicoTCCController@store')->name('academicoTCC.store')->withoutMiddleware(['primeiro_acesso']);
});



// Route::middleware('auth')->group(function () {
// });

// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware(['auth', 'is_admin', 'role:admin'])->name('index');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


