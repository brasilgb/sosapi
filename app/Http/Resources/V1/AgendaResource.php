<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cliente_id' => $this->cliente_id,
            'datahora' => $this->datahora,
            'servico' => $this->servico,
            'detalhes' => $this->detalhes,
            'tecnico' => $this->tecnico,
            'status' => $this->status,
            'observacoes' => $this->observacoes,
            'cadastro' => Carbon::parse($this->created_at)->format('Y/m/d H:i:s'),
        ];
    }
}
