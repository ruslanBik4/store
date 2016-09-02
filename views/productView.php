<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 01.09.16
 * Time: 20:20
 */
class productView
{
    // тип представления (строка)
    private $viewType;

    public function __construct($viewType)
    {
        $this->viewType = $viewType;
    }

    public function Render($key, array $value)
    {
        switch ($this->viewType) {
            case 'action':
                return "<div id='actionProduct'><a href='product/id=$key'> {$value['name']} </a> {$value['price']}, {$value['action']}% </div>";
            case 'hits':
                return "<div id='hitsProduct'><a href='product/id=$key'> {$value['name']} </a> {$value['price']}, {$value['count_byes']}</div>";
            case 'new':
                return "<div id='newProduct'><a href='product/id=$key'> {$value['name']} </a> {$value['price']}</div>";
            case 'id':
                return "<div id='ID$key'> {$value['name']}, {$value['price']}, {$value['memo']}, </div>";
            default:
                return "<div> Неопредел вівод данніх </div>";
        }
    }

}