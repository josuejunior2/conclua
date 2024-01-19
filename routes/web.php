<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', function () {
    return view('home');
})->middleware('auth');





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

Route::prefix('admin')->name('admin.')->namespace('AuthAdmin')->group(function () {

    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login.index');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('home', [AdminHomeController::class, 'index'])->name('home');
    });
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
});




Route::resource('orientadorgeral', App\Http\Controllers\OrientadorGeralController::class);
Route::resource('academico', App\Http\Controllers\AcademicoController::class);
// Route::resource('academicoEstagio', App\Http\Controllers\AcademicoEstagioController::class);
// Route::resource('academicoTCC', App\Http\Controllers\AcademicoTCCController::class);
Route::resource('orientador', App\Http\Controllers\OrientadorController::class)->names([
    'create' => 'c'
]);
Route::get('orientador/create/{orientadorgeral_id}', 'App\Http\Controllers\OrientadorController@create')->name('orientador.create');


// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware(['auth', 'is_admin', 'role:admin'])->name('index');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
