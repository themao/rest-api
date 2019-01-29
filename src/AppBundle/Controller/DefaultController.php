<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/cart")
 */
class DefaultController extends BaseApiController
{
    /**
     * @Route("", methods={"POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createAction(Request $request)
    {
        return $this->returnJson([], [],Response::HTTP_OK);
    }
}
