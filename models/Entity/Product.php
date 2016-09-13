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

    /**
     * Определяем число записей в таблице
     * @return integer
     */
    static public function CountRecord()
    {
        return 'select count(*) from ' . self::TABLE_NAME;

    }

    /**
     * получить списком акционные товары
     * @return string
     */
    static public function SelectAction()
    {
        return parent::getSQLTemplate() . ' where action = 1';
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
        return parent::getSQLTemplate() . " where id = $id";
    }

}