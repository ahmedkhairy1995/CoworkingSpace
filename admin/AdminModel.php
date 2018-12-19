<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/2/2018
 * Time: 8:08 PM
 */

class AdminModel
{
    private $firstName;
    private $lastName;
    private $username;
    private $password;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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