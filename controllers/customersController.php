<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 01.10.16
 * Time: 13:53
 */
class customersController extends AbstractEntityManageController
{

    public function __construct($command)
    {
        parent::__construct($command);
        $this->RenderAll();
    }

    protected function getSQL()
    {
        // TODO: Implement getSQL() method.
        switch ($this->command) {
            case 'all':
                return 'select * from customers';
            case 'last_month':
                return 'select * from customers where customerNumber in ()';
            default:

        }
    }

    protected function Render($key, $row)
    {
        // TODO: Implement Render() method.
        return "$key - ". $row['customerName'];
    }
}