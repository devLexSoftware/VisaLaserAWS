<?php
 
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

//www.miPagina.com
// Route::get('/', function () {
//     return view('welcome');
// });

// //www.miPagina.com/pagina1
// Route::get('pagina1', function () {
//     return view('pagina1');
// });



Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'clientsController@dashboard')->name('admin.dashboard');
    // Route::get('/', 'AdminController@index')->name('admin.dashboard');
});


//dashboard
Route::get('dashboard', function()
{
    if(Auth::guard('admin')->check()){
        // return View::make('pages.pageDash');
        Route::get('clientes', 'clientsController@clientesPendientesInicial');
    }
    else{
        return View::make('pages.home');
    }    
    
});

Route::get('clientesEdicion/{id}', ['as' => 'clientesEdicion', 'uses' => 'clientsController@clienteEdicion']);



// Route::get('clientesEdicion', 'clientsController@clienteEdicion');


Route::get('clientesPendientes', 'clientsController@clientesPendientes');
Route::get('clientesNoRevisados', 'clientsController@clientesSinRevisar');
Route::get('clientesRevisadas', 'clientsController@clientesRevisadas');
Route::get('clientes', 'clientsController@clientesTodos');



Route::post('/clientesEdicion/{id}', 'clientsController@saveClientInformation');





Route::get('/', function()
{
    return View::make('pages.home');
});
Route::get('home', function()
{
    return View::make('pages.home');
});
Route::get('about', function()
{
    return View::make('pages.about');
});
Route::get('projects', function()
{
    return View::make('pages.projects');
});
Route::get('contact', function()
{
    return View::make('pages.contact');
});
// Route::get('perfil', function()
// {
//     return View::make('pages.completeUser');
// });




Route::get('login', function()
{
    return View::make('public.login');
});

Route::get('tramite', function()
{
    return View::make('pages.register');
});

Route::post('registerStatus', 'registerController@status');

Route::post('registerPaymethod', 'registerController@registerPaymethod');

Route::get('registerUser', function()
{
    return View::make('pages.registerUser');
});

Route::get('registerComplete', function()
{
    return View::make('pages.registerComplete');
})->name('registerComplete');

Route::get('perfil', 'completeUserController@show');
Route::get('logout', 'LoginController@logout');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::post('savePerfil', 'completeUserController@savePerfil');

Route::post('saveBasica', 'completeUserController@saveBasica');
Route::post('saveFamiliar', 'completeUserController@saveFamiliar');
Route::post('saveEducacion', 'completeUserController@saveEducacion');


// // Route::get('create_paypal_plan', 'PaypalController@create_plan');
// Route::get('/subscribe/paypal', 'PaypalController@paypalRedirect')->name('paypal.redirect');
// Route::get('/subscribe/paypal/return', 'PaypalController@paypalReturn')->name('paypal.return');

// Route::get('', array(
// 	'as' => 'payment',
// 	'uses' => 'PaypalController@postPayment',
// ));


Route::get('payment', array(
	'as' => 'payment',
	'uses' => 'PaypalController@postPayment',
));

Route::get('payment/status', array(
	'as' => 'payment.status',
	'uses' => 'PaypalController@getPaymentStatus',
));


Auth::routes();



// Route::group( ['middleware' => 'auth' ], function()
// {
//     Route::get('login/index', 'AdminController@index');
//     Route::get('login/ajuda', 'AdminController@ajuda');
// });

// Route::get('/', 'HomeController@index')->name('home');
