<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 18.08.16
 * Time: 19:57
 */
class Product
{
    const TABLE_NAME = 'product';

    private $name;
    private $price;
    private $parentID;
    private $action = false;
    private $new = false;
//* @property mysqli conn
    static private $conn = null;

    static public function SelectAction()
    {
        return 'select * from " . self::TABLE_NAME . " where action = 1';
    }
    static public function SelectNew()
    {
        return 'select * from " . self::TABLE_NAME . " where new = 1 ';

    }
    static public function SelectAll()
    {
        return 'select * from ' . self::TABLE_NAME;
    }

    static public function fromId($id)
    {
        return "select * from " . self::TABLE_NAME . " where id = $id";
    }

}