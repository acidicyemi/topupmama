<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Character;
use App\Filters\BooksFilter;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Filters\CharactersFilter;
use App\Http\Resources\BooksCollection;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BooksCommentsCollection;
use App\Http\Resources\BooksCharactersCollection;

class BooksController extends Controller
{
    public $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function listBooks(BooksFilter $filters)
    {
        $request = $filters->getRequest();
        $p = $request->paginate;
        $paginate = (isset($p) && is_numeric($p) && $p > 0) ? $p : 12;

        $filters->addToRequest(["orderByReleaseDate" => "asc"]);
        $bks = Book::with(["authors", "characters", "comments"])->filter($filters)->paginate($paginate);

        return new BooksCollection($bks);
    }

    public function addComment(Request $request, $bookId)
    {
        $validator = Validator::make($request->all(), [
            'comment' => ["required", "string", "max:500"]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "validation errors",
                "data" => $validator->errors()
            ], 422);
        }

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
                "data" => new CommentResource($res["data"])
            ], 200);
        }
        return response()->json([
            "status" => "failed",
            "message" => "unable to add Comment",
            "data" => null
        ], 400);
    }

    public function getComments(Request $request, $bookId)
    {
        $p = $request->paginate;
        $paginate = (isset($p) && is_numeric($p) && $p > 0) ? $p : 10;

        $book = Book::with(["comments"])->where(["id" => $bookId])->first();

        if (is_null($book)) {
            return response()->json([
                "status" => "failed",
                "message" => "book not found",
                "data" => ""
            ], 404);
        }
        $comments = $book->comments()->orderBy("created_at", "DESC")->paginate($paginate);

        return new BooksCommentsCollection($comments);
    }

    public function getCharacters(CharactersFilter $filters, $bookId)
    {
        $request = $filters->getRequest();
        $p = $request->paginate;
        $paginate = (isset($p) && is_numeric($p) && $p > 0) ? $p : 10;

        $book = Book::with(["comments"])->where(["id" => $bookId])->first();

        if (is_null($book)) {
            return response()->json([
                "status" => "failed",
                "message" => "book not found",
                "data" => ""
            ], 404);
        }

        $characters = $book->characters()->filter($filters)->paginate($paginate);

        return new BooksCharactersCollection($characters);
    }
}
