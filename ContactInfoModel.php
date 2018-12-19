<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/2/2018
 * Time: 7:46 PM
 */

class ContactInfoModel
{
    private $id;
    private $contactNum;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContactNum()
    {
        return $this->contactNum;
    }

    /**
     * @param mixed $contactNum
     */
    public function setContactNum($contactNum)
    {
        $this->contactNum = $contactNum;
    }

}