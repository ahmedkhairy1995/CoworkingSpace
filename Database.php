<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 11/28/2018
 * Time: 11:41 AM
 */

class Database
{
    private static $db = null;
    private $dbConnection;
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "";
    private $dbName = "db_ebda3";
    private $last_query;
    private $error_code;
    private $error_message;
    private $real_escape_string_exists;
    private $magic_quotes_active;

    private function __construct()
    {
        $this->openConnection();
        $this->magic_quotes_active = get_magic_quotes_gpc();
        $this->real_escape_string_exists = function_exists("mysqli_real_escape_string");
    }

    public static function getDB()
    {
        if (self::$db == null) {
            //self is similar to using this but used in static methods
            self::$db = new self();
        }
        return self::$db;
    }

    private function openConnection()
    {
        $this->dbConnection = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);

        //Checking if connection is failed
        if (mysqli_connect_errno()) {
            die("Database connection failed: " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");//die is equivalent to exit
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }

    public function closeConnection()
    {
        if (isset($this->dbConnection)) {
            mysqli_close($this->dbConnection);
            unset($this->dbConnection);
        }
    }

    public function performQuery($query)
    {
        $this->last_query = $this->mysqli_prep($query);
        $result = mysqli_query($this->dbConnection, $this->last_query);
        $this->confirmQuery($result);
        return $result;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->error_code;
    }

    /**
     * @param mixed $error_message
     */
    public function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;
    }


    public function mysqli_prep(&$string)
    {
//        if ($this->real_escape_string_exists) {
//            if ($this->magic_quotes_active)
//                $string = stripslashes($string);
//
//            //Escapes special characters in a string for use in an SQL statement
//            $string = mysqli_real_escape_string($this->dbConnection, $string);
//        }
//        } else {
//            //if function does not exist
//            if (!$this->magic_quotes_active) {
//                //add slashes before quotes
//                $string = addslashes($string);
//            }
//        }
        return $string;
    }

    //returns an object which is treated as an associative array
    public function fetchArray($result)
    {
        return mysqli_fetch_assoc($result);
    }

    public function getNumRows($result)
    {
        return mysqli_num_rows($result);
    }

    public function getNumAffectedRows()
    {
        return mysqli_affected_rows($this->dbConnection);
    }

    //Testing if query succeeded or not
    private function confirmQuery($result)
    {
        if (!$result) {
            $outputError = "Database Query failed with Error: " . mysqli_error($this->dbConnection);
            $outputError .= " " . $this->last_query;
            $this->error_message = $outputError;
            $this->error_code = $this->dbConnection->error;
        }
    }
}