<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HasResponse
{

    private function structure($message, $code)
    {
        return [
            'status' => [
                'code' => $code,
                'message' => $message,
            ],
            'timestamp' => now(),
        ];
    }

    public function createdResponse($code = JsonResponse::HTTP_CREATED)
    {
        $message = "Successfully created";
        $structure = $this->structure($message, $code);

        return $structure;
    }

    public function updatedResponse($code = JsonResponse::HTTP_OK)
    {
        $message = "Successfully updated";
        $structure = $this->structure($message, $code);

        return $structure;
    }

    public function deletedResponse($code = JsonResponse::HTTP_OK)
    {
        $message = "Successfully deleted";
        $structure = $this->structure($message, $code);

        return $structure;
    }

}
