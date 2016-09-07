<?php

/**
 * Created by PhpStorm.
 * User: rus
 * Date: 05.08.16
 * Time: 19:31
 */
class adminLoginFormClass
{
   public function Render() {
       $text =  file_get_contents( __DIR__ . '/../templates/adminLoginForm.html');

       return preg_replace('/PATH_WWW/', PATH_WWW, $text) ;

 }
}