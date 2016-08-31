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
        $this->repository->SelectAll();

        switch ($command) {
            case 'parent':
                $this->responce   = $this->repository->getList( ['name'] );
                break;
            case 'child=v_menu':
                $this->responce   = '';
                foreach($this->repository as $key => $value ) {
                    $this->responce   .= "<li><a href='category/id=$key'> {$value['name']} </a> </li>";
                }
                break;
            case 'child=view':
                $this->responce   = 'Перечень дочерних категорий типа view';
                foreach($this->repository as $key => $value ) {
                        $this->responce .= "<div><a href='category/id=1'> {$value['name']} </a></div>";
                }
                break;
            case 'id={}':

            default:
            $this->responce = 'Default from Category';
        }
    }

    public function getResponce()
    {
        return $this->responce;
    }
}