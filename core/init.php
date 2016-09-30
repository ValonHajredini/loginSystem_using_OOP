<?php
/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:34 PM
 */
session_start();
$GLOBALS['config'] = [
    'mysql'     => [
        'host'          => '127.0.0.1',
        'username'      => 'root',
        'password'      => '',
        'db_name'       => 'loginSystem'
    ],
    'remember'  =>[
        'cookie_name'   => 'hash',
        'cookie_expiry' => 604800
    ],
    'session'   =>[
        'session_name'  => 'user',
        'token_name'    => 'token'
    ]
];
spl_autoload_register(function ($class){
        require_once 'classes/'.$class.'.php';
});
require_once 'functiones/Sanitize.php';
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
//echo 'User mast be logt in with cookie';
//    echo $_COOKIE[Config::get('remember/cookie_name')];
    $db = DB::getInstance();
    $hashCheck = $db->get('users_session', ['hash', '=',$_COOKIE[Config::get('remember/cookie_name')]]);
    if($hashCheck->count()){
        $user_id = $hashCheck->first()->user_id;
        $user = new User($user_id);
        $user->login();
    }

}
class init
{

}
