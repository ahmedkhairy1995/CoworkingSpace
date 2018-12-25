<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/25/2018
 * Time: 4:04 PM
 */

class ValidationController
{
    private static $controller = null;

    public static function getValidationController()
    {
        if (self::$controller == null)
            self::$controller = new ValidationController();
        return self::$controller;
    }

    public function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);

    }

    public function validatePassword($password){
        if (strlen($password) <= '8') {
           return false;
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            return false;
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            return false;
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            return false;
        } else {
          return true;
        }
    }

    public function validateName($name){
        return preg_match("/^[a-zA-Z ]*$/",$name);
    }
    public function validateMobile($mobile)
    {
        return preg_match('/^[0-9]{11}+$/', $mobile);
    }
    public function validateAddress($address)
    {
        return preg_match('/^\d+ ,[a-zA-Z .]+, [a-zA-Z ]+$/', $address);
    }
}