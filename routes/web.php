<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MicrosoftController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function ()
{
    return redirect()->route('login');
});

Route::prefix('dashboard')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function()
    {
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::group(['middleware' => 'admin'], function()
        {
            Route::resource('users', UserController::class)
                ->missing(function ()
                {
                    return response()->view('not-found');
                });
    
            Route::resource('foods', FoodController::class)
                ->missing(function ()
                {
                    return response()->view('not-found');
                });
    
            Route::get('transactions/{id}/status/{status}', [TransactionController::class, 'changeStatus'])->name('transactions.changeStatus');
    
            Route::resource('transactions', TransactionController::class)
                ->missing(function ()
                {
                    return response()->view('not-found');
                });
        });
        
    });

// midtrans
Route::get('/midtrans/succeed', function ()
{
    return view('midtrans.succeed');
});

Route::get('/midtrans/failed', function ()
{
    return view('midtrans.failed');
});

Route::get('/midtrans/unfinished', function ()
{
    return view('midtrans.unfinished');
});

// Socialite
Route::get('/auth/redirect/google', [GoogleController::class, 'redirect'])->name('sso.google');
Route::get('/auth/redirect/google/callback', [GoogleController::class, 'HandlingCallback']);

Route::get('/auth/redirect/github', [GithubController::class, 'redirect'])->name('sso.github');
Route::get('/auth/redirect/github/callback', [GithubController::class, 'HandlingCallback']);

Route::get('/auth/redirect/azure', [MicrosoftController::class, 'redirect'])->name('sso.azure');
Route::get('/auth/redirect/azure/callback', [MicrosoftController::class, 'HandlingCallback']);

Route::get('/auth/redirect/microsoft', [MicrosoftController::class, 'redirect'])->name('sso.microsoft');
Route::get('/auth/redirect/microsoft/callback', [MicrosoftController::class, 'HandlingCallback']);