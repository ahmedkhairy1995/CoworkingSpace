<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/2/2018
 * Time: 5:42 PM
 */

class User
{
    private $id;
    public $first_name;
    public $last_name;
    public $password;
    public $email;
    public $birthday;
    public $gender;
    public $mobile_number;
    public $address;
    public $blocked = false;

    public static function instantiate($row)
    {
        $object = new self;
        foreach ($row as $column => $value) {
            if ($object->has_column($column)) {
                $object->$column = $value;
            }
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
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getMobileNumber()
    {
        return $this->mobile_number;
    }

    /**
     * @param mixed $mobile_number
     */
    public function setMobileNumber($mobile_number)
    {
        $this->mobile_number = $mobile_number;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * @param mixed $blocked
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;
    }
}