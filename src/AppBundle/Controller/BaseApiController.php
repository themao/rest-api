<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class BaseApiController extends Controller
{
    /**
     * @param       $object
     * @param array $groups
     * @param int   $status
     * @return JsonResponse
     */
    protected function returnJson($object, $groups = [], $status = Response::HTTP_OK)
    {
        $json = $this->serialize($object, $groups);
        return new JsonResponse($json, $status, [], true);
    }

    /**
     * @param       $object
     * @param array $groups
     * @return mixed|string
     */
    protected function serialize($object, $groups = [])
    {
        $serializer = $this->container->get('jms_serializer');
        $context    = SerializationContext::create()->setSerializeNull(true);
        if (!empty($groups)) {
            $context->setGroups($groups);
        }
        return $serializer->serialize($object, 'json', $context);
    }

}
