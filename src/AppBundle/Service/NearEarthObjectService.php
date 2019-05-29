<?php

namespace AppBundle\Service;

use AppBundle\Service\Abstraction\EntityService\AbstractViewEntityService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\QueryBuilder;

class NearEarthObjectService extends AbstractViewEntityService
{
    public function getQB($alias, $params = [])
    {
        return $this->em->createQueryBuilder()->from("AppBundle:NearEarthObject", $alias);
    }

    /**
     * @return QueryBuilder
     */
    function getViewAccessQB()
    {
        return $this->getQB($this->getViewAlias());
    }

    /**
     * @return string
     */
    function getViewAlias()
    {
        return "object";
    }

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

}