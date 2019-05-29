<?php

namespace AppBundle\Service\Interfaces\Pagination;

use AppBundle\Service\Pagination\Column;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Service\Pagination\PaginationConfig;

interface PaginationInterface{

    /**
     * @param QueryBuilder $qb
     * @param PaginationConfig $paginationConfig
     * @return QueryBuilder
     */
    function addFilters(QueryBuilder $qb, PaginationConfig $paginationConfig);

    /**
     * @param QueryBuilder $qb
     * @param PaginationConfig $paginationConfig
     * @return QueryBuilder
     */
    function addOrder(QueryBuilder $qb, PaginationConfig $paginationConfig);

    /**
     * @param QueryBuilder $qb
     * @param PaginationConfig $paginationConfig
     * @return QueryBuilder
     */
    function addGroupBy(QueryBuilder $qb, PaginationConfig $paginationConfig);

    /**
     * @param QueryBuilder $qb
     * @param int $limit
     * @param int $page
     * @return QueryBuilder
     */
    function addLimit(QueryBuilder $qb, $limit = 0, $page = 0);

    /**
     * @param QueryBuilder $queryBuilder
     * @return QueryBuilder
     */
    function addJoins(QueryBuilder $queryBuilder);

    /**
     * @param QueryBuilder $queryBuilder
     * @param PaginationConfig|null $paginationConfig
     * @return QueryBuilder
     */
    function addSelects(QueryBuilder $queryBuilder, PaginationConfig $paginationConfig = null);

    /**
     * @param PaginationConfig $paginationConfig
     * @return array
     */
    function getData(PaginationConfig $paginationConfig);

    /**
     * @return int
     */
    function getTotalCount();

    /**
     * @param PaginationConfig $paginationConfig
     * @return int
     */
    function getFilteredCount(PaginationConfig $paginationConfig);

    /**
     * @param PaginationConfig|null $paginationConfig
     * @return Column[]
     */
    function getColumns(PaginationConfig $paginationConfig = null);

    function getCacheTime();

    function needsCache();
}