<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
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
            'servidor' => $this->servidor,
            'porta' => $this->porta,
            'seguranca' => $this->seguranca,
            'usuario' => $this->usuario,
            'senha' => $this->senha,
            'assunto' => $this->assunto,
            'mensagem' => $this->mensagem
        ];
    }
}
