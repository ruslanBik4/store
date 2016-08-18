<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 12.08.16
 * Time: 19:18
 * @property Repository repository
 */
class categoryController
{
    private $responce;
    private $repository;


    public function __construct()
    {
        $this->repository = new Repository('Category');
        $this->responce   = $this->repository->getList( ['name'] );
    }

    public function getResponce()
    {
        return $this->responce;
    }
}