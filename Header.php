<!--logo of the co-working space-->
<img id="Logo" src="logo.jpg" alt="Logo" style="width: 5%;height: auto;">
<!--Main Menu Navigation Tabs-->
<div id="MenuTab">
    <nav id="MainMenuNavigation" class="nav nav-tabs-justified">
        <div class="cl-effect-14">
            <a href="Homepage.php" title="Homepage" role="button">Homepage</a>
            <a href="Reservation.php" title="" role="button">Book A Room</a>
            <a href="ViewReservation.php" title="" role="button">My Reservations</a>
            <a href="AboutUs.php" title="" role="button">About Us</a>
            <?php if(isset($_SESSION['name'])){ ?>
            <div class="dropdown">
                <a href="" title="" class="btn" role="button" data-toggle="dropdown" id="menu" aria-haspopup="true"
                   aria-expanded="true">
                    <?php  echo $_SESSION['name']; ?>
                    <span class="caret"/>
                </a>
                <ul class="dropdown-menu" aria-labelledby="menu">
                    <li><a href="EditProfile.php" title="">Edit Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="LogOut.php" title="" id="logout">Logout</a></li>
                </ul>
            </div>
            <?php }else{?>
                <a href="LoginPage.php.php" title="" role="button">Login</a>
            <?php }?>
        </div>
    </nav>
</div>
