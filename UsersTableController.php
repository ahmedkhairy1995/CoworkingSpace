<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/2/2018
 * Time: 5:36 PM
 */

require_once('Database.php');
require_once('User.php');

class UsersTableController
{
    private $db;
    private static $controller = null;

    private function __construct()
    {
        $this->db = Database::getDB();
    }

    public static function getUsersTableController()
    {
        if (self::$controller == null)
            self::$controller = new UsersTableController();
        return self::$controller;
    }

    public function getAllUsers()
    {
        $result = $this->db->performQuery("SELECT * FROM users");
        $object_Array = array();
        if (isset($result) && isset(self::$controller)) {
            while ($row = $this->db->fetchArray($result)) {
                $user = User::instantiate($row);
                $object_Array[] = $user;
            }
            return $object_Array;
        }
    }

    public function getUserByEmail($email)
    {
        $result = $this->db->performQuery("SELECT * FROM users WHERE email = '{$email}'");
        $object_Array = array();
        if (isset($result) && isset(self::$controller)) {
            while ($row = $this->db->fetchArray($result)) {
                $user = User::instantiate($row);
                $object_Array[] = $user;
            }
            return $object_Array[0];
        }
    }


    public function getUserByID($Id)
    {
        $result = $this->db->performQuery("SELECT * FROM users WHERE id = '{$Id}'");
        $object_Array = array();
        if (isset($result) && isset(self::$controller)) {
            while ($row = $this->db->fetchArray($result)) {
                $user = User::instantiate($row);
                $object_Array[] = $user;
            }
            if (empty($object_Array))
                return null;
            return $object_Array[0];
        }
    }

    public function getUserPassword($email)
    {
        $result = $this->db->performQuery("SELECT password FROM users WHERE email = '{$email}'");
        $object_Array = array();
        if (isset($result) && isset(self::$controller)) {
            while ($row = $this->db->fetchArray($result))
                $object_Array[] = $row;
            return $object_Array[0]['password'];
        }
    }

    public function insertNewUser($id, $first_name, $last_name, $password, $email, $birthday, $gender, $mobile_number, $address)
    {
        $query = "INSERT INTO `users` (id,first_name,last_name,password,email,birthday,gender,mobile_number,address) VALUES ({$id},'{$first_name}', '{$last_name}','{$password}','{$email}','{$birthday}','{$gender}','{$mobile_number}','{$address}');";
        $result = $this->getDB()->performQuery($query);
        if ($result)
            return true;
        return false;
    }

    public function updateUser($id, $first_name, $last_name, $blocked, $new_email, $mobile_number, $address)
    {
        $query = "UPDATE users SET first_name='{$first_name}',last_name='{$last_name}',blocked='{$blocked}',email='{$new_email}',mobile_number='{$mobile_number}',address='{$address}' WHERE  id='{$id}'";
        $result = $this->getDB()->performQuery($query);
        if ($result)
            return true;
        return false;
    }

    public function getDB()
    {
        return $this->db;
    }
}