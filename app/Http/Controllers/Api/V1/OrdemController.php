<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\OrdemResource;
use App\Models\Ordem;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

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
    {
        {
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ordem $ordem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordem $ordem)
    {
        //
    }
}
