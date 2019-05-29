<?php

namespace AppBundle\Service\Interfaces\EntityService;

use Doctrine\ORM\QueryBuilder;

interface EntityServiceInterface{

    /*
    * возвращает query builder для конкретного класса
    * пример: для класса MarketingFrameworkBundle::User возвращаем
    * $this->em->createQueryBuilder()->from("AppBundle:Domain", $alias);
    */
    function getQB($alias, $params = []);

    /*
    * возвращает колличество данных в таблице
    * пример: для класса MarketingFrameworkBundle::User возвращаем
    *
     * если алиаса нету, берем первый в запросе
     * if(!$alias){
            $alias = $queryBuilder->getRootAliases()
                [0]
            ;
        }

        $result =  $queryBuilder
            ->addSelect("COUNT(".$alias.")")
            ->getQuery()
            ->useResultCache(true, 360) // кеширование на уровне доктрины
            ->useQueryCache(true)
            ->getSingleResult()
            ['1']
        ;
    */
    function getCountResult(QueryBuilder $queryBuilder, $alias = null);
}