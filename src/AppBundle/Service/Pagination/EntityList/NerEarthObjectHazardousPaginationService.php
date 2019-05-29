<?php

namespace AppBundle\Service\Pagination\EntityList;

use AppBundle\Service\Interfaces\EntityService\ViewEntityServiceInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Service\Pagination\PaginationConfig;

class NerEarthObjectHazardousPaginationService extends NerEarthObjectPaginationService {

    public function __construct(ViewEntityServiceInterface $entityService, EntityManager $em)
    {
        parent::__construct($entityService, $em);
    }

    function addFilters(QueryBuilder $qb, PaginationConfig $paginationConfig)
    {
        $qb = parent::addFilters($qb, $paginationConfig);

        $qb->andWhere($this->entityService->getViewAlias().".hazardous = true");

        return $qb;
    }
}