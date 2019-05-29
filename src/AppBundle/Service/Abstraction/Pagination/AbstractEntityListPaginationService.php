<?php

namespace AppBundle\Service\Abstraction\Pagination;

use AppBundle\Service\Interfaces\Pagination\EntityListPaginationInterface;
use AppBundle\Service\Interfaces\EntityService\ViewEntityServiceInterface;
use AppBundle\Service\Pagination\PaginationConfig;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractEntityListPaginationService extends AbstractPaginationService implements EntityListPaginationInterface
{
    public function __construct(ViewEntityServiceInterface $entityService, EntityManager $em)
    {
        parent::__construct($entityService, $em);
    }

    public function getTotalCount(){
        $qb = $this->entityService->getViewAccessQB();
        if($this->needsCache()){
            $query = $qb->getQuery();

            $query
                ->useResultCache(true, $this->getCacheTime()) // кеширование на уровне доктрины
                ->useQueryCache(true)
            ;
        }
        return $this->entityService->getCountResult(
            $qb,
            sprintf("DISTINCT(%s)", $this->entityService->getViewAlias())
        );
    }

    public function getFilteredCount(PaginationConfig $paginationConfig){

        $qb = $this->entityService->getViewAccessQB();
        $qb = $this->addJoins($qb);
        $qb = $this->addFilters($qb, $paginationConfig);

        $countResult = $this->entityService->getCountResult(
            $qb,
            sprintf("DISTINCT(%s)", $this->entityService->getViewAlias())
        );
        return $countResult;
    }

    public function getTableList(Request $request){
        $paginationConfig = $this->getPaginationConfigFromRequest($request);

        return [
            'data'              => $this->getData($paginationConfig),
            'draw'              => $paginationConfig->page ? $paginationConfig->page : 1,
            'recordsTotal'      => $this->getTotalCount(),
            'recordsFiltered'   => $this->getFilteredCount($paginationConfig),
        ];
    }

    public function getData(PaginationConfig $paginationConfig)
    {
        $queryToGetData = $this->entityService->getViewAccessQB();

        $this->addSelects($queryToGetData);
        $this->addJoins($queryToGetData);
        $this->addFilters($queryToGetData, $paginationConfig);
        $this->addOrder($queryToGetData, $paginationConfig);
        $this->addGroupBy($queryToGetData, $paginationConfig);
        $this->addLimit($queryToGetData, $paginationConfig->length, $paginationConfig->page);

        $query = $queryToGetData->getQuery();

        if($this->needsCache()){
            $query
                ->useResultCache(true, $this->getCacheTime()) // кеширование на уровне доктрины
                ->useQueryCache(true)
            ;
        }
        return $query->getResult();
    }

    function getColumns(PaginationConfig $paginationConfig = null)
    {
        return $this->getTableListColumns();
    }

    public function addOrder(QueryBuilder $qb, PaginationConfig $paginationConfig){
        if($paginationConfig->sortParam){
            $qb->addOrderBy($this->entityService->getViewAlias().".".$paginationConfig->sortParam, $paginationConfig->sortBy);
        }

        return $qb;
    }

    function addJoins(QueryBuilder $queryBuilder)
    {
        return $queryBuilder;
    }
}