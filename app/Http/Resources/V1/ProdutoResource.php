<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
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
            'descricao' => $this->descricao,
            'movimento' => $this->movimento,
            'valcompra' => $this->valcompra,
            'valvenda' => $this->valvenda,
            'unidade' => $this->unidade,
            'estmaximo' => $this->estmaximo,
            'estminimo' => $this->estminimo,
            'tipo' => $this->tipo,
            'cadastro' => Carbon::parse($this->created_at)->format('Y/m/d H:i:s'),
        ];
    }
}
