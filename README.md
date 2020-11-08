# Mini Project Book App
Nama    : Muhajir  
Nim     : 185150701111010  

project ini adalah implementas RESTAPI menggunakan Lumen Frameworks. 

terdapat beberapa enpoint yaitu :

1. /books `[GET]` -menampilkan semua list buku
2. /books `[POST]` -membuat buku baru
3. /books/{id} `[GET]` -menampilkan buku berdasarkan ID
4. /books/{id} `[PUT]` -mengumbah buku yang telah dibuat
5. /books/{id} `[DELETE]` -menghapus buku yang telah dibuat
6. /authors `[GET]` -menampilkan semua list author
7. /authors `[POST]` -membuat author baru
8. /authors/{id} `[GET]` -menampilkan author berdasarkan ID
9. /authors/{id} `[PUT]` -mengumbah author yang telah dibuat
10. /authors/{id} `[DELETE]` -menghapus author yang telah dibuat


web.php

```php
$router->get('books', 'BooksController@index');

$router->get('books/{id}', 'BooksController@show');

$router->post('books', 'BooksController@create');

$router->put('books/{id}', 'BooksController@update');

$router->delete('books/{id}', 'BooksController@delete');


$router->get('authors', 'AuthorController@index');

$router->get('authors/{id}', 'AuthorController@show');

$router->post('authors', 'AuthorController@create');

$router->put('authors/{id}', 'AuthorController@update');

$router->delete('authors/{id}', 'AuthorController@delete');
```
BooksController.php

```php
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
```  
  
AuthorController.php

```php
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
```  
