<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 10.09.16
 * Time: 11:22
 */
class customersView
{
    // тип представления (строка)
    private $viewType;
    private $beginView;
    private $endView;

    public function __construct($viewType = null)
    {
        $this->viewType = $viewType ? : 'table';
        switch ($this->viewType ) {
            case 'table':
                $this->beginView = '<table border="1"><tbody>';
                $this->endView   = '</tbody></table>';
                break;
            default:
                $this->beginView = $this->endView   = '';

        }
    }

    public function Render($key, array $value)
    {
        switch ($this->viewType) {
            case 'table':
                return "<tr><td>{$value['name']}</td><td>{$value['email']}</td><td>{$value['phone']}</td><td>{$value['date_reg']}</td></tr>";
            case 'view':
                return "<div>{$value['name']} {$value['date_reg']}</div>";
            default:
        }
    }

    /**
     * @return string
     */
    public function getBeginView()
    {
        return $this->beginView;
    }

    /**
     * @return string
     */
    public function getEndView()
    {
        return $this->endView;
    }

}