<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class BookService
{
    public function addCommentToBook(Book $book, $comment, $ip): array
    {
        try {
            $c = new Comment;
            $c->book_id = $book->id;
            $c->comment = $comment;
            $c->ip_adderes = $ip;
            $c->save();
            return ["status" => true, "data" => $c];
        } catch (\Throwable $th) {
            Log::error("BookService::addCommentToBook", ["errorMessage" => $th->getMessage()]);
            return ["status" => false, "data" => null];
        }
    }
}
