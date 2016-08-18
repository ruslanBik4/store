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


    public function __construct()
    {
        $this->repository = new Repository('Product');
        $this->responce   = $this->repository->getList( ['name'] );
    }

    public function getResponce()
    {
        return $this->responce;
    }

}