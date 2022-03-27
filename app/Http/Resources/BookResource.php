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
            "releasedDate" => $this->released_date,
            "numberofPages" => $this->number_of_pages,
            "mediaType" => $this->media_type,
            "createdAt" => $this->created_at,
            "authors" => AuthorResource::collection($this->authors)
        ];
    }
}
