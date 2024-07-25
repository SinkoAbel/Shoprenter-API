<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SecretResource extends JsonResource
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
            'secret_text' => $this->secret_text,
            'remaining_views' => $this->remaining_views,
            'expires_at' => $this->expires_at,
            'created_at' => $this->created_at
        ];
    }
}
