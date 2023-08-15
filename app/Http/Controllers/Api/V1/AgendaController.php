<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AgendaResource;
use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('q');

        $query = Agenda::orderBy('id', 'DESC');

        if ($search) {
            $query->whereDate('datahora', $search);
        }

        $agendas = $query->paginate(12);
        return AgendaResource::collection($agendas);
    }

    public function allagendas()
    {
        $agendas = Agenda::all();
        return AgendaResource::collection($agendas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required',
            'datahora' => 'required',
            'servico' => 'required',
            'detalhes' => 'required',
            'tecnico' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = Agenda::create($request->all());

        if ($created) {
            return $this->response('Agenda alterada com sucesso!', 200, new AgendaResource($created));
        }
        return $this->error('Agenda não alterada', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        return new AgendaResource($agenda);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {

        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required',
            'datahora' => 'required',
            'servico' => 'required',
            'detalhes' => 'required',
            'tecnico' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = $agenda->create($request->all());

        if ($created) {
            return $this->response('Agenda alterada com sucesso!', 200, new AgendaResource($agenda));
        }
        return $this->error('Agenda não alterada', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $deleted = $agenda->delete();

        if ($deleted) {
            return $this->response('Agenda deletada com sucesso!', 200);
        }
        return $this->response('Agenda não deletada!', 400);
    }
}
