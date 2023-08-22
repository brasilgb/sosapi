<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\NotificacaoResource;
use App\Models\Notificacao;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class NotificacaoController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Notificacao::get()->isEmpty()) {
            Notificacao::create();
        }
        $query = Notificacao::orderBy("id", "DESC")->first();
        $notificacao = Notificacao::where("id", $query->id)->get();
        return NotificacaoResource::collection($notificacao);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notificacao $notificacao)
    {

        $validator = Validator::make($request->all(), [
            'entrada' => 'required',
            'saida' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = $notificacao->update($request->all());

        if ($created) {
            return $this->response('Notificação alterada com sucesso!', 200, new NotificacaoResource($notificacao));
        }
        return $this->error('Notificação não alterada', 400);
    }
}
