<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EmpresaResource;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Empresa::get()->isEmpty()) {
            Empresa::create();
        } 
        $query = Empresa::orderBy("id", "DESC")->first();
        $empresa = Empresa::where("id", $query->id)->get();
        return EmpresaResource::collection($empresa);
    }
  /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {

        return new EmpresaResource($empresa);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'razao' => 'required',
            'cnpj' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
            'uf' => 'required',
            'cidade' => 'required',
            'cep' => 'required',
            'telefone' => 'required',
            'site' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = $empresa->update($request->all());

        if ($created) {
            return $this->response('Empresa alterada com sucesso!', 200, new EmpresaResource($empresa));
        }
        return $this->error('Empresa não alterada', 400);

    }
}
