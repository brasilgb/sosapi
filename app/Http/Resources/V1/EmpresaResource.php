<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
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
            'empresa' => $this->empresa,
            'razao' => $this->razao,
            'cnpj' => $this->cnpj,
            'logo' => $this->logo,
            'endereco' => $this->endereco,
            'bairro' => $this->bairro,
            'uf' => $this->uf,
            'cidade' => $this->cidade,
            'cep' => $this->cep,
            'telefone' => $this->telefone,
            'site' => $this->site,
            'email' => $this->email
        ];
    }
}
