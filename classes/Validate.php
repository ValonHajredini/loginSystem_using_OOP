<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:33 PM
 */
class Validate {
    private $_past      = false,
            $_errors    = array(),
            $_db        = null;
    public function __construct(){
        $this->_db = DB::getInstance();
    }
    public function check($sources, $items = array()){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $rule_value){
//                echo "{$item} {$rule} must be {$rule_value}<br>";
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
                            $check = $this->_db->get($rule_value, array($item,'=', $value));
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
    private function addError($error){
        $this->_errors[] = $error;
    }
    public function errors(){
        return $this->_errors;
    }
    public function passed(){
        if(!$this->_errors){
            return true;
        }else {
            return false;
        }
    }
}