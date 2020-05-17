<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

class DB
{
    private $em;

    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;     
    }

    public function truncateTable($tableName)
    {
        $connection = $this->em->getConnection();

        $connection->executeQuery("
            SET FOREIGN_KEY_CHECKS = 0;
            TRUNCATE {$tableName};
            SET FOREIGN_KEY_CHECKS = 1;
        ");
    }
}