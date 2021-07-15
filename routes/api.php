<?php
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CustomersController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [
   UserController::class, 'register'
]);
Route::post('/login', [UserController::class, 'login']);


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/sendPasswordResetLink', 'App\Http\Controllers\PasswordResetRequestController@forgotPassword');
    //Route::get('/email/verify/{id}',[VerificationController::class,'verify']);
    Route::post('/resetPassword', 'App\Http\Controllers\ChangePasswordController@resetPassword');

});

Route::post('/upload', [
    FileController::class, 'upload'
])->middleware('auth.jwt');

Route::get('/displayBooks', [
    FileController::class, 'displayBooks'
])->middleware('auth.jwt');

Route::get('/displayParticularBook/{id}', [
    FileController::class, 'displayParticularBook'
])->middleware('auth.jwt');

Route::put('/updateBook/{id}', [
    FileController::class, 'updateBook'
])->middleware('auth.jwt');

Route::delete('/deleteBook/{id}', [
    FileController::class, 'deleteBook'
])->middleware('auth.jwt');

Route::get('/searchBooksByAuthor/{author}', [
    FileController::class, 'searchBooksByAuthor'
])->middleware('auth.jwt');

Route::get('/searchbooks/{name}', [
    FileController::class, 'searchbooks'
])->middleware('auth.jwt');

Route::get('/searchBooksbyPrice/{price}', [
    FileController::class, 'searchBooksbyPrice'
])->middleware('auth.jwt');

Route::get('/sortBooksHighToLow', [
    FileController::class, 'sortBooksHighToLow'
])->middleware('auth.jwt');

Route::get('/sortBooksLowToHigh', [
    FileController::class, 'sortBooksLowToHigh'
])->middleware('auth.jwt');

Route::get('/cart', [
    FileController::class, 'cartItem'
])->middleware('auth.jwt');

Route::put('/addToCart/{id}', [
    FileController::class, 'addToCart'
])->middleware('auth.jwt');

Route::delete('/removeFromCart/{id}', [
    FileController::class, 'removeFromCart'
])->middleware('auth.jwt');

Route::post('customerRegistration', 
    [CustomersController::class, 'customerRegistration'
])->middleware('auth.jwt');

Route::post('mail',
    [CustomersController::class,'orderSuccessfull'
])->middleware('auth.jwt');

Route::get('orderid/{customer_id}',
    [CustomersController::class,'getOrderID'
])->middleware('auth.jwt');