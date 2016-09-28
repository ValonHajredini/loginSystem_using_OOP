<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:29 PM
 */
class Config{
    public static function get($path = null){
        if($path){
            $config = $GLOBALS['config'];
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