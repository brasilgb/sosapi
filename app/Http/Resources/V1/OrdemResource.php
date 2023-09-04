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
        /*
'cpf' => $this->cpf,
            'nascimento' => $this->nascimento,
            'nome' => $this->nome,
            'email' => $this->email,
            'cep' => $this->cep,
            'uf' => $this->uf,
            'cidade' => $this->cidade,
            'bairro' => $this->bairro,
            'endereco' => $this->endereco,
            'complemento' => $this->complemento,
            'telefone' => $this->telefone,
            'contato' => $this->contato,
            'telcontato' => $this->telcontato,

        */
        return [
            'cliente' => [
                'nome' => $this->cliente->nome,
                'telefone' => $this->cliente->telefone,
                'email' => $this->cliente->email,
                'endereco' => $this->cliente->endereco,
                'bairro' => $this->cliente->bairro,
                'cidade' => $this->cliente->cidade,
                'uf' => $this->cliente->uf,
            ],
            "id" => $this->id,
            "numordem" => $this->numordem,
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
            "pecas" => $this->pecas,
            "valpecas" => $this->valpecas,
            "valservico" => $this->valservico,
            "custo" => $this->custo,
            "previsao" => $this->previsao,
            "status" => $this->status,
            "dtentrega" => $this->dtentrega,
            "tecnico" => $this->tecnico,
            "envioemail" => $this->envioemail,
            "observacoes" => $this->observacoes,
            "dtentrada" => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
