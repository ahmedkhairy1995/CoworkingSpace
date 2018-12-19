<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/2/2018
 * Time: 8:13 PM
 */

require_once('AdminModel.php');
require_once('../Database.php');

class AdminTableController
{
    private $db;
    private static $controller = null;

    private function __construct()
    {
        $this->db = Database::getDB();
    }

    public static function getAdminTableController()
    {
        if (self::$controller == null)
            self::$controller = new AdminTableController();
        return self::$controller;
    }

    public function signup($username, $password, $firstName, $lastName)
    {
        $hashedPassword = md5($password);
        $query = "INSERT INTO admin VALUES ( '{$firstName}', '{$lastName}','{$username}','{$hashedPassword}')";
        $result = $this->getDB()->performQuery($query);
        if ($result) {
            return true;
        }
    }

    public function authenticate($username, $password)
    {
        $password = md5($password);
        $sql = "Select * FROM admin where Username='{$username}' AND Password='{$password}' LIMIT 1";
        $result = $this->getDB()->performQuery($sql);
        if (isset($result)) {
            $record = $this->db->fetchArray($result);
            return $record['Username'];
        }
    }

    public function getDB()
    {
        return $this->db;
    }
}