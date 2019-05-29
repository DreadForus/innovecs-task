<?php

namespace AppBundle\Service\Interfaces\EntityService;

use Doctrine\ORM\QueryBuilder;

interface ViewEntityServiceInterface extends EntityServiceInterface {

    /**
     * @return QueryBuilder
     */
    function getViewAccessQB();

    /**
     * @return string
     */
    function getViewAlias();

    /**
     * @return array
     */
    function getViewList();
}