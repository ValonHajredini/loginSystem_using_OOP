<?php
/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:34 PM
 */
session_start();
$GLOBALS['config'] = array(
    'mysql'     => array(
        'host'          => '127.0.0.1',
        'username'      => 'root',
        'password'      => '',
        'db_name'       => 'loginSystem'
    ),
    'remember'  =>array(
        'cookie_name'   => 'hash',
        'cookie_expiry' => 604800
    ),
    'session'   =>array(
        'session_name'  => 'user',
        'token_name'    => 'token'
    )
);
spl_autoload_register(function ($class){
        require_once 'classes/'.$class.'.php';
});
require_once 'functiones/Sanitize.php';
class init
{

}
