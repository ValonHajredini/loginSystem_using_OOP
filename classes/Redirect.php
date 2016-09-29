<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:31 PM
 */
class Redirect{
    public static function to($location = null){
        if($location){
            if (is_numeric($location)){
                switch ($location){
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        include 'includes/errors/404.php';
                        exit();
                    break;
                }

            }
            return header("Location:".$location.".php");
            exit();
        }
    }
}