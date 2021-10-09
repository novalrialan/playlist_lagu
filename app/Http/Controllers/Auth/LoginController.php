<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function verify()
    {
        $fullname = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];
        $user = User::loginVerify($fullname,$password);
        if ($user !== false) {
           $apitoken = Str::random('100');
           $user->api_token = $apitoken;
           $user->save();
           return $this->successResponse(['login_user'=>$user]);
        }
        return $this->failedResponse([],401); 
    }
}