<?php
function redirect_to($newlocation)
{
    header("Location:" . $newlocation);
    exit;
}

session_start();
if (!isset($_SESSION['admin'])) {
    redirect_to("Login.php");
}
?>

<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Co-working Space</title>

    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header-user-dropdown.css">

    <script src="../sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/dist/sweetalert.css">

</head>

<body>


<div style="position: relative;">
    <!-- Header Replace it with a header -->
    <?php include("header-user-dropdown.php") ?>
    <br/>
    <h2 style="text-align: center">Overview</h2>

    <div class="content">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget">
                            <div class="stat-icon flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-text">$<span class="count">23569</span></div>
                                <div class="stat-heading">Revenue</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget">
                            <div class="stat-icon flat-color-2">
                                <i class="pe-7s-ticket"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-text"><span class="count">3435</span></div>
                                <div class="stat-heading">Reservations</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget">
                            <div class="stat-icon flat-color-3">
                                <i class="pe-7s-home"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-text"><span class="count">349</span></div>
                                <div class="stat-heading">Rooms</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget">
                            <div class="stat-icon flat-color-4">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-text"><span class="count">2986</span></div>
                                <div class="stat-heading">Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    javaScriptVar = "<?php echo $flag; ?>";
    if (javaScriptVar == 0) {
        swal("Wrong ID", "Please check the id", "error");
    }
</script>

</body>
</html>