<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
    return view('welcome');
});
/*|--------------------------------------------------------------------------|*/

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', 'App\Http\Controllers\Auth\VerificationController@verify')
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


/*|--------------------------------------------------------------------------|*/


Route::get('/register', [RegisterController::class, 'showRegistrationForm']) ->name('register');
Route::post('/register', [RegisterController::class,'storeDB']);

    
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'doLogin']);
Route::delete('/logout', [LoginController::class,'logout'])
->middleware('auth')
->name('logout');
/*|--------------------------------------------------------------------------|*/

Route::get('/home', function () {
    return view('site.home');
});

