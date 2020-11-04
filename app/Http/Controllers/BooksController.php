<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BooksController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function show($id)
    {
        try {
            return Book::findOrFail($id);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Book not found'
            ], 404);
        }
    }
}
