<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'title'    => $this->title,
            'content'  => $this->content,
            'image'    => $this->image ? asset('storage/'.$this->image) : null,
            'category' => $this->category ? $this->category->name : null,
            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
