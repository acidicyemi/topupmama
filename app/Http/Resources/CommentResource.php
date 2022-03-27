<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            "comment" => $this->name,
            "bookId" => $this->book_id,
            "isbn" => $this->ip_address,
            "createdAt" => $this->created_at
        ];
    }
}