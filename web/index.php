<?php

require_once '../autoload.php';

$arrPath = explode('/', strtolower($_REQUEST['path']) );

switch ($arrPath[0]) {
    case 'admin':                    // ссылки вида {имя_сайта}/admin/*
        switch ($arrPath[1])  {
            case 'singin':              // ссылки вида {имя_сайта}/admin/singin/ (*)

                $parameters = explode('?', $arrPath[2]) ? : [];

                $loginController = new adminLoginController($parameters);

                $content = $loginController->getResponce();

            case 'stat':
            case 'customers':
            default:
            $content = implode('.', $arrPath);
        }

    default: // user controllers

}
include '../views/pages/main/header.html';
include '../views/pages/main/content.html';
include '../views/pages/main/footer.html';