<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cliente' => [
                'nome' => $this->cliente->nome,
                'telefone' => $this->cliente->telefone,
            ],
            "id" => $this->id,
            "cliente_id" => $this->cliente_id,
            "equipamento" => $this->equipamento,
            "modelo" => $this->modelo,
            "senha" => $this->senha,
            "defeito" => $this->defeito,
            "estado" => $this->estado,
            "acessorios" => $this->acessorios,
            "orcamento" => $this->orcamento,
            "descorcamento" => $this->descorcamento,
            "detalhes" => $this->detalhes,
            "valpecas" => $this->valpecas,
            "valservico" => $this->valservico,
            "custo" => $this->custo,
            "previsao" => $this->previsao,
            "statusorcamento" => $this->statusorcamento,
            "concluido" => $this->concluido,
            "status" => $this->status,
            "comunicado" => $this->comunicado,
            "entrega" => $this->entrega,
            "dtentrega" => Carbon::parse($this->dtentrega)->format('Y-m-d H:i:s'),
            "tecnico" => $this->tecnico,
            "observacoes" => $this->observacoes,
            "dtentrada" => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
