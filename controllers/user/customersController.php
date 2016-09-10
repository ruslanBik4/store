<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 10.09.16
 * Time: 10:56
 */
class customersController
{
    private $responce;
    private $repository;


    public function __construct($command)
    {
        $this->repository = new Repository('Customers');
        $this->repository->SelectAll();

        $this->responce   = '';
        $view = new customersView($command);
        if (!$command || ($command == 'table') ) {
            $this->responce   = $view->getBeginView();

        }
        // получаем вывод на каждую запись
        foreach($this->repository as $key => $value ) {
            $this->responce  .=  $view->Render($key, $value);
        }
        if (!$command || ($command == 'table') ) {
            $this->responce   .= $view->getEndView();

        }

    }

    public function getResponce()
    {
        return $this->responce;
    }

}