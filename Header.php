<!--logo of the co-working space-->
<!--Main Menu Navigation Tabs-->
<div id="MenuTab">
    <nav id="MainMenuNavigation" class="nav nav-tabs-justified">
        <div class="cl-effect-14">
            <div class="row" style="display: inline-flex;margin-top: 7%;">
                <div class="col-1"><img id="Logo" src="logo.jpg" alt="Logo" style="width: 50%;height: auto;"></div>
                <div class="col-1"><a href="Homepage.php" title="Homepage" role="button">Homepage</a></div>
                <div class="col-1"><a href="Reservation.php" title="" role="button">Book A Room</a>
                </div>
                <div class="col-1"><a href="ViewReservation.php" title="" role="button">My Reservations</a>
                </div>
                <div class="col-1"><a href="AboutUs.php" title="" role="button">About Us</a>
                </div>


                <div class="col-1">
                    <?php if (isset($_SESSION['name'])) { ?>
                        <div class="dropdown" style="position: relative;">
                            <a href="" title="" class="btn" role="button" data-toggle="dropdown"
                               id="menu" aria-haspopup="true"
                               aria-expanded="true">
                                <?php echo $_SESSION['name']; ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="menu">
                                <li><a href="EditProfile.php" title="">Edit Profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="LogOut.php" title="" id="logout">Logout</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a href="LoginPage.php" title="" role="button">Login</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
</div>