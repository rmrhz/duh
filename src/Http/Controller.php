<?php

namespace News\Core\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class Controller
{
    /**
     * Symfony's HttpFoundation's Request container
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    protected $request;

    /**
     * Returns the response in JSON format
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function jsonResponse($data) : JsonResponse
    {
        return new JsonResponse($data);
    }

    /**
     * Sets the Request
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
}
