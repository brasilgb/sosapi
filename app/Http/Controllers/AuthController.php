<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    use HttpResponses;

    public $successStatus = 200;
    public function login(Request $request, User $user)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return $this->response('Authorized', 200, [
                'token' => $request->user()->createToken('token-sos')->plainTextToken,
                'name' =>$request->user()->name,
                'email' => $request->user()->email
            ]);
        }
        
        return $this->response('Usuário não autorizado. E-mail e/ou senha inválidos', 403);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->response('Token Revoked', 200);
    }
}
