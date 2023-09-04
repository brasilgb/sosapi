<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ImpressaoResource;
use App\Models\Impressao;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class ImpressaoController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Impressao::get()->isEmpty()) {
            Impressao::create();
        }
        $query = Impressao::orderBy("id", "DESC")->first();
        $impressao = Impressao::where("id", $query->id)->get();
        return ImpressaoResource::collection($impressao);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Impressao $impressao)
    {

        $validator = Validator::make($request->all(), [
            'entrada' => 'required',
            'saida' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = $impressao->update($request->all());

        if ($created) {
            return $this->response('Impressão alterada com sucesso!', 200, new ImpressaoResource($impressao));
        }
        return $this->error('Impressão não alterada', 400);
    }
}
