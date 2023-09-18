<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ClienteResource;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if (!auth()->user()->tokenCan('user-store')) {
        //     return $this->error('Unauthorized', 403);
        // }
        $search = $request->get('q');

        $query = Cliente::orderBy('id', 'DESC');

        if ($search) {
            $query->where('nome', 'like', '%' . $search . '%');
        }

        $clientes = $query->paginate(12);
        return ClienteResource::collection($clientes,400);
    }

    public function allclientes()
    {
        $clientes = Cliente::all();
        return ClienteResource::collection($clientes);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if(!auth()->user()->tokenCan('user-store')) {
        //     return $this->error('Unauthorized', 403);
        // }
        $validator = Validator::make($request->all(), [
            'cpf' => 'required',
            'nome' => 'required',
            'email' => 'required|email',
            'cep' => 'required',
            'uf' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = Cliente::create($request->all());

        if ($created) {
            return $this->response('Cliente cadastrado com sucesso!', 200, new ClienteResource($created));
        }
        return $this->error('Cliente não cadastrado', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return new ClienteResource($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // if(!auth()->user()->tokenCan('user-store')) {
        //     return $this->error('Unauthorized', 403);
        // }
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'cpf' => 'required',
            'nome' => 'required',
            'email' => "unique:users,email,$cliente->id",
            'cep' => 'required',
            'uf' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $updated = $cliente->update($request->all());

        if ($updated) {
            return $this->response('Cliente alterado com sucesso!', 200, new ClienteResource($cliente));
        }
        return $this->error('Cliente não alterado', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $deleted = $cliente->delete();

        if ($deleted) {
            return $this->response('Cliente deletado com sucesso!', 200);
        }
        return $this->response('Cliente não deletado!', 400);
    }
}
