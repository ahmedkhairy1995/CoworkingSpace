<?php
/**
 * Created by PhpStorm.
 * User: Khairy
 * Date: 12/2/2018
 * Time: 8:13 PM
 */

require_once('ImagesModel.php');
require_once('Database.php');

class ImagesTableController
{
    private $db;
    private static $controller = null;

    private function __construct()
    {
        $this->db = Database::getDB();
    }

    public static function getImagesTableController()
    {
        if (self::$controller == null)
            self::$controller = new ImagesTableController();
        return self::$controller;
    }

    public function getAllImages()
    {
        $result = $this->db->performQuery("SELECT * FROM images");
        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                $image = ImagesModel::instantiate($row);
                $object_Array[] = $image;
            }
            return $object_Array;
        }
    }

    public function getImageById($id)
    {
        $result = $this->db->performQuery("SELECT * FROM images where imageID={$id}");
        if (isset($result) && isset(self::$controller)) {
            $object_Array = array();
            while ($row = $this->db->fetchArray($result)) {
                $image = ImagesModel::instantiate($row);
                $object_Array[] = $image;
            }
            if (empty($object_Array))
                return null;
            return $object_Array[0];
        }
    }

    public function getDB()
    {
        return $this->db;
    }
}