<?php

use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::get('/',function (){
    return redirect()->route('login');
});
Route::get('/login',[ManageUsersController::class,'loginView'])->name('login');
Route::post('/login',[ManageUsersController::class,'login'])->name('ticket.login.submit');

// Ticketing
Route::group(['middleware' => 'auth'],function (){
    Route::get('/ticket',[TicketController::class,'index'])->name('ticket.index');
    Route::get('/ticket/{id}',[TicketController::class,'single'])->name('ticket.single');
    Route::get('/download/{path}',[TicketController::class,'downloadTicketMedia'])->name('download');
    Route::post('/ticket',[TicketController::class,'store'])->name('ticket.store');
    Route::post('/ticket/change-state/{id}',[TicketController::class,'changeState'])->name('ticket.change.state');
    // store bu dropzone
    Route::post('/ticket/dropzone',[TicketController::class,'storeFile'])->name('dropzone');

    Route::get('logout',[ManageUsersController::class,'logout'])->name('logout');
});

