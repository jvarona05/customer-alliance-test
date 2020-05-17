<?php

namespace App\DataFixtures\Utils;

use App\Services\DB;

trait FixtureUtils
{
    public function __construct(DB $db) 
    {
        $db->truncateTable($this->tableName);
    }

    public function getData() : array
    {
        try 
        {
            $path = __DIR__."/../data/{$this->tableName}.json";

            return json_decode(file_get_contents($path), true);
        }
        catch (exception $e) 
        {
            die("Error loading {$fileName}.json\n");
        }
    }
}