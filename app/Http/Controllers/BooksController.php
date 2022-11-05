<?php

namespace App\Http\Controllers;

use App\Helpers\ExceptionHelper;
use Illuminate\Http\Request;
use App\Traits\HasResponse;

// Services
use App\Services\BooksService;

// Form requests
use App\Http\Requests\Book\{CreateBookRequest, UpdateBookRequest};

// Resources
use App\Http\Resources\BookResource;
use Exception;
use Illuminate\Http\JsonResponse;

class BooksController extends Controller
{
    use HasResponse;

    private $booksService;

    public function __construct()
    {
        $this->booksService = new BooksService();
    }

    public function list(Request $request)
    {
        $response = $this->booksService->find(
            $request->input("page"),
            $request->input("perPage")
        );

        return BookResource::collection($response);
    }

    public function show(Request $request, $id)
    {
        $response = $this->booksService->findOne($id);
        return new BookResource($response);
    }

    public function create(CreateBookRequest $request)
    {
        $body = $request->all();
        $response = $this->booksService->save($body);
        return (new BookResource($response))->additional($this->createdResponse());
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $body = $request->all();
        $response = $this->booksService->update($id, $body);
        return (new BookResource($response))->additional($this->updatedResponse());
    }

    public function delete(Request $request, $id)
    {
        $response = $this->booksService->delete($id);
        return (new BookResource($response))->additional($this->deletedResponse());
    }
}