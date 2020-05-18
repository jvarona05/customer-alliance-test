<?php

namespace App\Services;

use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

class Paginator
{
    public function paginate($query, $currentPage, $pageSize)
    {
        $paginator  = new DoctrinePaginator($query);

        $totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);
        
        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($currentPage-1)) 
            ->setMaxResults($pageSize); 

        return $paginator;
    }
}