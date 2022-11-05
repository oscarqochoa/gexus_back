<?php

namespace App\Services;

use App\Models\Author;

class AuthorsService
{
    public function find()
    {
        $books = Author::all();
        return $books;
    }

    public function findOne($id)
    {
        $author = Author::findOrFail($id);
        return $author;
    }

    public function save($body)
    {
        $author = new Author();

        $author->first_name = $body['first_name'];
        $author->last_name = $body['last_name'];

        $author->save();

        return $author;
    }

    public function update($id, $body)
    {
        // Validate if author exsits
        $author = $this->findOne($id);

        $author->update($body);

        return $author;
    }

    public function delete($id)
    {
        // Validate if author exsits
        $author = $this->findOne($id);

        $author->delete();

        return $author;
    }

}
