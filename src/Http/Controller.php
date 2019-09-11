<?php

namespace News\Core\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class Controller
{
    /**
     * Returns the response in JSON format
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function jsonResponse($data) : JsonResponse
    {
        return new JsonResponse($data);
    }
}
