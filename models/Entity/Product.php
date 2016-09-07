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
    private $action = false;
    private $new = false;
//* @property mysqli conn
    static private $conn = null;

    static public function SelectAction()
    {
        return 'select * from products where action = 1';
    }
    static public function SelectNew()
    {
        return 'select * from products where new = 1 ';

    }
    static public function SelectAll()
    {
        return 'select * from products ';
    }

    static public function fromId($id)
    {
        return "select * from products where id = $id";
    }

}