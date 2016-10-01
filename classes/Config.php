<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:29 PM
 */
class Config{
//    This static Get() method gets a path and loks on the init.php global array[config]
    public static function get($path = null){
        if($path){
            $config = $GLOBALS['config'];
//            Explods the path in an array evry time when finds '/' and puts an new array index
            $path = explode('/', $path);
            foreach($path as $path_index){
                if(isset($config[$path_index])){
                    $config = $config[$path_index];
                }
            }
            return $config;
        } else {
            return false;
        }
    }

}