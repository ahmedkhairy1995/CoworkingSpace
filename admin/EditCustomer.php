<?php
/**
 * Created by PhpStorm.
 * User: May
 * Date: 12/19/2018
 * Time: 7:14 PM
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
$userController = UsersTableController::getUsersTableController();
$userId = $_GET['id'];
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
$user = $userController->getUserByID($userId);
if (!isset($user))
    redirect_to("Overview.php?flag=0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Tool</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <script src="../sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/blocks.css">
    <link rel="stylesheet" href="css/header-user-dropdown.css">
</head>
<body>
<?php include("AdminHeader.php") ?>

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="post" action="EditCustomerController.php">
					<span class="login100-form-title p-b-49">
						Edit Customer
					</span>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Customer Id</span>
                    <input class="input100" type="text" name="customerId"
                           value="<?php echo $user->getId() ?>" readonly>
                </div>
                <br/>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">First Name</span>
                    <input class="input100" type="text" name="firstName"
                           value="<?php echo $user->getFirstName() ?>">
                </div>
                <br/>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Last Name</span>
                    <input class="input100" type="text" name="lastName"
                           value="<?php echo $user->getLastName() ?>">
                </div>
                <br/>


                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" name="email"
                           value="<?php echo $user->getEmail() ?>">
                </div>
                <br/>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Mobile Number</span>
                    <input class="input100" type="text" name="mobileNumber"
                           value="<?php echo $user->getMobileNumber() ?>">
                </div>
                <br/>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Address</span>
                    <input class="input100" type="text" name="address"
                           value="<?php echo $user->getAddress() ?>">
                </div>
                <br/>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Blocked</span>
                    <select name="blocked">
                        <option value="<?php echo 1 ?>"<?php if ($user->getBlocked() == 1) {
                            echo "selected";
                        } ?>>
                            <?php echo "Yes"; ?>
                        </option>
                        <option value="<?php echo 0 ?>"<?php if ($user->getBlocked() == 0) {
                            echo "selected";
                        } ?>>
                            <?php echo "No"; ?>
                        </option>
                    </select>

                </div>
                <br/>

                <div class="text-right p-t-8 p-b-31">

                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <input type="submit" name="submit" class="btn btn-market btn-large btn--with-shadow"
                               value="EDIT" style="width: 100%;text-align: center;">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>

    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "3")
        swal("Wrong Email format ", "Please reenter your email", "error");
    else if (javaScriptVar === "1")
        swal("Wrong Mobile format ", "Please reenter your mobile number", "error");
    else if (javaScriptVar === "2")
        swal("Wrong Name format ", "Please reenter your name", "error");
    else if (javaScriptVar === "4")
        swal("Wrong Address format ", "Please reenter your address", "error");
   else if (javaScriptVar === "5")
        swal("Database error ", "Please try again", "error");

</script>

</body>
</html>
