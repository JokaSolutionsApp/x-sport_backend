<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registeration\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\User\LevelController;
use App\Http\Controllers\Stadiums\StadiumController;
use App\Http\Controllers\Acadimes\AcadimeController;
use App\Http\Controllers\Matches\FrindlyMatchController;
use App\Http\Controllers\Matches\CompetitiveMatchController;
use App\Http\Controllers\Matches\MatchController;

//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/test_api', function (){
    //return response()->json(['message'=>'success'],200);
    $sports = \App\Models\Sport::with('preferences.options')->get();

    $data = $sports->map(function ($sport) {
        return [
            'id' => $sport->id,
            'name' => $sport->name,
            'performance'=>$sport->preferences
            // يمكنك إضافة المزيد من البيانات هنا إذا أردت
        ];
    });
    return response()->json($data);

//    $sports = \App\Models\Sport::with('preferences.options')->get();
//    return $sports;

});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('verifyCode');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register_with_google', [AuthController::class, 'registerWithGoogle'])->name('registerWithGoogle');


Route::post('/user_details', [UserController::class, 'store'])->name('store');
Route::get('/get_sport', [SportController::class, 'get_sport'])->name('get_sport');
Route::get('/get_user_level', [LevelController::class, 'get_user_level'])->name('get_user_level');
Route::get('/get_users', [UserController::class, 'get_users'])->name('get_users');
Route::get('/get_user_with_token', [UserController::class, 'getUserWithToken'])->name('getUserWithToken');


Route::get('/get_stadiums', [StadiumController::class, 'get_stadiums'])->name('get_stadiums');
Route::get('/get_acadimes', [AcadimeController::class, 'get_acadimes'])->name('get_acadimes');
Route::post('/update_user_prodile', [UserController::class, 'updateUserProfile'])->name('update_profile');

Route::get('/get_metch_type', [FrindlyMatchController::class, 'get_metch_type'])->name('get_metch_type');
Route::post('/create_match', [FrindlyMatchController::class, 'store_match'])->name('store_match');
Route::get('/get_friendly_matches', [FrindlyMatchController::class, 'get_friendly_matches'])->name('get_friendly_matches');
Route::post('/join_match/{id}', [MatchController::class, 'join_match'])->name('join_match');
Route::get('/get_Competitive_matches', [CompetitiveMatchController::class, 'get_Competitive_matches'])->name('get_Competitive_matches');

Route::post('/preferences', [SportController::class, 'preferences'])->name('preferences');
Route::post('/hand_preference', [SportController::class, 'handPreference'])->name('handPreference');
Route::post('/postion_preference', [SportController::class, 'postionPreference'])->name('postionPreference');
Route::post('/time_preference', [SportController::class, 'timePreference'])->name('timePreference');


