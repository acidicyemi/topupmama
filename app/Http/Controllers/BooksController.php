<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Filters\BooksFilter;
use App\Http\Resources\BooksCollection;

class BooksController extends Controller
{
    public function listBooks(BooksFilter $filters)
    {
         $bks = Book::with(["authors"])->filter($filters)->paginate(12);

        return new BooksCollection($bks);
    }
}
