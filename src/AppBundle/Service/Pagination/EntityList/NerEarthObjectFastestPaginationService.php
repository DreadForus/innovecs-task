<?php

namespace AppBundle\Service\Pagination\EntityList;

use AppBundle\Service\Interfaces\EntityService\ViewEntityServiceInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Service\Pagination\PaginationConfig;

class NerEarthObjectFastestPaginationService extends NerEarthObjectPaginationService {

    public function __construct(ViewEntityServiceInterface $entityService, EntityManager $em)
    {
        parent::__construct($entityService, $em);
    }

    public function addOrder(QueryBuilder $qb, PaginationConfig $paginationConfig)
    {
        $qb->addOrderBy($this->entityService->getViewAlias().".speedPerSecond", 'DESC');

        return $qb;
    }

    function addFilters(QueryBuilder $qb, PaginationConfig $paginationConfig)
    {
        $qb = parent::addFilters($qb, $paginationConfig);

        $isHazardous = isset($paginationConfig->requestData['hazardous']) && $paginationConfig->requestData['hazardous'] === 'true' ? 1 : 0;

        $qb->andWhere($this->entityService->getViewAlias().".hazardous = $isHazardous");

        return $qb;
    }
}