<?php

namespace AppBundle\Service\Abstraction\EntityService;

use AppBundle\Service\Interfaces\EntityService\EntityServiceInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractEntityService implements EntityServiceInterface
{
    /** @var \Doctrine\Common\Persistence\ObjectManager */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getCountResult(QueryBuilder $queryBuilder, $alias= null)
    {
        if(!$alias){
            $alias = $queryBuilder->getRootAliases()
                [0]
            ;
        }

        $result =  $queryBuilder
            ->addSelect("COUNT(".$alias.")")
            ->getQuery()
            ->getSingleResult()
            ['1']
        ;

        return $result;
    }
}