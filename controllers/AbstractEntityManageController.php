<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 10.09.16
 * Time: 13:22
 */
abstract class AbstractEntityManageController
{
    protected $responce;
    protected $repository;

    public function __construct($entity)
    {
        $this->repository = new Repository($entity);
    }

    public function getResponce()
    {
        return $this->responce;
    }

    protected function RenderAll($view)
    {
        $this->responce   = '';
        foreach($this->repository as $key => $value ) {
            $this->responce  .= $view->Render($key, $value);
        }

    }


}