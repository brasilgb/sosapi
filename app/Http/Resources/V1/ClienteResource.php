<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'id' => $this->id,
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
                'obs' => $this->obs,
                'cadastro' => Carbon::parse($this->created_at)->format('Y/m/d H:i:s'),
          ];
    }
}
