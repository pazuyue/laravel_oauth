<?php

use Illuminate\Http\Request;

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

Route::get('/redirect', function (){
    $query = http_build_query([
        'client_id' => '1',
        'redirect_uri' => 'http://www.laraver.com/auth/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);


    return redirect('http://193.112.109.76/oauth/authorize?' . $query);
});


