<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProdutoResource;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('q');

        $query = Produto::orderBy('id', 'DESC');

        if ($search) {
            $query->where('descricao', 'like', '%' . $search . '%');
        }

        $produtos = $query->paginate(12);
        return ProdutoResource::collection($produtos);
    }

    public function allprodutos()
    {
        $produtos = Produto::all();
        return ProdutoResource::collection($produtos);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'descricao' => 'required',
            'movimento' => 'required',
            'valcompra' => 'required',
            'valvenda' => 'required',
            'unidade' => 'required',
            'estmaximo' => 'required',
            'estminimo' => 'required',
            'tipo' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = Produto::create($request->all());

        if ($created) {
            return $this->response('Produto cadastrado com sucesso!', 200, new ProdutoResource($created));
        }
        return $this->error('Produto não cadastrado', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return new ProdutoResource($produto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
       
        $validator = Validator::make($request->all(), [
            'descricao' => 'required',
            'movimento' => 'required',
            'valcompra' => 'required',
            'valvenda' => 'required',
            'unidade' => 'required',
            'estmaximo' => 'required',
            'estminimo' => 'required',
            'tipo' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = $produto->update($request->all());

        if ($created) {
            return $this->response('Produto alterado com sucesso!', 200, new ProdutoResource($produto));
        }
        return $this->error('Produto não alterado', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $deleted = $produto->delete();

        if ($deleted) {
            return $this->response('Produto deletado com sucesso!', 200);
        }
        return $this->response('Produto não deletado!', 400);
    }
}
