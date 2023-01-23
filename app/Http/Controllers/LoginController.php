<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    //
    public function login_api(Request $request){
        $http = new \GuzzleHttp\Client;
       // dd($http);
        // $response = Http::post('http://127.0.0.1:8000/api/login',[
        //     'headers' => [
        //         'Authorization' => ''
        //         ],
        //         'query' => [
        //             'email' => 'userone@gmail.com',
        //             'password' => '12345678'
        //         ]
        //         ]);
        //         $result = json_decode((string)$response->getBody(),true);
        //         dd($result);
        


        $response = Http::get('https://quizapi.io/api/v1/questions', [
            'apiKey' => 'YOUR_API_KEY_HERE',
            'limit' => 10,
        ]);
        $quizzes = json_decode($response->body());
         dd($quizzes);
    }
}
