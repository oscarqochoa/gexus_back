<?php

namespace App\Services;

use App\Models\Book;

class BooksService
{

    public function find($page = 1, $perPage = 25)
    {
        $books = Book::orderBy('title', 'asc')->paginate(
            $perPage,
            $columns = ['*'],
            $pageName = 'books',
            $page
        );
        return $books;
    }

    public function findOne($id)
    {
        $book = Book::findOrFail($id);
        return $book;
    }

    public function save($body)
    {
        $book = new Book();

        $book->title = $body['title'];
        $book->author_id = $body['author_id'];
        $book->pages = $body['pages'];
        $book->summary = $body['summary'];

        $book->save();

        return $book;
    }

    public function update($id, $body)
    {
        // Validate if author exsits
        $book = $this->findOne($id);

        $book->update($body);

        return $book;
    }

    public function delete($id)
    {
        // Validate if author exsits
        $book = $this->findOne($id);

        $book->delete();

        return $book;
    }

}
