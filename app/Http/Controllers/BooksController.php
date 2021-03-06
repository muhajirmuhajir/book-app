<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;

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
        } catch (Exception $th) {
            return response([
                'message' => 'Book not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id)->update($request->all());
            return ResponseFormatter::success($book, "Book has been updated");
        } catch (Exception $th) {
            return ResponseFormatter::error($th->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $this->validate($request,[
                'title' => 'required',
                'description' => 'required',
                'author' => 'required'
            ]);
            return ResponseFormatter::success(Book::create($request->all()));
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th->getMessage());
        }
    }

    public function delete($id)
    {
        return ResponseFormatter::success( Book::destroy($id), 'Book has been deleted');
    }
}
