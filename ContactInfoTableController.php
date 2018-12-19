<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/2/2018
 * Time: 7:48 PM
 */

require_once('ContactInfoModel.php');
require_once('Database.php');

class ContactInfoTableController
{
    private $db;
    private static $controller = null;

    private function __construct()
    {
        $this->db = Database::getDB();
    }

    public static function getContactInfoTableController()
    {
        if (self::$controller == null)
            self::$controller = new ContactInfoTableController();
        return self::$controller;
    }

    public function getAllContacts()
    {
        $result = $this->db->performQuery("SELECT * FROM contact_info");
        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                $person = ContactInfoModel::instantiate($row);
                $object_Array[] = $person;
            }
            return $object_Array;
        }
    }

    public function getDB()
    {
        return $this->db;
    }
}