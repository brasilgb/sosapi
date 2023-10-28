<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $search = $request->get('q');

        $query = User::orderBy('id', 'DESC');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $usuarios = $query->paginate(12);
        return UserResource::collection($usuarios);
    }

    public function allusers()
    {
        // return $this->response('Authorized', 200);
        $users = User::all();
        return UserResource::collection($users);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = User::create($request->all());

        if ($created) {
            return $this->response('Usuário cadastrado com sucesso!', 200, new UserResource($created));
        }
        return $this->error('Usuário não cadastrado', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // $users = User::findOrFail($user);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => "unique:users,email,$user->id",
            'function' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }
        $data = $request->all();
        $data['password'] = $request->password ? $request->password : $user->password;
        $created = $user->update($data);

        if ($created) {
            return $this->response('Usuário editado com sucesso!', 200, new UserResource($user));
        }
        return $this->error('Usuário não editado', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();

        if ($deleted) {
            return $this->response('Usuário deletado com sucesso!', 200);
        }
        return $this->response('Usuário não deletado!', 400);
    }
}
