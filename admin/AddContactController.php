<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php
session_start();
if (!isset($_SESSION['admin']))
    redirect_to("Login.php");
require_once('../ValidationController.php');
require_once('../ContactInfoTableController.php');
$controller = ContactInfoTableController::getContactInfoTableController();
$validationController = ValidationController::getValidationController();

//Getting passed data
$contactNum = isset($_POST["contactNum"]) ? $_POST["contactNum"] : "";


if (!$validationController->validateMobile($contactNum))
    redirect_to("AddContact.php?flag=1&id=" . $ID);
else {
    $result = $controller->insertContact($contactNum);
    if ($result)
        redirect_to("Contacts.php?flag=1");
    else
        redirect_to("AddContact.php?flag=2");
}
?>