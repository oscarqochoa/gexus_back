<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author_id' => $this->author_id,
            'author' => "{$this->author->first_name} {$this->author->last_name}",
            'summary' => $this->summary,
            'pages' => $this->pages,
            'created_at' => $this->created_at->format('d-m-Y'),
        ];
    }
}
