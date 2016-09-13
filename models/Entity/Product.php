<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 18.08.16
 * Time: 19:57
 */
class Product extends Table
{
    const TABLE_NAME = 'product';

    private $name;
    private $price;
    private $parentID;
    private $action = false;
    private $new = false;
    static protected $where = '';
    static protected $orderBy = 'order by name';

    /**
     * Определяем число записей в таблице
     * @return integer
     */
    static public function CountRecord()
    {
        return parent::getSQLCountRecord();

    }

    /**
     * получить списком акционные товары
     * @return string
     */
    static public function SelectAction()
    {
        self::$where = ' where action = 1 ';
        return parent::getSQLTemplate();
    }

    /**
     * получить списком товары - новинки
     * @return string
     */
    static public function SelectNew()
    {
        self::$where = ' where new = 1 ';
        return parent::getSQLTemplate();

    }

    /**
     * получение всех записей
     * @return string
     */
    static public function SelectAll()
    {
        return parent::getSQLTemplate();
    }

    static public function fromId($id)
    {
        self::$where = ' where id = $id';
        return parent::getSQLTemplate();
    }

}