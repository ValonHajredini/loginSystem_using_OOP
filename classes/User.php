<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:32 PM
 */
class User{
    private $_db,
            $_data,
            $_session_name,
            $_cookieName,
            $_isLogedIn;

    public function __construct($user = null){
        $this->_db = DB::getInstance();
        $this->_session_name    = Config::get('session/session_name');
        $this->_cookieName      = Config::get('remember/cookie_name');
        if(!$user){
            if(Session::exists($this->_session_name)){
                $user = Session::get($this->_session_name);
                if($this->find($user)){
                    $this->_isLogedIn = true;
                }else {
                    //Process logout
                }
            }
        }else {
            $this->find($user);
        }
    }
    public function create($fields = array()){
        if (!$this->_db->insert('users', $fields)){
            throw new Exception('There wos a problem creating an acount');
        }
    }
    public function find($user = null){
        if($user){
            $field = (is_numeric($user))? 'id' : 'username';
            $data = $this->_db->get('users', array($field , '=' , $user));
            if ($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
    }
    public function login($username = null, $password = null, $remember = false)
    {

        if (!$username && !$password && $this->exists()) {
            Session::put($this->_session_name, $this->data()->id);

        } else {
            $user = $this->find($username);

        if ($user) {
                if ($this->data()->password === Hash::make($password, $this->data()->salt)) {
                    Session::put($this->_session_name, $this->data()->id);
                    if ($remember) {
                        $hash = Hash::unique();
                        echo '2 ->' . $hash . '<br>';
                        echo '3 -> ' . $this->data()->id . '<br>';
                        $id = $this->data()->id;

                        $hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));
                        echo '4 ->' . $hashCheck->count();
                        if (!$hashCheck->count()) {
                            $ins = $this->_db->insert('users_session', array(
                                'user_id' => $id,
                                'hash' => $hash
                            ));
                            echo '5 -> ' . $ins;
    //                        die();
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }
        }
    return false;
    }
    public function data(){
        return $this->_data;
    }
    public function isLogedIn(){
        return $this->_isLogedIn;
    }
    public function logout(){
        $this->_db->delete('users_session', ['user_id', '=', $this->data()->id]);
        Session::delete($this->_session_name);
        Cookie::delete($this->_cookieName);
    }
    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

}