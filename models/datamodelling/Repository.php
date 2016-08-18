<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 12.08.16
 * Time: 19:11
 */
class repository
{
    // имя таблицы, с которой работаем (либо, представления)
    private $name;
    // количество записей
    private $countRecords = -1;

    private $tableRes;

    public function __construct($name)
    {
        $this->name = $name;
        $this->tableRes = $name::SelectAll();
    }

    public function getList(array $names)
    {
        $text = '';

        while ($row=mysqli_fetch_assoc($this->tableRes)) {

            foreach($row as $key => $value)
            {
                if (in_array($key, $names)) {
                    $text .= $value . '<br>';
                }

            }
        }

        return $text;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function __sleep()
    {
        // TODO: Implement __sleep() method.

        return [ 'name', 'countRecords' ];
    }

    /**
     * @return int
     */
    public function getCountRecords()
    {
        return $this->countRecords;
    }

    /**
     * @param int $countRecords
     */
    public function setCountRecords($countRecords)
    {
        $this->countRecords = $countRecords;
    }
}