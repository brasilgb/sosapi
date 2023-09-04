<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MensagemResource;
use App\Models\Mensagem;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class MensagemController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('q');

        $query = Mensagem::orderBy('id', 'DESC');

        if ($search) {
            $query->where('remetente', 'like', '%' . $search . '%');
        }

        $agendas = $query->paginate(12);
        return MensagemResource::collection($agendas);
    }

    public function allmensagens()
    {
        $agendas = Mensagem::all();
        return MensagemResource::collection($agendas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'remetente' => 'required',
            'destinatario' => 'required',
            'mensagem' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = Mensagem::create($request->all());

        if ($created) {
            return $this->response('Mensagem adicionada com sucesso!', 200, new MensagemResource($created));
        }
        return $this->error('Mensagem não adicionada', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mensagem $mensagem)
    {
        return new MensagemResource($mensagem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mensagem $mensagem)
    {

        $validator = Validator::make($request->all(), [
            'remetente' => 'required',
            'destinatario' => 'required',
            'mensagem' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = $mensagem->update($request->all());

        if ($created) {
            return $this->response('Mensagem alterada com sucesso!', 200, new MensagemResource($mensagem));
        }
        return $this->error('Mensagem não alterada', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mensagem $mensagem)
    {
        $deleted = $mensagem->delete();

        if ($deleted) {
            return $this->response('Mensagem deletada com sucesso!', 200);
        }
        return $this->response('Mensagem não deletada!', 400);
    }
}
