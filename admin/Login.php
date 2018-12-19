<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

?>
<?php
session_start();
if (isset($_GET['flag']))
    $flag = $_GET['flag'];
if (isset($_SESSION['admin'])) {
    redirect_to("Overview.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/images/icons/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="../sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/dist/sweetalert.css">
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="post" action="LoginController.php">
					<span class="login100-form-title p-b-49">
						Welcome	Admin!
					</span>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="username" placeholder="Type your username">
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Type your password">
                </div>

                <div class="text-right p-t-8 p-b-31">

                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Login
                        </button>
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
    if (javaScriptVar == 1) {
        swal("Wrong Username or Password", "Please re-enter them", "error");
    }
</script>

</body>
</html>