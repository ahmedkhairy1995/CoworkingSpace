<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php
session_start();
require_once('UsersTableController.php');
require_once('ValidationController.php');
require_once('User.php');
?>
<?php
$userController = UsersTableController::getUsersTableController();
$validationController = ValidationController::getValidationController();

if (isset($_SESSION['views'])) {
    if (isset($_POST["SaveProfile"])) {
        $FirstName = isset($_POST["FirstName"]) ? $_POST["FirstName"] : "";
        $LastName = isset($_POST["LastName"]) ? $_POST["LastName"] : "";
        $Email = isset($_POST["Email"]) ? $_POST["Email"] : "";
        $NewPassword = isset($_POST["NewPassword"]) ? $_POST["NewPassword"] : "";
        $ConfirmNewPassword = isset($_POST["ConfirmNewPassword"]) ? $_POST["ConfirmNewPassword"] : "";
        $CurrentPassword = isset($_POST["Password"]) ? $_POST["Password"] : "";
        $MobileNumber = isset($_POST["MobileNumber"]) ? $_POST["MobileNumber"] : "";
        $Address = isset($_POST["Address"]) ? $_POST["Address"] : "";


        if (!$validationController->validateEmail($Email)){
            redirect_to("EditProfile.php?flag=3");
        }
        else if (!$validationController->validateMobile($MobileNumber)){
            redirect_to("EditProfile.php?flag=4");
        }
        else if (!$validationController->validateName($FirstName) || !$validationController->validateName($LastName)){
            redirect_to("EditProfile.php?flag=5");
        }
        else if (!$validationController->validatePassword($NewPassword) || !$validationController->validatePassword($ConfirmNewPassword) || !$validationController->validatePassword($CurrentPassword)){
            redirect_to("EditProfile.php?flag=6");
        }
        else if (!$validationController->validateAddress($Address)){
            redirect_to("EditProfile.php?flag=7");
        }
        else{
            $email = $_SESSION['views'];
            $user = $userController->getUserByEmail($email);
            $actualPassword = $user->getPassword();

            if ($actualPassword != md5($CurrentPassword))
                redirect_to("EditProfile.php?flag=2");
            else {
                if ($NewPassword == "" && $ConfirmNewPassword == "") {
                    $result = $userController->updateUser($email, $FirstName, $LastName, $user->getPassword(), $Email, $MobileNumber, $Address);
                    if ($result) {
                        $_SESSION['name'] = $FirstName;
                        redirect_to("HomePage.php");
                    } else
                        echo mysqli_connect_errno();
                } else if ($NewPassword != "" && $NewPassword != $ConfirmNewPassword) {
                    redirect_to("EditProfile.php?flag=1");
                } else {
                    $result = $userController->updateUser($email, $FirstName, $LastName, md5($NewPassword), $Email, $MobileNumber, $Address);

                    if ($result) {
                        $_SESSION['name'] = $FirstName;
                        redirect_to("HomePage.php");
                    } else
                        echo mysqli_connect_errno();
                }
            }
        }

    }
} else
    redirect_to("LoginPage.php");
?>
  