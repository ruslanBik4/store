<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 10.09.16
 * Time: 14:05
 */
class Table
{

    static protected function getSQLTemplate()
    {
       return 'select * from ' . static::TABLE_NAME . static::$where . static::$orderBy;
    }
    static protected function getSQLCountRecord()
    {
        return 'select count(*) from ' . static::TABLE_NAME;
    }
}