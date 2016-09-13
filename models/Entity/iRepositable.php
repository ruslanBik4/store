<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 10.09.16
 * Time: 13:13
 */
interface iRepositable
{
    static public function CountRecord();
    static public function SelectAll();
    /**
     * fromID to get SQL filet from ID field
     * @link http://php-academy.com.ua
     * @param integer $id <p>
     * The $id to get record.
     * </p>
     * @return string
     * @since 5.0.0
     */
    static public function fromID($id);

}