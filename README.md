# Mini Project Book App
Nama    : Muhajir  
Nim     : 185150701111010  

project ini adalah implementas RESTAPI menggunakan Lumen Frameworks. 

terdapat beberapa enpoint yaitu :

1. /books
2. /books/{id}

Endpoint `/books` berguna untuk menampilkan semua buku yang ada didalam database. saat mengakses method index yang ada pada kelas `BooksController`  
web.php

```php
$router->get('books', 'BooksController@index');
```
Method index

```php
public function index()
{
    return Book::all();
}
```  
  
Endpoint `/books/{id}` untuk menampilkan buku berdasarkan id buku. saat endpoint ini diakses maka akan menjalankan method show yang ada di kelas `BooksController`
```php
$router->get('books/{id}', 'BooksController@show');
```

Method show
```php
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
```

