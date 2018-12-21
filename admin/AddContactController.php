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

require_once('../ContactInfoTableController.php');
$controller = ContactInfoTableController::getContactInfoTableController();

//Getting passed data
$contactNum = isset($_POST["contactNum"]) ? $_POST["contactNum"] : "";
$result = $controller->insertContact($contactNum);
if ($result)
    redirect_to("Contacts.php?flag=1");
else
    redirect_to("AddContact.php?flag=2");
?>