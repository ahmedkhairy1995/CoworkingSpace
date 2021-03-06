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

    public function getContactById($Id)
    {
        $result = $this->db->performQuery("SELECT * FROM contact_info WHERE id = {$Id}");
        $object_Array = array();
        if (isset($result) && isset(self::$controller)) {
            while ($row = $this->db->fetchArray($result)) {
                $contact = ContactInfoModel::instantiate($row);
                $object_Array[] = $contact;
            }
            if (empty($object_Array))
                return null;
            return $object_Array[0];
        }
    }

    public function insertContact($contact)
    {
        $query = "INSERT INTO contact_info (contactNum) VALUES('{$contact}');";
        $result = $this->getDB()->performQuery($query);
        if (isset($result)){
            return true;
        }
        return false;
    }
    public function updateContact($id, $contactNum)
    {
        $query = "UPDATE contact_info SET contactNum='{$contactNum}' WHERE  id={$id}";
        $result = $this->getDB()->performQuery($query);
        if ($result)
            return true;
        return false;
    }
    public function deleteContact($id)
    {
        $query = "Delete from contact_info where id={$id}";
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