<?php

namespace AppBundle\Service\Pagination;

class PaginationConfig
{
    public $page = 1;
    public $length = 10;
    public $sortBy = 'desc';
    public $sortParam;
    public $requestData;
}