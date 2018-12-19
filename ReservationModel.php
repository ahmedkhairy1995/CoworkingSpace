<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/4/2018
 * Time: 8:29 PM
 */

class ReservationModel
{
    private $user_id;
    private $room_no;
    private $startTime;
    private $endTime;
    private $reservation_id;
    private $projector;
    private $markers;
    private $whiteBoard;
    private $AC;
    private $date;
    private $Capacity;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getRoomNo()
    {
        return $this->room_no;
    }

    /**
     * @param mixed $room_no
     */
    public function setRoomNo($room_no)
    {
        $this->room_no = $room_no;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @return mixed
     */
    public function getReservationId()
    {
        return $this->reservation_id;
    }

    /**
     * @param mixed $reservation_id
     */
    public function setReservationId($reservation_id)
    {
        $this->reservation_id = $reservation_id;
    }

    /**
     * @return mixed
     */
    public function getProjector()
    {
        return $this->projector;
    }

    /**
     * @param mixed $projector
     */
    public function setProjector($projector)
    {
        $this->projector = $projector;
    }

    /**
     * @return mixed
     */
    public function getMarkers()
    {
        return $this->markers;
    }

    /**
     * @param mixed $markers
     */
    public function setMarkers($markers)
    {
        $this->markers = $markers;
    }

    /**
     * @return mixed
     */
    public function getWhiteBoard()
    {
        return $this->whiteBoard;
    }

    /**
     * @param mixed $whiteBoard
     */
    public function setWhiteBoard($whiteBoard)
    {
        $this->whiteBoard = $whiteBoard;
    }

    /**
     * @return mixed
     */
    public function getAC()
    {
        return $this->AC;
    }

    /**
     * @param mixed $AC
     */
    public function setAC($AC)
    {
        $this->AC = $AC;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->Capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity)
    {
        $this->Capacity = $capacity;
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