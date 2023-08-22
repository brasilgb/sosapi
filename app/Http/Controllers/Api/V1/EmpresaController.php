<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EmpresaResource;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
     * Display the specified resource.
     */
    public function upload(Request $request, Empresa $empresa)
    {

        $data = $request->all();
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
        $storePath = public_path('storage/uploads');
        if ($request->hasfile('logo')) {
            $fileName = time() . '.' . $request->logo->extension();
            $request->logo->move($storePath, $fileName);
            if (file_exists($storePath . DIRECTORY_SEPARATOR . $request->logo)) {
                unlink($storePath . DIRECTORY_SEPARATOR . $request->logo);
            }
        }
// dd($fileName);
        $data['logo'] = $request->hasfile('logo') ? $fileName : $empresa->logo;

        $created = $empresa->update($data);

        if ($created) {
            return $this->response('Empresa alterada com sucesso!', 200, new EmpresaResource($empresa));
        }
        return $this->error('Empresa não alterada', 400);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        // dd($request->all());
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
