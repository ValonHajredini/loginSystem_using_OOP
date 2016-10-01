<?php

/**
 * Created by PhpStorm.
 * User: hajre
 * Date: 9/28/2016
 * Time: 1:34 PM
 */
//  The escape function for htmlentities
function escape($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
class Sanitize
{

}