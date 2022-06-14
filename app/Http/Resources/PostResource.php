<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id'                => $this->id,
            'author_id'         => $this->author_id,

            'title'             => $this->title,
            'description'       => $this->description,
            'publication_date'  => $this->publication_date,
            'created_at'        => $this->created_at,
        ];
    }
}
