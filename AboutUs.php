<?php 
    session_start();
    if(isset($_GET['flag']))
    $flag=$_GET['flag'];
    include('Db.php');
?>

<?php
            
        $db=new Db();
        $ImageArray=array();
        $result=$db->select("Select name from images");
        $i=0;
        while($i<count($result))
        {
            $Temp=explode('\\',$result[$i]['name']);
            $ImageArray[$i]=end($Temp);
            $i++;    
        }
 $contactInfoArray=$db->selectContactInfo();
        ?>
<!Doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<!-- IE Edge Meta Tag -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Viewport -->
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<meta name="description" content="Ebda3 Co-Working space.One of the leading coworking spaces in Egypt"/>
	<title>About Us</title>
	<!-- Minified CSS -->
	<link rel="stylesheet" href="font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="bootstrap.css">

	<!--Applying an external stylesheet-->
	<link rel="stylesheet" type="text/css" href="style1.css">
	<link rel="stylesheet" href="component.css">
	<link rel="stylesheet" type="text/css" href="style2.css">
    
     <script src="sweetalert/dist/sweetalert.min.js"></script>
     <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">

</head>

<body>
	
	<!--logo of the co-working space-->
	<img id="Logo" src="logo.jpg" alt="Logo">
	<!--Main Menu Navigation Tabs-->
		<div id="MenuTab">
		<nav id="MainMenuNavigation" class="nav nav-tabs-justified">
			<div class="cl-effect-14">
				<a href="Homepage.php" title="Homepage" role="button">Homepage</a>
				<a href="Reservation.php" title=""  role="button">Book A Room</a>
				<a href="ViewReservation.php" title="" role="button">My Reservations</a>
				<a href="AboutUs.php" title="" role="button">About Us</a>
				<?php
				if(!isset($_SESSION['views']))
				{
				?>
				<a href="LoginPage.php" title="" role="button">Login</a>
				<?php
				}
				else
				{
				?>&nbsp;&nbsp;&nbsp;
				<div class="dropdown">
					<a href="" title="" class="btn" role="button" data-toggle="dropdown" id="menu" aria-haspopup="true" aria-expanded="true">
						<?php echo $_SESSION['name']?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="menu">
						<li><a href="EditProfile.php" title="">Edit Profile</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="LogOut.php" title="" id="logout">Logout</a></li>
					</ul>
				</div>
			</div>
			<?php
			}
			?>
		</nav>
			</div>
    
    
    <form>
    <fieldset>
    <div id="AboutUsDiv"> 
      <legend>About Us</legend>
        <div id="AboutUs">
        <h1>Story</h1>
        <h3>Ebda3 is a training center established by group of students that have the passion of building and benefiting their community, through providing the students with needed courses for their field with affordable prices. Our contribution to the society is through developing the capability, way of thinking and skills needed to perform effectively.</h3>
        
        <h1>Mission</h1>
        <h3>"EBDA3" is our mission.
        We simply aim to develop the way of thinking, working and performing of any task.
        How is this achieved?
        By providing our applicants with courses tutored by professional certified
        instructors. Some of the courses include workshops which assure the development. Plus, we also have a fully equipped computer laboratory with the latest technology, where applicants can learn and practice their new skills.
        Our goal is simple, yet extremely efficient.</h3>
        </div>
        
        <div id="slideshow">
		<img src="" id="Pic" alt="Ebda3 Pictures" class="img-responsive center-block">
        </div>
    </div>
    </fieldset>
    </form>
    
	<footer class="footer-distributed col-xs-2 col-sm-6 col-md-8 col-lg-12">

		<div class="footer-left">
			<h3><span>Ebda3</span></h3>
			<p class="footer-company-name">Ebdaa &copy; 2017</p>
			<br><br>
			<p class="footer-company-rights">All rights reserved &trade;</p>
		</div>


		<div class="footer-center">
			<div>
				<i class="fa fa-map-marker"></i>
				<p><span>28 Gaber Ibn Haian Street</span> Ad Dokki, Al Jizah, Egypt</p>
			</div>
			<div>
				<i class="fa fa-phone"></i>
				<p>+20 <?php echo $contactInfoArray[0]['contactNum']; ?> </p><br>
				<i class="fa fa-phone"></i>
				<p>+20 <?php echo $contactInfoArray[1]['contactNum']; ?></p>
			</div>
		</div>


		<div class="footer-right">
			<p class="footer-company-about">
				<span>About us</span>
				We're an organization that works on developing the ability and skills needed to perform the optimum way, releasing one's maximum creativity.
			</p>

			<div class="footer-icons">
				<a href="https://www.facebook.com/Ebda3.Spaces/" target="_blank"><i class="fa fa-facebook"></i></a>
			</div>
		</div>
	</footer>
    
 <script>
        var Image = document.getElementById("Pic");
        var ImageArray =<?php echo json_encode($ImageArray); ?>;
        var ImageIndex = 0; 
         window.onload=function()
        {   

            Image.setAttribute("src", ImageArray[ImageIndex]);
         };

        var Image = document.getElementById("Pic");
    //Implementing a slideshow

        var ImageArray =<?php echo json_encode($ImageArray); ?>;
        var ImageIndex = 0;
        function SlideShow() {
            Image.setAttribute("src", ImageArray[ImageIndex]);
            ImageIndex++;
            if (ImageIndex >= ImageArray.length) {
                ImageIndex = 0;
            }
        }
        var IntervalHandler = setInterval(SlideShow, 3000);   

</script>

<script>
    swal({
  title: "Good Evening!",
  text: "Ebda3's website, where you can get 10 LE discount 10 times",
  imageUrl: "logo.jpg",
  timer: 10000
});
    </script>
	<!--Applying an external javascript-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script><!--applying jQuery library-->
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>src="bootstrap.js"</script>
	<script>src="jquery-3.2.0.js"</script>
	<script src="myScript.js"></script>
    <script>

        var javaScriptVar = "<?php echo $flag; ?>";
        if(javaScriptVar == "1" )
            {
                swal("Congrats", "You signed up", "success");
            }
    </script>
        
   
</body>
</html>