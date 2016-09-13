<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 10.09.16
 * Time: 11:50
 */
class Orders implements iRepositable
{
    const TABLE_NAME = 'Orders';
    // primary key, autoincrement
    private $id;
    private $idCustomers;
    /**
     * @var timestamp
     * @ORM\Column(name="date_check", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $dateCheck;

    /**
     * Определяем число записей в таблице
     * @return string
     */
    static public function CountRecord()
    {
        return 'select count(*) from ' . self::TABLE_NAME;

    }
    /**

    /**
     * получение всех записей таблицы
     * @return string
     */
    static public function SelectAll()
    {
        return "select * from  " . self::TABLE_NAME;

    }
    /**
     * получение всех записей для определенного покупателя
     * @return string
     */
    static public function fromCustomer($idCustomer)
    {
        return "select * from " . self::TABLE_NAME . " where id_Customer = $idCustomer";

    }


    /**
     * fromID to get SQL filet from ID field
     * @link http://php-academy.com.ua
     * @param integer $id <p>
     * The $id to get record.
     * </p>
     * @return string
     * @since 5.0.0
     */
    static public function fromID($id)
    {
        // TODO: Implement fromID() method.
    }
}