<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 18.08.16
 * Time: 19:57
 */
class Product
{
    private $name;
    private $price;
    private $parentID;

    static public function runSQL($sql)
    {
        self::$conn = mysqli_connect(dbconfig::HOST, dbconfig::LOGIN, dbconfig::PASSWORD, dbconfig::DATABASE);
        $result = mysqli_query( self::$conn, $sql );

        return $result;
    }
    static public function SelectAll()
    {
        $sql = 'select * from category ';

        return self::runSQL($sql);

    }

}