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
    protected $command;

    public function __construct($command)
    {
        $this->command = $command;
        $this->repository = new dbConnection($this->getSQL());
//        Repository($entity);
    }
    abstract protected function getSQL();
    abstract protected function Render($key, $row);

    public function getResponce()
    {
        return $this->responce;
    }

    protected function RenderAll()
    {
        $this->responce   = '';
        foreach($this->repository as $key => $row ) {
            $this->responce  .= $this->Render($key, $row);
        }

    }


}