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

        $arrCommands = explode('&', $command );
        $arrCommand = explode('=', $arrCommands[0] );

        switch ($arrCommand[0]) {
            case 'child':
                $this->responce   = '';
                if ($_REQUEST['parentId']) {
                    $this->repository->runCommand('fromParent', ['key_parent' => $_REQUEST['parentId'] ] );

                } else {
                    $this->repository->SelectAll();

                }
                $view = new categoryView($arrCommand[1]);

                foreach($this->repository as $key => $value ) {
                        $this->responce .= $view->Render($key, $value);
                }
                break;
            case 'id':

                if (  !( (integer)$arrCommand[1] > 0) )  {
                    $this->responce   = "Значение номера категории должно быть положительным числом!"  . $arrCommand[1];
                    return;
                }

                $this->responce   = 'Показ одной записи №' . $arrCommand[1];

                $value = $this->repository[$arrCommand[1]];

//                $this->repository[$arrCommand[1]] = 0;

                $view = new categoryView('id');

                $this->responce .= $view->Render( $arrCommand[1], $value);

                break;

            case 'parent':
            default:
                $this->repository->runCommand('SelectParent');
                $this->responce   = '';
                $view = new categoryView('parent');

                foreach($this->repository as $key => $value ) {
                    $this->responce .= $view->Render($key, $value);
                }
                break;
        }
    }

    public function getResponce()
    {
        return $this->responce;
    }
}