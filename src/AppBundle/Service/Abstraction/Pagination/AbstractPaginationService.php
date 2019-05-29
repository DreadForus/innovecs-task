<?php

namespace AppBundle\Service\Abstraction\Pagination;

use AppBundle\Service\Interfaces\Pagination\PaginationInterface;
use AppBundle\Service\Interfaces\EntityService\ViewEntityServiceInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Service\Pagination\PaginationConfig;

abstract class AbstractPaginationService implements PaginationInterface
{
    protected $entityService;
    protected $em;

    public function __construct(ViewEntityServiceInterface $entityService, EntityManager $em)
    {
        $this->entityService = $entityService;
        $this->em = $em;
    }

    protected function getColumnByDT($dt){
        foreach ($this->getColumns() as $column){
            if($column->getDt() == $dt){
                return $column;
            }
        }

        return null;
    }

    function addFilters(QueryBuilder $qb, PaginationConfig $paginationConfig)
    {
        return $qb;
    }

    protected function getColumnByDTNum($dtNum){
        foreach ($this->getColumns() as $column){
            if($column->getDtNum() == $dtNum){
                return $column;
            }
        }

        return null;
    }

    public function addSelects(QueryBuilder $qb, PaginationConfig $paginationConfig = null){

        foreach ($this->getColumns($paginationConfig) as $column){
            $qb->addSelect($column->getDb()." as ".$column->getDt());
        }

        return $qb;
    }

    public function addLimit(QueryBuilder $qb, $limit = 0, $page = 0){
        if($limit){
            $qb->setMaxResults($limit);

            $qb->setFirstResult(($page - 1) * $limit);
        }

        return $qb;
    }

    function addGroupBy(QueryBuilder $qb, PaginationConfig $paginationConfig)
    {
        return $qb;
    }

    function getCacheTime()
    {
        return 30;
    }

    function needsCache()
    {
        return false;
    }
}