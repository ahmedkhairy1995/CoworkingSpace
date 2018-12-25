<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/19/2018
 * Time: 6:23 PM
 */
require_once('AdminTableController.php');
$adminController = AdminTableController::getAdminTableController();


$result = $adminController->signup("admin","31032016May","May","Abdeldayem");
