<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RifaController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, 'register'])->name('user.register');
Route::post('login', [UserController::class, 'login'])->name('user.login');



Route::group( ['middleware' => ['auth:sanctum']], function() {
    Route::get('user-profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('logout', [UserController::class, 'logout'])->name('user.logout');

//    Route::get('tickets/{rifaId}', [TicketController::class, 'index']);
    Route::get('tickets', [TicketController::class, 'index']);
    Route::get('tickets-active-project', [TicketController::class, 'getTicketsActiveProject']);
    Route::get('tickets/{ticket}', [TicketController::class, 'show']);
    Route::get('tickets-sold', [TicketController::class, 'sold']);
    Route::get('tickets-unsold', [TicketController::class, 'unsold']);
    Route::post('registre-sell', [TicketController::class, 'registreSell']);

    Route::get('clients', [CustomerController::class, 'index']);
    Route::post('clients', [CustomerController::class, 'store']);
    Route::get('clients/{identification}', [CustomerController::class, 'search']);

    Route::get('rifas', [RifaController::class, 'index']);
    Route::get('rifas/{rifa}', [RifaController::class, 'show']);
    Route::post('rifas', [RifaController::class, 'store']);
    Route::put('rifas/{rifa}', [RifaController::class, 'update']);
    Route::delete('rifas/{rifa}', [RifaController::class, 'destroy']);

    Route::post('payments', [PaymentController::class, 'store']);

    Route::post('companies', [CompanyController::class, 'store']);

    Route::post('customers', [CustomerController::class, 'store']);

});
