<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/4/2018
 * Time: 7:32 PM
 */

class RoomModel
{
    private $roomID;
    private $capacity;
    private $status;

    /**
     * @return mixed
     */
    public function getRoomID()
    {
        return $this->roomID;
    }

    /**
     * @param mixed $roomID
     */
    public function setRoomID($roomID)
    {
        $this->roomID = $roomID;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public static function instantiate($row)
    {
        $object = new self;
        foreach ($row as $column => $value) {
            if ($object->has_column($column))
                $object->$column = $value;
        }
        return $object;
    }

    private function has_column($column)
    {
        //returns an array with all keys
        $object_vars = get_object_vars($this);

        //check if the key exists
        return array_key_exists($column, $object_vars);
    }
}