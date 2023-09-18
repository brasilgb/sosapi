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

    public function logotipo() 
    {
        $logotipo = Empresa::first()->logo;
        return response()->json([
            'data' => [
                'logo' => $logotipo
            ]
        ], 200);
    }
    /**
     * Display the specified resource.
     */
    public function upload(Request $request, Empresa $empresa)
    {
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
        $data = $request->all();
        $data['logo'] = $request->hasfile('logo') ? $fileName : $empresa->logo;

        $updated = $empresa->update($data);

        if ($updated) {
            return $this->response('Empresa alterada com sucesso!', 200, new EmpresaResource($empresa));
        }
        return $this->error('Empresa não alterada', 400);
    }
}
