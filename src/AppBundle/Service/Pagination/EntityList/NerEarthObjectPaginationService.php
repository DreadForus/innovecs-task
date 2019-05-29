<?php

namespace AppBundle\Service\Pagination\EntityList;

use AppBundle\Service\Abstraction\Pagination\AbstractEntityListPaginationService;
use AppBundle\Service\Interfaces\EntityService\ViewEntityServiceInterface;
use AppBundle\Service\Pagination\Column;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Service\Pagination\PaginationConfig;
use Symfony\Component\HttpFoundation\Request;

class NerEarthObjectPaginationService extends AbstractEntityListPaginationService {

    public function __construct(ViewEntityServiceInterface $entityService, EntityManager $em)
    {
        parent::__construct($entityService, $em);
    }

    /**
     * @return Column[]
     */
    function getTableListColumns()
    {
        return [
            new Column(
                $this->entityService->getViewAlias().".date",
                "date",
                0,
                Column::IS_STRING,
                Column::IS_LIKE
            ),
            new Column(
                $this->entityService->getViewAlias().".reference",
                "reference"
            ),
            new Column(
                $this->entityService->getViewAlias().".speedPerSecond",
                "speed_per_second"
            ),
            new Column(
                $this->entityService->getViewAlias().".name",
                "name"
            ),
            new Column(
                $this->entityService->getViewAlias().".hazardous",
                "hazardous"
            ),
        ];
    }

    function getPaginationConfigFromRequest(Request $request)
    {
        $paginationConfig = new PaginationConfig();
        if($request->query->get("page")){
            $paginationConfig->page = intval($request->query->get("page"));
        }
        if($request->query->get("length")){
            $paginationConfig->length = intval($request->query->get("length"));
        }
        if($request->query->get("sortBy")){
            $paginationConfig->sortBy = $request->query->get("sortBy");
        }else{
            $paginationConfig->sortBy = 'desc';
        }
        if($request->query->get("sortParam")){
            $paginationConfig->sortParam = $request->query->get("sortParam");
        }else{
            $paginationConfig->sortParam = 'id';
        }

        $paginationConfig->requestData = $request->query->all();

        return $paginationConfig;
    }
}