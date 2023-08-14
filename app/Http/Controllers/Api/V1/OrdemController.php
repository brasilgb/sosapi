<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrdemResource;
use App\Models\Ordem;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class OrdemController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('q');

        $query = Ordem::with('cliente')->orderBy('id', 'DESC');

        if ($search) {
            $query->where('id', 'like', '%' . $search . '%');
        }

        $ordens = $query->paginate(12);
        return OrdemResource::collection($ordens);
    }

    public function allordens()
    {
        $ordens = Ordem::all();
        return OrdemResource::collection($ordens);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            // if(!auth()->user()->tokenCan('user-store')) {
            //     return $this->error('Unauthorized', 403);
            // }

            $validator = Validator::make($request->all(), [
                'cliente_id' => 'required',
                'equipamento' => 'required',
                'senha' => 'required',
                'defeito' => 'required',
                'estado' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->error('Dados inválidos!', 422, $validator->errors());
            }

            $created = Ordem::create($request->all());

            if ($created) {
                return $this->response('Ordem cadastrada com sucesso!', 200, new OrdemResource($created));
            }
            return $this->error('Ordem não cadastrada', 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ordem $ordem)
    {
        return new OrdemResource($ordem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ordem $ordem)
    {

        // dd(Carbon::parse($request->dtentrada)->format('Y-m-d H:i:s'));
        $validator = Validator::make($request->all(), [
            'equipamento' => 'required',
            'senha' => 'required',
            'defeito' => 'required',
            'estado' => 'required',
            'tecnico' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos UPDATE!', 422, $validator->errors());
        }
        $data = $request->all();
        $data['dtentrega'] = Carbon::parse($request->dtentrada)->format('Y-m-d H:i:s');
        $updated = $ordem->update($data);

        if ($updated) {
            return $this->response('Ordem alterada com sucesso!', 200, new OrdemResource($ordem));
        }
        return $this->error('Ordem não alterada', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordem $ordem)
    {
        $deleted = $ordem->delete();

        if ($deleted) {
            return $this->response('Ordem deletada com sucesso!', 200);
        }
        return $this->response('Ordem não deletada!', 400);
    }
}
