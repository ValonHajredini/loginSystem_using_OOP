<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:32 PM
 */
class User{
    private $_db;

    public function __construct($user = null){
        $this->_db = DB::getInstance();
    }
    public function create($fields = array()){
        if (!$this->_db->insert('users', $fields)){
            throw new Exception('There wos a problem creating an acount');
        }
    }

}