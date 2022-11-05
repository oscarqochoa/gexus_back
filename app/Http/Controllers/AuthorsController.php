<?php

namespace App\Http\Controllers;

use App\Traits\HasResponse;
use Illuminate\Http\Request;

// Services
use App\Services\AuthorsService;

// Form requests
use App\Http\Requests\Author\{CreateAuthorRequest, UpdateAuthorRequest};

// Resources
use App\Http\Resources\AuthorResource;

class AuthorsController extends Controller
{

    use HasResponse;

    private $authorsService;

    public function __construct()
    {
        $this->authorsService = new AuthorsService();
    }

    public function list(Request $request)
    {
        $response = $this->authorsService->find();

        return AuthorResource::collection($response);
    }

    public function show(Request $request, $id)
    {
        $response = $this->authorsService->findOne($id);
        return new AuthorResource($response);
    }

    public function create(CreateAuthorRequest $request)
    {
        $body = $request->all();

        $response = $this->authorsService->save($body);

        return (new AuthorResource($response))->additional($this->createdResponse());
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        $body = $request->all();

        $response = $this->authorsService->update($id, $body);

        return (new AuthorResource($response))->additional($this->updatedResponse());

    }

    public function delete(Request $request, $id)
    {
        $response = $this->authorsService->delete($id);

        return (new AuthorResource($response))->additional($this->deletedResponse());
    }
}
