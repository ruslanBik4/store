<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 01.09.16
 * Time: 19:28
 */
class categoryView
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
            case 'view':
                return "<div><a href='/category/child=view&parentId=$key'> {$value['name']} </a></div>";
            case 'v_menu':
                return "<li><a href='/category/child=view&parentId=$key'> {$value['name']} </a> </li>";
            case 'id':
                return "<div> {$value['name']} </div> <div> {$value['memo']} </div> <div> {$value['task']} </div>";
            case 'parent':
                return "<div> <a href='/category/child=view&parentId=$key'>  {$value['name']} </a> </div> <div> {$value['memo']} </div> <div> {$value['task']} </div>";
            default:
                return "<div> Неопредел вівод данніх </div>";
        }
    }
}