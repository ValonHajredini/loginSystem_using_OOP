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
            $_session_name;

    public function __construct($user = null){
        $this->_db = DB::getInstance();
        $this->_session_name = Config::get('session/session_name');
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
    public function login($username = null, $password = null){
        $user = $this->find($username);
//       print_r($this->_data);
        if ($user){
            if ($this->data()->password === Hash::make($password,$this->data()->salt)){
                Session::put($this->_session_name, $this->data()->id);
                return true;
            }
        }

        return false;
    }
    private function data(){
        return $this->_data;
}

}