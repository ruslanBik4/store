<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 18.08.16
 * Time: 19:55
 */
class productController extends AbstractEntityManageController
{
    public function __construct($command)
    {
        parent::__construct('Product');
        $arrCommand = explode('=', $command );
        $command = $arrCommand[0];

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
            case 'id':
                if (  !( (integer)$arrCommand[1] > 0) )  {
                    $this->responce   = "Значение номера категории должно быть положительным числом!"  . $arrCommand[1];
                    return;
                }

                $this->repository->fromID( $arrCommand[1] );
                break;
        }

        $this->RenderAll(new productView($command));

    }

}