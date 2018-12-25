<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/21/2018
 * Time: 11:24 PM
 */
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

session_start();
if (!isset($_SESSION['admin'])) {
    redirect_to("Login.php");
}

require_once('../UsersTableController.php');
require_once('../ValidationController.php');

$controller = UsersTableController::getUsersTableController();
$validationController = ValidationController::getValidationController();

$ID = isset($_POST['customerId']) ? $_POST['customerId'] : "";
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : "";
$lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$mobileNumber = isset($_POST["mobileNumber"]) ? $_POST["mobileNumber"] : "";
$address = isset($_POST["address"]) ? $_POST["address"] : "";
$blocked = isset($_POST["blocked"]) ? $_POST["blocked"] : "";


if(!$validationController->validateMobile($mobileNumber))
    redirect_to("EditCustomer.php?flag=1&id=".$ID);
else if(!$validationController->validateName($firstName) || !$validationController->validateName($lastName))
    redirect_to("EditCustomer.php?flag=2&id=".$ID);
else if(!$validationController->validateEmail($email))
    redirect_to("EditCustomer.php?flag=3&id=".$ID);
else if(!$validationController->validateAddress($address))
    redirect_to("EditCustomer.php?flag=4&id=".$ID);
else{
    $result = $controller->updateUser($ID, $firstName, $lastName, $blocked, $email, $mobileNumber, $address);
    if ($result)
        redirect_to("Customers.php?flag=1");
    else
        redirect_to("EditCustomer.php?flag=5&id=".$id);

}

?>
