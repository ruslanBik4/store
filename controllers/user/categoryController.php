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


    public function __construct($command)
    {
        $this->repository = new Repository('Category');
        switch ($command) {
            case 'parent':
                $this->responce   = $this->repository->getList( ['name'] );
                break;
            case 'child=v_menu':
                $this->responce   = '';
                foreach($this->repository as $key => $value ) {
                    $this->responce   .= '<a href="category/id=$key"> $value </a>';
                }
                break;
            case 'child=view':
                $this->responce   = $this->repository->getList( ['name'] );
                break;
            case 'id={}':


        }
    }

    public function getResponce()
    {
        return $this->responce;
    }
}