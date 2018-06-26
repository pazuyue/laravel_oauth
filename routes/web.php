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

        $response = $http->post('http://193.112.109.76/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '1',  // your client id
                'client_secret' => 'XW02LBSAIYBKY40xHQsjhOsGHa0QcL4Jpog10h4z',   // your client secret
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

    $accessToken="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjEwOWY5MDk5MjVkY2JkNDcxZjkwYWE5NWI2MTRhYmIzMmZmMDRhYjNjMDdhYmUzYTFiNTZlNjMxNjY4ZjcyMTM1ZWI1NDIzYWMwNzU5YjNjIn0.eyJhdWQiOiIxIiwianRpIjoiMTA5ZjkwOTkyNWRjYmQ0NzFmOTBhYTk1YjYxNGFiYjMyZmYwNGFiM2MwN2FiZTNhMWI1NmU2MzE2NjhmNzIxMzVlYjU0MjNhYzA3NTliM2MiLCJpYXQiOjE1Mjk2NTc4NTcsIm5iZiI6MTUyOTY1Nzg1NywiZXhwIjoxNTMwOTUzODU3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.WJjmM7-lwYmK-4duMbiRH6tb8ZQwsEXUiTVOEgLcww3OoVz9JzitmKlxCpjoKoTtqkwOPtK6YWAu-lyWalo5J_jWCdxvk557xU7JqtW8FMYj4btE7lOZ8OHjgvkqGyI7jbtGorss_rizycsRIcCNECoUaMNROFbEOm2jfPAgEim84Ryb6TkDECC6NWkkRe1hKUd43r8jAACF2UyTvTzJBeoWKylKqE0O1bWt3ZQBoT0QZmFqydcxQ-JnMzQfn2ZJEmvA8hIUUS1Xo-ZWnmDeLEvJQ2aJyMDdfsnwpUo1mauYXlC5TsX6sAWg23k0jZ9EF4aarrINZ5s5wqasdv99qDlU5vPxkfwxfPBl74GFAWn83pg1O3Mth3u75A-E64_NQZOIoxpk6Ionl11QGP1ajDg-GQAjlltx6f3u6dyOK1YKmeLPOeRzDqkpI8QEPGvHpJ_JSB_O98k4xyYnrTy-p9vNN2012MQcmwAZFTE_olDM1Xyjk5a8qrf_W5rPpp_1Gf0CBa8o6XDXnfSHiv02gncgKmVmPLQniEhO6t7lXxgIRabURkk4pRz7gA_UGRBZbuN_-DZfdSixocnjzlaAK7D_6YPdjD9H5l4Gf_PiE2Vk0K76WrzDmCEjDqF1Dm99QBO4op0nHBGV7lZbaTl7jkPMKX4-fTpzruGxoJYhru0";
    $http = new GuzzleHttp\Client;
    $response = $http->request('GET', 'http://193.112.109.76/api/user', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
