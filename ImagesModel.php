<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/2/2018
 * Time: 8:08 PM
 */

class ImagesModel
{
    private $imageID;
    private $name;
    private $deleted;

    /**
     * @return mixed
     */
    public function getImageID()
    {
        return $this->imageID;
    }

    /**
     * @param mixed $imageID
     */
    public function setImageID($imageID)
    {
        $this->imageID = $imageID;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
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