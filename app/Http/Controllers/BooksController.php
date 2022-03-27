<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Filters\BooksFilter;

class BooksController extends Controller
{
    public function listBooks(BooksFilter $filters)
    {
        $bks = Book::filter($filters)->get();
    }
}
