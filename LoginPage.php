<?php
session_start();
$flag = -1;
if (isset($_GET['flag']))
    $flag = $_GET['flag'];

require_once('ContactInfoTableController.php');

$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$contacts = $contactInfoController->getAllContacts();
?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="logo.jpg"/>
    <title>Login</title>

    <!--Applying an external stylesheet-->
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


<div id="body">

    <?php include("Header.php") ?>
    <div id="LoginSpan">
        <span>Sign in to continue to CoworkingSpace</span>
    </div>

    <div id="LoginForm">
        <!--Creating A Form-->
        <!--The action attribute defines the action to be performed when the form is submitted.
        Normally, the form data is sent to a web page on the server when the user clicks on the submit button.
        In the example above, the form data is sent to a page on the server called "/action_page.php". This page contains a server-side script that handles the form data-->
        <form id="_LoginForm" name="LoginForm" action="LoginController.php" method="post">

            <div id="user_icon">
                <i class="fa fa-user"></i>
            </div>
            <br>

            <input type="email" name="Email" value="Email" id="emailLogin" autocomplete="off" required>

            <input type="password" name="Password" value="Password" id="passwordLogin" autocomplete="off" required>

            <br><br>
            <!--<input type="submit"> defines a button for submitting form data to a form-handler.
            The form-handler is typically a server page with a script for processing input data.-->
            <input type="submit" name="submit" value="Log in">
            <br><br>

            <!--
            <input type="checkbox" name="remember_email" id="remember_email"  class="login-form-checkbox float-left">
            <label class="login-form-label float-left text-light" for="remember_email">Remember email</label><br><br>-->

            <p>Don't have an account ?<a href="SignUp.php">Click Here</a></p>
        </form>
    </div>

</div>

<?php include("Footer.php") ?>


<!--Applying an external javascript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="js/LoginScript.js"></script>

<script>
    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar === "42") {
        swal("Wrong Password", "Please re-enter your password", "error");
    } else if (javaScriptVar === "41") {
        swal("Invalid Email", "Please enter valid email", "error");
    } else if (javaScriptVar === "1") {
        swal("Wrong Email format ", "Please reenter your email", "error");
    } else if (javaScriptVar === "2") {
        swal("Wrong Password format ", "Your Password Must Contain At Least 8 Characters! Contain At Least 1 Number, 1 Capital Letter,and 1 Lowercase Letter!", "error");
    }
</script>
</body>
</html>