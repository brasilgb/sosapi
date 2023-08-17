<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MensagemResource extends JsonResource
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
            'remetente' => $this->remetente,
            'destinatario' => $this->destinatario,
            'mensagem' => $this->mensagem,
            'status' => $this->status,
            'cadastro' => Carbon::parse($this->created_at)->format('Y/m/d H:i:s'),
        ];
    }
}
