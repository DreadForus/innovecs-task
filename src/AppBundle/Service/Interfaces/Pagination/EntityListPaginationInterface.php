<?php

namespace AppBundle\Service\Interfaces\Pagination;

use AppBundle\Service\Pagination\Column;
use AppBundle\Service\Pagination\PaginationConfig;
use Symfony\Component\HttpFoundation\Request;

interface EntityListPaginationInterface extends PaginationInterface {

    /**
     * @param Request $request
     * @return array
     */
    public function getTableList(Request $request);

    /**
     * @return Column[]
     */
    function getTableListColumns();

    function getPaginationConfigFromRequest(Request $request);
}