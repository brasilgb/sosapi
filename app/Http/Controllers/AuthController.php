<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return $this->response('Authorized', 200, [
                'token' => $request->user()->createToken('appsos')->plainTextToken,
                'id' =>$request->user()->id,
                'name' =>$request->user()->name,
                'email' => $request->user()->email
            ]);
        }
        
        return $this->response('Usuário não autorizado. E-mail e/ou senha inválidos', 403);
    }

public function register(Request $request) {
    dd($request);
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    if($user){
        return 'User registered!';
    }else{
        return 'Erro ao registrar usuario';
    }

}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->response('Token Revoked', 200);
    }
}
