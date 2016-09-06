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
        $arrCommand = explode('=', $command );

        switch ($arrCommand[0]) {
            case 'action':
                $this->repository->SelectAction();
                break;
            case 'hits':
                $this->repository->SelectAll();
                break;
            case 'new':
                $this->repository->SelectNew();
                break;
            case 'id':
                if (  !( (integer)$arrCommand[1] > 0) )  {
                    $this->responce   = "Значение номера категории должно быть положительным числом!"  . $arrCommand[1];
                    return;
                }
                
                $this->repository->fromID($param);
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