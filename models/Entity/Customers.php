<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 10.09.16
 * Time: 10:48
 */
class Customers
{
    const TABLE_NAME = 'Customers';
    // primary key, autoincrement
    private $id;
    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $email;
    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=25)
     */
    private $phone;
    /**
     * @var timestamp
     * @ORM\Column(name="date_reg", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $dateReg;

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

}