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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/auth/callback', function (\Illuminate\Http\Request $request){
    if ($request->get('code')) {
        $http = new GuzzleHttp\Client;

        $response = $http->post('http://www.laraver.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '5',  // your client id
                'client_secret' => '6XVYiKSwXBN2d7M3bUJ1LaVKYf7ibT2p0mJd0or2',   // your client secret
                'redirect_uri' => 'http://www.laraver.com/auth/callback',
                'code' => $request->code,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    } else {
        return 'Access Denied';
    }
});

Route::get('/getUser', 'HomeController@getUser')->name('home');

Route::get('/user', function () {
    $user = App\User::find(1);
// Creating a token without scopes...
    $accessToken = $user->createToken('月光')->accessToken;
    $http = new GuzzleHttp\Client;
    $response = $http->request('GET', 'http://www.laraver.com/api/user', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});



