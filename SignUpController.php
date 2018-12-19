<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php
session_start();
require_once('Database.php');
require_once('UsersTableController.php');
$usersController = UsersTableController::getUsersTableController();

//Getting passed data
$FirstName = isset($_POST["FirstName"]) ? $_POST["FirstName"] : "";
$LastName = isset($_POST["LastName"]) ? $_POST["LastName"] : "";
$Email = isset($_POST["Email"]) ? $_POST["Email"] : "";
$EmailConfirmation = isset($_POST["EmailConfirmation"]) ? $_POST["EmailConfirmation"] : "";
$Password = isset($_POST["Password"]) ? $_POST["Password"] : "";
$Password = md5($Password);
$PasswordConfirmation = isset($_POST["PasswordConfirmation"]) ? $_POST["PasswordConfirmation"] : "";
$PasswordConfirmation = md5($PasswordConfirmation);
$bday = isset($_POST["bday"]) ? $_POST["bday"] : "";
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
$MobileNumber = isset($_POST["MobileNumber"]) ? $_POST["MobileNumber"] : "";
$Address = isset($_POST["Address"]) ? $_POST["Address"] : "";
$IDNumber2 = isset($_POST["IDNumber2"]) ? $_POST["IDNumber2"] : "";

//Checking if ID contains Birth Date (Verification)
$bd = substr($IDNumber2, 1, 6);
$array = str_split($bd, 2); /* [16, 10, 01] */
$string = implode('-', $array); /* 16-10-01 */
$birth = substr($bday, 2, 8);

if ($string != $birth) {
    $_SESSION['bday'] = $bday;
    $_SESSION['FirstName'] = $FirstName;
    $_SESSION['LastName'] = $LastName;
    $_SESSION['Email'] = $Email;
    $_SESSION['gender'] = $gender;
    $_SESSION['MobileNumber'] = $MobileNumber;
    $_SESSION['Address'] = $Address;
    $_SESSION['IDNumber2'] = $IDNumber2;
    redirect_to("SignUp.php?flag=1");
} elseif ($Email != $EmailConfirmation) {
    $_SESSION['bday'] = $bday;
    $_SESSION['FirstName'] = $FirstName;
    $_SESSION['LastName'] = $LastName;
    $_SESSION['Email'] = $Email;
    $_SESSION['gender'] = $gender;
    $_SESSION['MobileNumber'] = $MobileNumber;
    $_SESSION['Address'] = $Address;
    $_SESSION['IDNumber2'] = $IDNumber2;
    redirect_to("SignUp.php?flag=2");
} elseif ($PasswordConfirmation != $Password) {
    $_SESSION['bday'] = $bday;
    $_SESSION['FirstName'] = $FirstName;
    $_SESSION['LastName'] = $LastName;
    $_SESSION['Email'] = $Email;
    $_SESSION['gender'] = $gender;
    $_SESSION['MobileNumber'] = $MobileNumber;
    $_SESSION['Address'] = $Address;
    $_SESSION['IDNumber2'] = $IDNumber2;
    redirect_to("SignUp.php?flag=3");
} else {
    $result = $usersController->insertNewUser($IDNumber2, $FirstName, $LastName, $Password, $Email, $bday, $gender, $MobileNumber, $Address);

    //Insert is successful
    if ($result)
        redirect_to("Homepage.php?flag=1");
    else {
        if ($usersController->getDB()->getErrorCode() === 0) //Primary Key error
        {
            $_SESSION['bday'] = $bday;
            $_SESSION['FirstName'] = $FirstName;
            $_SESSION['LastName'] = $LastName;
            $_SESSION['Email'] = $Email;
            $_SESSION['gender'] = $gender;
            $_SESSION['MobileNumber'] = $MobileNumber;
            $_SESSION['Address'] = $Address;
            $_SESSION['IDNumber2'] = $IDNumber2;
            redirect_to("SignUp.php?flag=4");
        } else {
            $_SESSION['DB-Error'] = $usersController->getDB()->getErrorMessage();
            redirect_to("SignUp.php?flag=5");
        }
    }
}
?>