<?php

namespace AppBundle\Controller;

use AppBundle\Service\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/cart")
 */
class CartController extends BaseApiController
{
    /**
     * @Route("/exchange", methods={"POST"})
     * @param Request $request
     * @throws \Exception
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function exchangeAction(Request $request, CartService $cartService)
    {
        $summary = $cartService->calculateConvertedSummary($request->getContent());
        return $this->returnJson($summary, [],Response::HTTP_OK);
    }
}
