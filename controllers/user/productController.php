<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 18.08.16
 * Time: 19:55
 */
class productController
{
    private $responce;
    private $repository;


    public function __construct($command)
    {
        $this->repository = new Repository('Product');
        switch ($command) {
            case 'action':
                $this->repository->SelectAction();
                break;
            case 'hits':
                $this->repository->SelectAll();
                break;
            case 'new':
                $this->repository->SelectNew();
                break;
        }

        $this->responce   = '';
        $view = new productView($command);
        foreach($this->repository as $key => $value ) {
            $this->responce  .= $view->Render($key, $value);
        }

    }

    public function getResponce()
    {
        return $this->responce;
    }

}