<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/4/2018
 * Time: 7:34 PM
 */

require_once('RoomModel.php');
require_once('Database.php');

class RoomTableController
{
    private $db;
    private static $controller = null;

    private function __construct()
    {
        $this->db = Database::getDB();
    }

    public static function getRoomTableController()
    {
        if (self::$controller == null)
            self::$controller = new RoomTableController();
        return self::$controller;
    }

    public function getAllRooms()
    {
        $result = $this->db->performQuery("SELECT * FROM rooms");
        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                $image = RoomModel::instantiate($row);
                $object_Array[] = $image;
            }
            return $object_Array;
        }
    }

    public function getAllFreeRooms()
    {
        $result = $this->db->performQuery("SELECT * FROM rooms where status=1");
        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                $image = RoomModel::instantiate($row);
                $object_Array[] = $image;
            }
            return $object_Array;
        }
    }

    public function getRoomByID($id)
    {
        $result = $this->db->performQuery("SELECT * FROM rooms where roomID={$id}");
        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                $image = RoomModel::instantiate($row);
                $object_Array[] = $image;
            }
            if (empty($object_Array))
                return null;
            return $object_Array[0];
        }
    }

    public function getCapacityOfRoom($roomId)
    {
        $result = $this->db->performQuery("SELECT Capacity FROM rooms WHERE roomID = {$roomId}");
        $object_Array = array();
        if (isset($result) && isset(self::$controller)) {
            while ($row = $this->db->fetchArray($result)) {
                $object_Array[] = $row;
            }
            return $object_Array[0]['Capacity'];
        }
    }

    public function insertRoom($capacity, $status)
    {
        $query = "INSERT INTO rooms (capacity,status) VALUES({$capacity},{$status});";
        echo $query;
        $result = $this->getDB()->performQuery($query);
        if (isset($result)){
            return true;
        }
        return false;
    }

    public function updateRoom($id, $capacity, $status)
    {
        $query = "UPDATE rooms SET capacity={$capacity},status={$status} WHERE  roomID={$id}";
        $result = $this->getDB()->performQuery($query);
        if ($result)
            return true;
        return false;
    }
    public function deleteRoom($id)
    {
        $query = "Delete from rooms where roomID={$id}";
        $result = $this->getDB()->performQuery($query);
        if ($result)
            return true;
        return false;
    }

    public function getCount()
    {
        $query = "select count(*) as count FROM rooms";
        $result = $this->getDB()->performQuery($query);
        if (isset($result)){
            $row = $this->db->fetchArray($result);
            return $row['count'];
        }

    }

    public function getDB()
    {
        return $this->db;
    }
}