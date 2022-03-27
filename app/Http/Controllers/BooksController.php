<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Filters\BooksFilter;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Resources\BooksCollection;

class BooksController extends Controller
{
    public $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function listBooks(BooksFilter $filters)
    {
        $bks = Book::with(["authors", "characters"])->filter($filters)->paginate(12);

        return new BooksCollection($bks);
    }

    public function addComment(Request $request, $bookId)
    {
        $book = Book::where(["id" => $bookId])->first();

        if (is_null($book)) {
            return response()->json([
                "status" => "failed",
                "message" => "book not found",
                "data" => ""
            ], 404);
        }

        $res = $this->bookService->addCommentToBook($book, $request->comment, $request->ip());

        if ($res["status"]) {
            return response()->json([
                "status" => "success",
                "message" => "comment added successfully",
                "data" => $res["data"]
            ]);
        }
        return response()->json([
            "status" => "failed",
            "message" => "unable to add Comment",
            "data" => null
        ], 400);
    }
}
