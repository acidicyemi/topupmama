<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "isbn" => $this->isbn,
            "numberofPages" => $this->number_of_pages,
            "commentCount" => $this->comments->count(),
            "mediaType" => $this->media_type,
            "releasedDate" => $this->released_date,
            "createdAt" => $this->created_at,
            "authors" => AuthorResource::collection($this->authors),
            // "characters" => CharacterResource::collection($this->characters)
        ];
    }
}
