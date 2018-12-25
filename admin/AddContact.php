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
$flag = -1;
if (isset($_GET['flag']))
    $flag = $_GET['flag']; ?>

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
            <form class="login100-form validate-form" method="post" name="AddContactForm"
                  onsubmit="return validateForm()" action="AddContactController.php">
					<span class="login100-form-title p-b-49">
						Add Contact Info
					</span>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Contact Number</span>
                    <input class="input100" type="text" name="contactNum"
                           value="" placeholder="Please enter contact number">
                </div>
                <br/>

                <div class="text-right p-t-8 p-b-31">

                </div>

                <div class="container-login100-form-btn">
                    <input type="submit" name="submit" class="btn btn-market btn-large btn--with-shadow" value="Add"
                           style="width: 100%;text-align: center;">
                </div>
        </div>

        </form>
    </div>
</div>
</div>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    let mobilePattern = /^[0-9]{11}$/;
    const mobileNumberElement = document.forms["AddContactForm"]["contactNum"];
    mobileNumberElement.oninput = function (e) {
        e.target.setCustomValidity("");
    };

    function validateForm() {
        if (!mobilePattern.test(mobileNumberElement.value.toString().trim())) {
            mobileNumberElement.setCustomValidity("Enter a valid mobile number");
            return false;
        }
    }

    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "1") {
        swal("Wrong Mobile Format", "Please reenter the number ", "error");
    } else if (javaScriptVar === "2") {
        swal("Database Error", "Please try again", "error");
    }

</script>
</body>
</html>
