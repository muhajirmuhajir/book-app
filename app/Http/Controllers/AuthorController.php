<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Author;
use Exception;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::all();
    }

    public function show($id)
    {
        try {
            return Author::findOrFail($id);
        } catch (Exception $th) {
            return response([
                'message' => 'Author not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $book = Author::findOrFail($id)->update($request->all());
            return ResponseFormatter::success($book, "Author has been updated");
        } catch (Exception $th) {
            return ResponseFormatter::error($th->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $this->validate($request,[
                'name' => 'required',
                'gender' => 'required|in:male,female',
                'biography' => 'required'
            ]);
            return ResponseFormatter::success(Author::create($request->all()));
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th->getMessage());
        }
    }

    public function delete($id)
    {
        return ResponseFormatter::success( Author::destroy($id), 'Author has been deleted');
    }
}
