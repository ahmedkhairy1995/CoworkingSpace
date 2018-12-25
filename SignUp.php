<?php
session_start();
$flag = -1;
if (isset($_GET['flag']))
    $flag = $_GET['flag'];

include('ContactInfoTableController.php');
$contactInfoController = ContactInfoTableController::getContactInfoTableController();
$contacts = $contactInfoController->getAllContacts();
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="logo.jpg"/>
    <title>Sign Up</title>

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

    <div id="SignUpSpan">
        <span>Create your Account</span>
    </div>

    <aside class="signUpAside">
        <h3>One account is all you need &nbsp;<i class="fa fa-thumbs-up"></i></h3>
    </aside>

    <div id="SignUpForm">
        <!--Creating A Form-->
        <!--The action attribute defines the action to be performed when the form is submitted.
        Normally, the form data is sent to a web page on the server when the user clicks on the submit button.
        In the example above, the form data is sent to a page on the server called "/action_page.php". This page contains a server-side script that handles the form data-->

        <form id="_SignUpForm" name="SignUpForm" action="SignupController.php" onsubmit="return validateForm()"
              method="post">

            <p><strong>Name</strong></p>
            <!--type attribute can have values such as text,radio,submit,checkbox-->
            <input type="text" name="FirstName" placeholder="First" id="firstName"
                   value="<?php if (isset($_SESSION['FirstName'])) echo $_SESSION['FirstName']; ?>" required>

            <input type="text" name="LastName" placeholder="Last" id="lastName"
                   value="<?php if (isset($_SESSION['LastName'])) echo $_SESSION['LastName']; ?>" required><br>

            <p><strong>Email</strong>
            <p>
                <input type="email" name="Email"
                       value="<?php if (isset($_SESSION['Email'])) echo $_SESSION['Email']; ?>" required>
            <p><strong>Confirm email</strong></p>
            <input type="email" name="EmailConfirmation" required>

            <p><strong>Create a password</strong></p>
            <input type="password" name="Password" minlength="8" value="" required>
            <p><strong>Confirm your password</strong></p>
            <input type="password" name="PasswordConfirmation" minlength="8" value="" required><br>

            <p><strong>Birthday</strong><i style="color:dimgrey;">&nbsp &nbsp (yyyy-mm-dd)</i></p>
            <input type="date" name="bday" min="1960-01-02"
                   value="<?php if (isset($_SESSION['bday'])) echo $_SESSION['bday']; ?>"><br><br>

            <div class="form-group">

                <!--<p><strong>Gender</strong></p>-->
                <label class="radio-inline">
                    <input type="radio" class="Radio" name="gender" value="M" <?php if (isset($_SESSION['gender'])) {
                        if ($_SESSION['gender'] == 'M') echo "checked";
                    } ?> required><!--We can add checked attribute if we want it to be checked as a default-->
                    Male
                </label>

                <label class="radio-inline">
                    <input type="radio" class="Radio" name="gender" value="F" <?php if (isset($_SESSION['gender'])) {
                        if ($_SESSION['gender'] == 'F') echo "checked";
                    } ?> required>
                    Female
                </label>
            </div>

            <p><strong>Mobile Phone</strong></p>
            <input type="tel" name="MobileNumber" placeholder="+20"
                   value="<?php if (isset($_SESSION['MobileNumber'])) echo $_SESSION['MobileNumber']; ?>" required><br>

            <p><strong>Current address</strong></p>
            <input type="text" name="Address"
                   value="<?php if (isset($_SESSION['Address'])) echo $_SESSION['Address']; ?>" required><br>

            <p><strong>ID number</strong></p>
            <input type="text" ID="IDNumber" name="IDNumber2"
                   value="<?php if (isset($_SESSION['IDNumber2'])) echo $_SESSION['IDNumber2']; ?>" minlength="14"
                   maxlength="14" required>

            <br><br>
            <!--<input type="submit"> defines a button for submitting form data to a form-handler.
            The form-handler is typically a server page with a script for processing input data.-->
            <input type="submit" name="submit" value="Submit" class="btn btn-success pull-left">
        </form>
    </div>
    <?php session_destroy(); ?>

    <?php include("Footer.php") ?>

    <!--Applying an external javascript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/SignUpScript.js"></script>

    <script>
        javaScriptVar = "<?php echo $flag; ?>";
        if (javaScriptVar === "1") {
            swal("Error", "This is a wrong ID!", "error");
        } else if (javaScriptVar === "2") {
            swal("Error", "Confirm your email", "error");
        } else if (javaScriptVar === "3") {
            swal("Error", "Check your password", "error");
        } else if (javaScriptVar === "4") {
            swal("Error", "You are already signed up", "error");
        } else if (javaScriptVar === "5") {
            swal("Error", "<?php  if (isset($_SESSION['DB-Error'])) echo $_SESSION['DB-Error'];?>", "error");
        } else if (javaScriptVar === "8")
            swal("Wrong Email format ", "Please reenter your email", "error");
        else if (javaScriptVar === "9")
            swal("Wrong Mobile format ", "Please reenter your mobile number", "error");
        else if (javaScriptVar === "10")
            swal("Wrong Name format ", "Please reenter your name", "error");
        else if (javaScriptVar === "6")
            swal("Wrong Password format ", "Your Password Must Contain At Least 8 Characters! Contain At Least 1 Number, 1 Capital Letter,and 1 Lowercase Letter!", "error");
        else if (javaScriptVar === "7")
            swal("Wrong Address format ", "Please reenter your address", "error");

        let namePattern = /^[a-zA-Z][a-zA-Z ]*$/;
        let passwordPattern1 = /[0-9]+/;
        let passwordPattern2 = /[a-z]+/;
        let passwordPattern3 = /[A-Z]+/;
        let addressPattern = /^\d+ [a-zA-Z .,]+$/;
        let mobilePattern = /^[0-9]{11}$/;
        const firstNameElement = document.forms["SignUpForm"]["FirstName"];
        const lastNameElement = document.forms["SignUpForm"]["LastName"];
        const passwordElement = document.forms["SignUpForm"]["Password"];
        const passwordConfirmationElement = document.forms["SignUpForm"]["PasswordConfirmation"];
        const addressElement = document.forms["SignUpForm"]["Address"];
        const mobileNumberElement = document.forms["SignUpForm"]["MobileNumber"];
        const emailElement = document.forms["SignUpForm"]["Email"];
        const confirmEmailElement = document.forms["SignUpForm"]["EmailConfirmation"];

        firstNameElement.oninput = function (e) {
            e.target.setCustomValidity("");
        };
        lastNameElement.oninput = function (e) {
            e.target.setCustomValidity("");
        };
        passwordElement.oninput = function (e) {
            e.target.setCustomValidity("");
        };
        passwordConfirmationElement.oninput = function (e) {
            e.target.setCustomValidity("");
        };
        addressElement.oninput = function (e) {
            e.target.setCustomValidity("");
        };
        mobileNumberElement.oninput = function (e) {
            e.target.setCustomValidity("");
        };
        confirmEmailElement.oninput = function (e) {
            e.target.setCustomValidity("");
        };

        function validateForm() {
            if (!namePattern.test(firstNameElement.value.toString().trim())) {
                firstNameElement.setCustomValidity("Enter a valid name");
                return false;
            } else if (!namePattern.test(lastNameElement.value.toString().trim())) {
                lastNameElement.setCustomValidity("Enter a valid name");
                return false;
            } else if (confirmEmailElement.value.toString().trim() !== emailElement.value.toString().trim()) {
                confirmEmailElement.setCustomValidity("Emails do not match");
                return false;
            } else if (!passwordPattern1.test(passwordElement.value.toString().trim())) {
                passwordElement.setCustomValidity("Password shall be alphanumeric with minimum length of 8 characters");
                return false;
            } else if (!passwordPattern2.test(passwordElement.value.toString().trim())) {
                passwordElement.setCustomValidity("Password shall be alphanumeric with minimum length of 8 characters");
                return false;
            } else if (!passwordPattern3.test(passwordElement.value.toString().trim())) {
                passwordElement.setCustomValidity("Password shall be alphanumeric with minimum length of 8 characters");
                return false;
            } else if (passwordElement.value.toString().trim().length < 8) {
                passwordElement.setCustomValidity("Password shall be alphanumeric with minimum length of 8 characters");
                return false;
            } else if (passwordConfirmationElement.value.toString().trim() !== passwordElement.value.toString().trim()) {
                passwordConfirmationElement.setCustomValidity("Passwords do not match");
                return false;
            } else if (!addressPattern.test(addressElement.value.toString().trim())) {
                addressElement.setCustomValidity("Enter a valid address");
                return false;
            } else if (!mobilePattern.test(mobileNumberElement.value.toString().trim())) {
                mobileNumberElement.setCustomValidity("Enter a valid mobile number");
                return false;
            }
        }

    </script>
</body>
</html>