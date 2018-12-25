<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/4/2018
 * Time: 8:32 PM
 */

require_once('ReservationModel.php');
require_once('Database.php');

class ReservationTableController
{
    private $db;
    private static $controller = null;

    private function __construct()
    {
        $this->db = Database::getDB();
    }

    public static function getReservationTableController()
    {
        if (self::$controller == null)
            self::$controller = new ReservationTableController();
        return self::$controller;
    }

    public function getAllReservations()
    {
        $result = $this->db->performQuery("SELECT * FROM reservation");
        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                $image = ReservationModel::instantiate($row);
                $object_Array[] = $image;
            }
            return $object_Array;
        }
    }

    public function checkRoomAvailability($RoomNumber, $From, $To, $Date)
    {
        $query = "SELECT COUNT(*) as count FROM reservation WHERE room_no = {$RoomNumber} AND (startTime between '{$From}' AND '{$To}' OR endTime between '{$From}' AND '{$To}%' OR endTime='{$To}' OR startTime='{$From}') AND date='{$Date}'";
        $result = $this->db->performQuery($query);

        if (isset($result)) {
            $row = $this->db->fetchArray($result);
            return $row['count'];
        }
        return 0;
    }

    public function checkRoomAvailabilityForOtherReservations($id, $RoomNumber, $From, $To, $Date)
    {
        $query = "SELECT COUNT(*) as count FROM reservation WHERE reservation_id!={$id} AND room_no = {$RoomNumber} AND (startTime between '{$From}' AND '{$To}' OR endTime between '{$From}' AND '{$To}%' OR endTime='{$To}' OR startTime='{$From}') AND date='{$Date}' ";
        $result = $this->db->performQuery($query);

        if (isset($result)) {
            $row = $this->db->fetchArray($result);
            return $row['count'];
        }
        return 0;
    }

    public function getReservationsOfUser($user_id, $TodayDate)
    {
        $query = "select * from reservation where user_id={$user_id} And Date >= '{$TodayDate}'";
        $result = $this->db->performQuery($query);

        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                $reservation = ReservationModel::instantiate($row);
                $object_Array[] = $reservation;
            }
            return $object_Array;
        }
    }

    public function getReservationById($reservation_id)
    {
        $query = "select * from reservation where reservation_id={$reservation_id}";
        $result = $this->db->performQuery($query);

        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                $reservation = ReservationModel::instantiate($row);
                $object_Array[] = $reservation;
            }
            if (empty($object_Array))
                return null;
            return $object_Array[0];
        }
    }

    public function insertReservation($userID, $RoomNumber, $From, $To, $Projector, $Marker, $WhiteBoard, $AC, $Date, $Capacity)
    {
        $query = "INSERT INTO reservation (user_id,room_no,startTime,endTime,projector,markers,whiteBoard,AC,date,capacity) VALUES({$userID},{$RoomNumber},'{$From}','{$To}','{$Projector}','{$Marker}','{$WhiteBoard}','{$AC}','{$Date}',{$Capacity});";
        $result = $this->getDB()->performQuery($query);
        if (isset($result))
            return true;
        return false;
    }

    public function updateReservation($Id, $userID, $RoomNumber, $From, $To, $Projector, $Marker, $WhiteBoard, $AC, $Date, $Capacity)
    {
        $query = "UPDATE reservation SET user_id=$userID,room_no=$RoomNumber,startTime='$From',endTime='$To',projector='$Projector',markers='$Marker',whiteBoard='$WhiteBoard',AC='$AC',date='$Date', capacity=$Capacity WHERE reservation_id = $Id";
        $result = $this->db->performQuery($query);
        if (isset($result))
            return true;
        return false;
    }

    public function deleteReservation($reservation_id)
    {
        $query = "Delete FROM reservation where reservation_id={$reservation_id}";
        $result = $this->getDB()->performQuery($query);
        if (isset($result))
            return true;
        return false;
    }
    public function getCount()
    {
        $query = "select count(*) as count FROM reservation";
        $result = $this->getDB()->performQuery($query);
        if (isset($result)){
            $row = $this->db->fetchArray($result);
            return $row['count'];
        }

    }

    public function getRevenue()
    {
        $query = "select startTime,endTime FROM reservation";
        $result = $this->getDB()->performQuery($query);
        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                return row['endTime'] - row['startTime'];
            }
            return $object_Array;
        }
    }

    public function getDB()
    {
        return $this->db;
    }

}