<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UselessEntity;
use AppBundle\Form\UselessType;
use AppBundle\Repository\UselessEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/useless")
 */
class DefaultController extends BaseApiController
{
    /**
     * @Route("", methods={"POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createAction(Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(UselessType::class);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $uselessEntity = $form->getData();
            $manager->persist($uselessEntity);
            $manager->flush();

            return $this->returnJson($uselessEntity, ['default'], Response::HTTP_CREATED);
        }

        return $this->returnJson($form->getErrors(), [],Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @Route("", methods={"GET"})
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listAction(Request $request, EntityManagerInterface $manager)
    {
        /** @var UselessEntityRepository $uselessRepo */
        $uselessRepo = $manager->getRepository(UselessEntity::class);

        return $this->returnJson(
            $uselessRepo->getNotEmptyUselessEntities(),
            ['default']
        );
    }

    /**
     * @Route("/{id}", methods={"GET"})
     *
     * @param UselessEntity $uselessEntity
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function singleAction(UselessEntity $uselessEntity)
    {
        return $this->returnJson(
            $uselessEntity,
            ['default']
        );
    }

    /**
     * @Route("/{id}", methods={"PATCH"})
     *
     * @param UselessEntity $uselessEntity
     * @param Request $request
     * @param EntityManagerInterface $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction(UselessEntity $uselessEntity, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(UselessType::class, $uselessEntity);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $uselessEntity = $form->getData();
            $manager->persist($uselessEntity);
            $manager->flush();

            return $this->returnJson($uselessEntity, ['default'], Response::HTTP_OK);
        }

        return $this->returnJson($form->getErrors(), [],Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     *
     * @param UselessEntity $uselessEntity
     * @param EntityManagerInterface $manager
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteAction(UselessEntity $uselessEntity, EntityManagerInterface $manager)
    {
        $manager->remove($uselessEntity);
        $manager->flush();

        return $this->returnJson([], [],Response::HTTP_NO_CONTENT);
    }
}
