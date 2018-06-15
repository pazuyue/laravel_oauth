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
    //$user = App\User::find(1);
// Creating a token without scopes...
    //$accessToken = $user->createToken('月光',['get-userinfo'])->accessToken;

    $accessToken="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjU2MDBlZTU0ZDUyYjk4MDBhN2VkMjM2NDM3MWUzNzIwNDM1NTczYmU2NTkzYWUzZjExOGI3NmM4ZDEzNzE4Yzg2MDdlNTUzMDViZGRjODA5In0.eyJhdWQiOiI1IiwianRpIjoiNTYwMGVlNTRkNTJiOTgwMGE3ZWQyMzY0MzcxZTM3MjA0MzU1NzNiZTY1OTNhZTNmMTE4Yjc2YzhkMTM3MThjODYwN2U1NTMwNWJkZGM4MDkiLCJpYXQiOjE1MjkwNzYwMjgsIm5iZiI6MTUyOTA3NjAyOCwiZXhwIjoxNTMwMzcyMDI4LCJzdWIiOiIxIiwic2NvcGVzIjpbImdldC11c2VyaW5mbyJdfQ.eNYTIkP44eadBp7bOxQHieTyDosOyL1rbL8mBlFU1pS8qwSD0td950CKP7L1XlyhPebQTzd60h9er4cx0OTLYEG9_1zQbvE62qFF27PH4Frhy59Bj7uTWRvuKw5LydXcVleAw56iWZEtUCf_YlpN3AfyangSiu_aXw3yUJjuG2quhgoPMtZKP6BiZ7Ycfwt2W_A2ApqWrcV3Lo3PlAJvbALONOjvZ_BCZBPRyGF-UGOCdrXWDR5lGaeq8nnzd6care5pZY2SNsktvZY0Pe-BXGcX5W2-Vp7Agh_C_k0kyTjrtTl3iiYyEKehXCZvsXckaWDJQ6KisZJXKJOd-PMKAyiPh4YjkXBOVT8KuvdtJlv2xb5gmUVgeSoNLzD-r20Yr8k_piDOJDQrPRy_WX9LzwYTAnrrbXwKJm74j0EacdXSausV5kLxSn6epVDsvd1A_l3AS5IqInNdpB6-wBQchVEwI_nKu9p4n2Lxm72DjSz_ZDyD5VkN17u3wUM_zxYHSppvqbq0Vg79hJcNQ1cWpsCyri3VhVy73FnuARGfWm9xeq8fPlzFA58_HSL0b5bH38vnUouYEFOZK0J5y0PZH-vVbXk6RN20xD8dcBQXunxfARM5E64cVPCYMrEnur_ERzeuTQHGt8HQ-GIGC0O4l0LN2GlDuAtesBNxmlRVgrU";
    $http = new GuzzleHttp\Client;
    $response = $http->request('GET', 'http://www.laraver.com/api/user', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});



