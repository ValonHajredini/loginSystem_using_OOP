<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:32 PM
 */
class User{
            // Holds the database instance
    private $_db,
            //  Holds the user data
            $_data,
            //  Holds the LogedIn session name
            $_session_name,
            //  Holds the cookieName
            $_cookieName,
            // Holds the login status
            $_isLogedIn;
    //  when the User class is instantiated makes the database instance, gets the session name from the global config array,
    //  and the cookie name from the global config array and checks if the user is logged in or not
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
    //  Creates the new user  from the register.php page
    public function create($fields = []){
        if (!$this->_db->insert('users', $fields)){
            throw new Exception('There wos a problem creating an acount');
        }
    }
    //  Updates the user details
    public function update($fields = [], $id = null){
        if (!$id && $this->isLogedIn()){
            $id = $this->data()->id;
        }
        if(!$this->_db->update('users', $id, $fields)){
            throw new Exception('There wos a problem updating.');
        }else {

        }
    }
    //  Finds the user using id or username
    public function find($user = null){
        if($user){
            $field = (is_numeric($user))? 'id' : 'username';
            $data = $this->_db->get('users', [$field , '=' , $user]);
            if ($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
    }
    //  Logs in the user using username and password and creates a cooki when the Remember is on
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

                        $hashCheck = $this->_db->get('users_session', ['user_id', '=', $this->data()->id]);
                        echo '4 ->' . $hashCheck->count();
                        if (!$hashCheck->count()) {
                            $ins = $this->_db->insert('users_session', ['user_id' => $id, 'hash' => $hash ]);
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
    //  Returns the user data
    public function data(){
        return $this->_data;
    }
    //  Returns the _isLofedIn private variable
    public function isLogedIn(){
        return $this->_isLogedIn;
    }
    // Destroys the session and cookie and logged out the user
    public function logout(){
        $this->_db->delete('users_session', ['user_id', '=', $this->data()->id]);
        Session::delete($this->_session_name);
        Cookie::delete($this->_cookieName);
    }
    //  Cheks if the user hav permissions or not, cheks if the user is admin or editor or a standard user
    public  function hasPermission($key){
        $group = $this->_db->get('groups', ['id', '=', $this->data()->group_id]);
        if ($group->count()){
            $permitions = json_decode($group->first()->permissins, true);
            if($permitions[$key] == true){
                return true;
            } else {
                return false;
            }
        }
    }
    //  Chekes if the _data is emty or not when not empty return true else returns false
    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

}