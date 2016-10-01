<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:33 PM
 */
class Validate {
            //  private variable for checking if the validation is passed
    private $_past      = false,
            //  Holds the validation errors
            $_errors    = [],
            //  Holds the database instance
            $_db        = null;
    //  instansiated the database class DB
    public function __construct(){
        $this->_db = DB::getInstance();
    }
    //  Checks the inputs for the validation if it passed or not
    public function check($sources, $items = []){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $rule_value){
                $value = trim($sources[$item]);
                $item = escape($item);
                if ($rule === 'required' && empty($value)){
                    $this->addError("<b>{$item}</b> is required");
                } else if(!empty($value)){
                    switch ($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError(" The langth of <b>{$item}</b> mas be min <b>{$rule_value}</b> characteres");
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError(" The langth of <b>{$item}</b> mas be max <b>{$rule_value}</b> characteres");
                            }
                        break;
                        case 'matches':
                            if ($value != $sources[$rule_value]){
                                $this->addError("  <b>{$item }</b> mas match the <b>{$rule_value}</b> ");
                            }
                        break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, [$item,'=', $value]);
                            if ($check->count()){
                                $this->addError("The  <b>{$item }</b> \"<b>{$value}</b>\" already egzists, the <b>{$item}</b> mast be  <b>unique</b> ");
                            }
                        break;
                        case 'required':
                            if ($rule === 'required' && empty($value)){
                                $this->addError("<b>{$item}</b> is required");
                            }
                            break;
                        default:
                            $this->addError("The validation <b>{$rule}</b> does not exsist");

                            break;
                    }
                }
            }
        }
        if(empty($this->_errors)){
            $this->_past = true;
        }
        return $this;
    }
    //  Adds the error to the arrau variable _error
    private function addError($error){
        $this->_errors[] = $error;
    }
    //  Returns all errors on the array _errors
    public function errors(){
        return $this->_errors;
    }
    //  When no errors returns tru for passing the validation
    public function passed(){
        if(!$this->_errors){
            return true;
        }else {
            return false;
        }
    }
}