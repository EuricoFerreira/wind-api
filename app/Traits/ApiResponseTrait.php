<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{
    protected function successResponse($data = null, $message = null, $code = Response::HTTP_OK): JsonResponse
	{
		return response()->json([
			'success'=> true, 
			'message' => $message,
            'data' => $data 
		], $code);
	}

	protected function errorResponse($message = null, $code = Response::HTTP_BAD_REQUEST): JsonResponse
	{
		return response()->json([
			'status' => false,
			'message' => $message,
		], $code);
	}

    protected function forbiddenResponse($message = null): JsonResponse
    {
		return response()->json([
			'status' => false,
			'message' => $message,
		], Response::HTTP_FORBIDDEN);
	}

    protected function notFoundResponse($message = null): JsonResponse
    {
		return response()->json([
			'status' => false,
			'message' => $message,
		], Response::HTTP_NOT_FOUND);
	}

    protected function unAuthorizedResponse($message=null): JsonResponse 
    {
        return response()->json([
            'status' => false,
			'message' => $message,
        ], Response::HTTP_UNAUTHORIZED);
    }

}