<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 12.08.16
 * Time: 19:11
 */
class repository implements Iterator
{
    // имя таблицы, с которой работаем (либо, представления)
    private $name;
    // количество записей
    private $countRecords = -1;

    private $tableRes;
    private $row = null;

    public function __construct($name)
    {
        $this->name = $name;
    }
    public function SelectAll()
    {
        $this->tableRes = $this->name::SelectAll();

    }

    public function SelectAction()
    {
        $this->tableRes = $this->name::SelectAction();

    }
    public function SelectNew()
    {
        $this->tableRes = $this->name::SelectNew();

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

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        // TODO: Implement current() method.
        return $this->row;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        // TODO: Implement next() method.
        $this->row=mysqli_fetch_assoc($this->tableRes);
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        // TODO: Implement key() method.
        return $this->row['id'];
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        // TODO: Implement valid() method.
        return $this->row;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }
}