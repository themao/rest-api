<?php

namespace AppBundle\Repository;

use AppBundle\Entity\UselessEntity;
use Doctrine\ORM\EntityRepository;

class UselessEntityRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getNotEmptyUselessEntities()
    {
        $builder = $this->_em->createQueryBuilder();

        $builder
            ->select('ue')
            ->from(UselessEntity::class, 'ue')
            ->where('ue.meh IS NOT NULL')
            ->andWhere('ue.whatever IS NOT NULL')
        ;

        return $builder->getQuery()->getResult();
    }
}
