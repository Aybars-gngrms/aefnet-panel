<?php

use Illuminate\Support\Facades\Route;

//! Login Controller
use App\Http\Controllers\AuthController;

//! Home Controller
use App\Http\Controllers\HomeController;

//! User Process Controller
use App\Http\Controllers\GamerProcessMessageListController;
use App\Http\Controllers\UserNickEXceptionalController;

//! System Controller
use App\Http\Controllers\LogRecordingController;
use App\Http\Controllers\WebSettingsController;
use App\Http\Controllers\GameSettingsController;

//! User Process Component
use App\Http\Livewire\GamerProcessComponent;
use App\Http\Livewire\GamerDataComponent;

//! Gamer Ban Component
use App\Http\Livewire\GamerBanComponent;
use App\Http\Livewire\GamerBanListComponent;

//! Managers Component
use App\Http\Livewire\SystemAuthoritiesComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
//dene bakalım simdi
Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::middleware('isLogin')->group(function () {

    Route::post('/login/post', [AuthController::class, 'login_post'])->name('login.post');
    Route::get('/login/forgot-password', [AuthController::class, 'forgot_password'])->name('login.forgot');
    Route::post('/login/forgot-password/post', [AuthController::class, 'forgot_password_email_post'])->name('login.email');
    Route::get('/login/forgot-password/verify-code', [AuthController::class, 'verify_code'])->name('login.verify-code');
    Route::post('/login/forgot-password/verify-code/post', [AuthController::class, 'verify_code_post'])->name('login.verify-code.post');
    Route::get('/login/forgot-password/new-password', [AuthController::class, 'new_password'])->name('login.new-password');
    Route::post('/login/forgot-password/new-password/post', [AuthController::class, 'new_password_post'])->name('login.new-password.post');


});
//Route::get('/home', [HomeController::class, 'index'])->middleware('isModeratör')->name('index');
//isVerify
Route::group(['middleware' => ['isVerify']], function () {

    //? Home
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    //? User Process
    //? Gamer Process
    Route::get('/gamer-process', GamerProcessComponent::class)->middleware('isModeratör')->name('gamer-process.index');
    Route::get('/gamer-process/messages/{gamer_id}/list', [GamerProcessMessageListController::class, 'index'])->middleware('isModeratör')->name('gamer-process.messages');
    Route::get('/gamer-process/messages/{gamer_id}/delete', [GamerProcessMessageListController::class, 'messageDelete'])->middleware('isModeratör')->name('gamer-process.messages.delete');
    //? Gamer Data
    Route::get('/gamer-data', GamerDataComponent::class)->middleware('isModeratör')->name('gamer-data.index');
    //? User Nick Exceptional
    Route::get('/user-nick-exceptional', [UserNickEXceptionalController::class, 'index'])->middleware('isModeratör')->name('user-nick-exceptional.index');
    Route::post('/user-nick-exceptional/delete/{id}', [UserNickEXceptionalController::class, 'deleteExceptional'])->middleware('isModeratör')->name('user-nick-exceptional.exceptional.delete');
    //? Gamer Ban Process
    //? Gamer Ban
    Route::get('/gamer-ban', GamerBanComponent::class)->middleware('isModeratör')->name('gamer-ban.index');
    //? Gamer Ban List
    Route::get('/gamer-ban-list', GamerBanListComponent::class)->middleware('isModeratör')->name('gamer-ban-list.index');
    //? Systems
    //? Game Settings
    Route::match(['get', 'post'], '/game-settings', [GameSettingsController::class, 'index'])->middleware('isAdmin')->name('game-settings.index');
    Route::post('/game-settings/update', [GameSettingsController::class, 'update1'])->middleware('isAdmin')->name('game-settings.update1');
    Route::post('/game-settings/update2', [GameSettingsController::class, 'update2'])->middleware('isAdmin')->name('game-settings.update2');
    Route::post('/game-settings/update3', [GameSettingsController::class, 'update3'])->middleware('isAdmin')->name('game-settings.update3');
    //? Site Settings
    Route::get('/site-settings', [WebSettingsController::class, 'index'])->middleware('isAdmin')->name('site-settings.index');
    Route::post('/site-settings/update', [WebSettingsController::class, 'update'])->middleware('isAdmin')->name('site-settings.update');
    //? Log  Records
    Route::get('/log-recording', [LogRecordingController::class, 'index'])->middleware('isFounder')->name('log-recording.index');
    //Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/managers', SystemAuthoritiesComponent::class)->middleware('isFounder')->name('managers.index');
    //? Managers

});


//? Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('login.logout');
