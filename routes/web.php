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
   // $user = App\User::find(1);
// Creating a token without scopes...
    //$accessToken = $user->createToken('月光')->accessToken;
    $accessToken="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ5NDlhMTY1MTFiYjRjYWI5NjZlOGIyNDViM2U2YzczODZhYzI1ZTM4ZGIzM2MzOTIwZWM4NmRjYTQ2N2Y2NGU5M2VlYWY0MjdhNWVlMDY1In0.eyJhdWQiOiI1IiwianRpIjoiZDk0OWExNjUxMWJiNGNhYjk2NmU4YjI0NWIzZTZjNzM4NmFjMjVlMzhkYjMzYzM5MjBlYzg2ZGNhNDY3ZjY0ZTkzZWVhZjQyN2E1ZWUwNjUiLCJpYXQiOjE1MjkwNjcxNTIsIm5iZiI6MTUyOTA2NzE1MiwiZXhwIjoxNTMwMzYzMTUyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.PWOwlOzeWGgqZQy5PGKh7M5gyrNJs6ytJJ43cY-7pl2MJx6KrYUmMeJVNE1l9AJLNAhW4myESyrHN7eVT3UObQIlobdaKHibcS6DBHUsmeJyUqVADaMqkBgByd9YA7VFVif9DZvRXDsIhLBnlJIy5aWYnJQXdfbkvGbApzgr01Hx-XogSVkgqnNEGOOnGnUfT8HhiciKwZEsSiVjIlbksrtQU6zC1YKLLgYqt44TCVxDnxTDQPuycZA7jxd-0LRavZhut34C4Le8q7d2oN2WTpKiQdIakBEm0augB_bFDPHIrtnuuyiZ3vS3gx5vbqL3g9hOxxZH_HirM1BPv7qXqmThA3_ZWYxreHfRbK_LEWy2IIPapF56jzx1VWTeYlmYYEsbxOY7TlZTYxoHU2c1dPp2cUnVY54SZQcC3YItvz7KDewlj0Pn0w7DXzHCV7ipLswWKx5heCw0fF_eLGgtThGnTmJA0hv2Pw6TYgZux3YkEhEhA2JFAc1KNMYSdHi564_NJDYBT2K__qqijiGuCHhleRKBAS1STLVgcuEfg2fdbbsgQmFPgKiM-PEPRpRL2TOZbQzXbx-ZVk98i6TlOviN9Oh1mQSx30QDQl_tauShfd6CgQ4Kvfvs4QcTKBZUpR8nn57xE7lBMh5vTBxklNku0ZIXssyGqujw79Eu_WE";
    $http = new GuzzleHttp\Client;
    $response = $http->request('GET', 'http://www.laraver.com/api/user', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});



