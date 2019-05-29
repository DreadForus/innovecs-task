<?php

namespace AppBundle\Service\Abstraction\EntityService;

use AppBundle\Service\Interfaces\EntityService\ViewEntityServiceInterface;
use Doctrine\ORM\EntityManager;

abstract class AbstractViewEntityService extends AbstractEntityService implements ViewEntityServiceInterface
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function getAll()
    {
        return $this->getViewAccessQB()
            ->select($this->getViewAlias())
            ->getQuery()
            ->getResult()
        ;
    }

    function getViewList()
    {
        return $this
            ->getViewAccessQB()
            ->select($this->getViewAlias())
            ->getQuery()
            ->useResultCache(true, 30) // кеширование на уровне доктрины
            ->useQueryCache(true)
            ->getResult()
        ;
    }
}