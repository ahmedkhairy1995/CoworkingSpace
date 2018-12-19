<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 11/28/2018
 * Time: 11:50 AM
 */

require_once('Database.php');
require_once('Person.php');

class PersonsController
{
    private $db;
    private static $controller = null;

    private function __construct()
    {
        $this->db = Database::getDB();
    }

    public static function getPersonsController()
    {
        if (self::$controller == null) {
            self::$controller = new PersonsController();
        }
        return self::$controller;
    }

    public function findAll()
    {
        $result = $this->db->performQuery("SELECT * FROM rooms");
        return $result;
    }

    public function findRoom()
    {
        $result = $this->db->performQuery("SELECT * FROM rooms where roomID=1");
        return $result;
    }

    public function getDB()
    {
        return $this->db;
    }

    public function authenticate($_Email, $_password)
    {
        //To prevent SQL Injection
        $_username = $this->db->mysqli_prep($_username);
        $_password = $this->db->mysqli_prep($_password);

        $_password = md5($_password);
        $sql = "Select * FROM users where email='{$_Email}' AND password='{$_password}' LIMIT 1";
        $result = $this->getDB()->performQuery($sql);
        if ($result) {
            $record = $this->db->fetchArray($result);
            return $record['first_name'];
        }
    }

    public function insertPerson($first_name, $last_name, $age)
    {
        $query = "INSERT INTO persons VALUES ( '{$first_name}', '{$last_name}','{$age}')";
        $result = $this->getDB()->performQuery($query);
        if ($result) {
            $record = $this->db->fetchArray($result);
            return $record['first_name'];
        }
    }

    public function getPersons()
    {
        $result = $this->db->performQuery("SELECT * FROM persons");
        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = self::$controller->getDB()->fetchArray($result)) {
                $person = Person::instantiate($row);
                $object_Array[] = $person;
            }
            return $object_Array;
        }
    }
}