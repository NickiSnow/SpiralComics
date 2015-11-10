<?php
require_once('login.php'); // Includes User Login Script
require_once('register.php');// Includes User Registration Script
require_once('includes/db_connection.php');// Includes Database Connection Script
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
      	<!-- Basic Page Needs
  	================================================== -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">    
	<title>Spiral Comics Home Page</title>
	<meta name="description" content="Spiral Comics is an online comic book sales site that specializes in Star Wars comics and recent hot comics.">
	<meta name="author" content="Nicole Snow">
		<!-- Mobile Specific Metas
  	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<!-- CSS / Bootstrap
  	================================================== --> 
  <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet" />
    <!-- Favicon
    ================================================== --> 
    <!-- for FF, Chrome, Opera -->
  <link rel="icon" type="image/png" href="images/favicon-16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="images/favicon.png" sizes="32x32">
    <!-- for IE -->
  <link rel="icon" type="image/x-icon" href="images/favicon.ico" >
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
		<!-- Fixes
  	================================================== -->  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!--[if lt IE 8]>
	<style>
		legend {
			display: block;
			padding: 0;
			padding-top: 30px;
			font-weight: bold;
			font-size: 1.25em;
			color: #FFD98D;
			margin: 0 auto;
		}
	</style>
<![endif]--> 
</head>
<body>
<?php require_once("login.php");?>
<pre>
<?php
  print_r($_SESSION);
?>
</pre>
<!-- Begin Content Container -->
  <div class="container">
    <header>
      <div class="row">
        <div class="col-xs-7">
          <img class="img-responsive" src="images/Spiral-Comics-logo.gif" alt="Spiral Comics Logo" />
        </div>
        <div class="col-xs-5">
          <div class="pull-right right">
            <?php 
              if(isset($_SESSION['cart'])){
                echo '<a href="cart.html">View Cart <span class="red glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> ('.sizeof($_SESSION['cart']).')&nbsp;&nbsp|';
              }
            ?></a>
            <?php
              if(isset($_SESSION['username'])){
                  echo 'Hi, '.$_SESSION['username'].'!';
                  echo '&nbsp;&nbsp;&nbsp;<a href="logout.php">Logout</a>';
              }else{
                echo '<a href="" data-toggle="modal" data-target="#loginModal">Log In</a> | <a href="" data-toggle="modal" data-target="#signupModal">Sign Up</a>';
            }?>
          </div>
        </div>
      </div>
      <nav id="custom-menu" class="navbar navbar-default " role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a>
                </li>
                <li><a href="shop.html">Shop Spiral Comics</a>
                </li>
                <li><a href="browse.html">Browse Titles</a>
                </li>
                <li><a href="about.html">About Us</a>
                </li>
            </ul>
              <form class="navbar-form navbar-right search" role="search">
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search. . ." name="search">
                  <div class="input-group-btn">
                      <button class="btn btn-default searchBtn" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                  </div>
              </div>
              </form>
        </div>
      </nav>
    </header>
    <div class="row">
      <h1>Welcome to Spiral Comics</h1>
      <div class="col-md-8 col-md-offset-2 text-center">
        <p>We specialize in Star Wars comics as well as other recent, hot comics. New comics (from the past six months) are added monthly and back issues are added as they are acquired and processed.
        </p>
        <p>Can't find it at your local comic shop? Try us! We have premium graded comics as well as $1 DEALS. Browse around and let us know if there’s something we can track down for you.
        </p>
      </div>
    </div><!-- End Row 1 -->
    <div class="row">
      <div class="col-md-7 blue-box">
        <a href="shop.html?filter=new"><h2>Newly added comics</h2></a>
        <div class="row box-content">
          <div class="col-sm-4">
            <a href="" data-toggle="modal" data-target="#comicModal"><img class="img-responsive" src="images/darth_vader_2015_04.jpg" alt="comic cover"></a>
            <p>DARTH VADER (2015) #4<br/>MARVEL<br/>NM/Unread<br/>Price: $3.99</p>
          </div>
          <div class="col-sm-4">
            <a href="" data-toggle="modal" data-target="#comicModal"><img class="img-responsive" src="images/star_wars_2015_03.jpg" alt="comic cover"></a>
            <p>STAR WARS (2015) #3<br/>MARVEL<br/>NM/Unread<br/>Price: $4.99</p>
          </div>
          <div class="col-sm-4">
            <a href="" data-toggle="modal" data-target="#comicModal"><img class="img-responsive" src="images/x-men_2013_25.jpg" alt="comic cover"></a>
            <p>X-MEN (2013) #25<br/>MARVEL<br/>NM/Unread<br/>Price: $3.49</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-1 blue-box">
        <a href="shop.html?filter=cgc"><h2>CGC Graded Comics</h2></a>
          <div class="row box-content">
            <div class="col-md-7 col-sm-4 col-xs-8">
              <a href="" data-toggle="modal" data-target="#comicModal">
<?php
  $query  = 'SELECT * from tbl_inventory ';
  $query .= 'WHERE type_id=3 ';
  $query .= 'LIMIT 1';
  $cgc_result = mysqli_query($connection, $query);
  $cgc_result = mysqli_fetch_array($cgc_result);
?>
              <?php
              echo '<img class="img-responsive" src="images/comics/'.$cgc_result['picture_500'].'" alt="CGC Comic cover"></a>';
              
              ?>

              <p>GUARDIANS OF THE GALAXY #1<br/>MARVEL<br/>CGC 9.8<br/>Price: $74.99</p>
              
            </div>
            <div class="col-md-5 col-sm-5 col-xs-4">
              <img class="img-responsive middle" src="images/cgc.jpeg" alt="CGC Logo">
            </div>
          </div>
      </div>
    </div><!-- End Row 2 -->
    <div class="row">
      <div class="col-md-7 blue-box">
        <a href="title.html?title=sw1977"><h2>Featured Title: Star Wars (1977)</h2>
        <div class="row box-content">
          <div class="col-sm-4">
            <a href="" data-toggle="modal" data-target="#comicModal"><img class="img-responsive" src="images/star_wars_3.jpg" alt="comic cover"></a>
            <p>STAR WARS (1977) #3<br/>MARVEL<br/>VF+<br/>Price: $19.99</p>
          </div>
          <div class="col-sm-4">
            <a href="" data-toggle="modal" data-target="#comicModal"><img class="img-responsive" src="images/star_wars_4.jpg" alt="comic cover"></a>
            <p>STAR WARS (1977) #4<br/>MARVEL<br/>VF<br/>Price: $17.99</p>
          </div>
          <div class="col-sm-4">
            <a href="" data-toggle="modal" data-target="#comicModal"><img class="img-responsive" src="images/star_wars_5.jpg" alt="comic cover"></a>
            <p>STAR WARS (1977) #5<br/>MARVEL<br/>NM<br/>Price: $21.99</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-1 blue-box">
        <a href="shop.html?filter=dollar"><h2>Dollar Deals</h2>
          <div class="row box-content">
            <div class="col-md-7 col-sm-4 col-xs-8">
              <a href="" data-toggle="modal" data-target="#comicModal"><img class="img-responsive" src="images/my_little_pony_halloween_comicfest_2013.jpg" alt="Dollar Deal Comic Cover"></a>
              <p>MY LITTLE PONY: HALLOWEEN EDITION, COMICFEST<br/>IDW<br/>NM/Unread<br/>Price: $1.00</p>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-4">
              <img class="img-responsive middle" src="images/dollar_deal.gif" alt="CGC Logo">
            </div>
          </div>
      </div>
    </div> <!-- End Row 3 -->
    <div class="row blue-box">
      <h2>Comic Book News</h2>
      <div class="col-md-4">
        <div class="red-box">
          <h3>Marvel Comics News</h3>
          <div id="marvel"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="red-box">
          <h3>DC Comics News</h3>
          <div id="dc"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="red-box">
          <h3>Comic Book Movie/TV News</h3>
          <div id="movie"></div>
        </div>
      </div>
    </div><!-- End Row 4 -->
    <!-- loginModal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">  
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            <img class="img-responsive center-block" src="images/Spiral-Comics-logo.gif" alt="Spiral Comics Logo" />
            <form id="loginForm" action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>         
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
              <button type="submit" name="submit_login" class="pull-right">Log In</button>
              <span><?php echo form_errors($errors); ?></span>
            </form>
          </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- signupModal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">  
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            <img class="img-responsive center-block" src="images/Spiral-Comics-logo.gif" alt="Spiral Comics Logo" />
            <form id="signupForm" action="" method="POST">
              <div class="form-group">
                <label for="fName">Name</label>
                <input type="text" class="form-control" id="fName" name="fName" required>
                <input type="text" class="form-control" id="lName" name="lName" required>
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div> 
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>         
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <input type="checkbox" checked id="newsletter" name="newsletter" />
              <label for="newsletter"><span></span>I would like to receive the monthly eNewsletter</label>
              <input type="checkbox" checked id="agree" name="agree" required />
              <label for="agree"><span></span>I Agree to the <a href="terms.html">Terms &amp; Conditions</a></label><br/>
              <button type="submit" name="submit_register" class="pull-right">Submit</button>
            </form>
          </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- comicModal -->
    <div class="modal modal-wide fade" id="comicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h1 class="modal-title" id="title">ALL NEW X-MEN #40</h1>
            </div><!-- /.modal-header -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-5 col-sm-6">
                  <div class="pull-left"><img class="img-responsive" id="modalImage" src="images/all_new_xmen_40.jpg"></div>
                </div>
                <div class="col-md-7 col-sm-6">
                  <h3>Creators</h3>
                  <p id="creators">Written by Brian Michael Bendis. Art by Mahmud Asrar.</p>
                  <h3>Description</h3>
                  <p id="description">Who are the Utopians? And what secret do they hold that pertains to the future of mutantkind? The All-New X-Men may regret finding out!</p>
                  <h3>Condition</h3>
                  <p id="condition">NM/Unread</p>
                  <h3>Price $3.99</h3>
                  <button class="pull-right">Add To Cart</button>
                </div>
              </div>
            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <footer class="row">
      <p class="col-md-4">This Website &copy; 2015 SpiralComics.<br/>All characters are copyrighted by their respective publishers.</p>
      <p class="col-md-2"><span class="bold">Site Links</span><br/>
        <a href="index.html">Home</a><br/>
        <a href="shop.html">Shop</a><br/>
        <a href="browse.html">Browse by Title</a><br/>
        <a href="about.html">About Us</a><br/>
        <a href="shipping.html">Shipping</a></p>
      <p class="col-md-2"><span class="bold">Shopping Catogories</span><br/>
        <a href="shop.html?new">Newly Added</a><br/>
        <a href="shop.html?cgc">CGC<br/>Featured Title</a><br/>
        <a href="shop.html?dollar">Dollar Deals</a></p>
      <p class="col-md-2"><span class="bold">The Fine Print</span><br/>
        <a href="terms.html">Terms &amp; Conditions</a><br/>
        <a href="terms.html?privacy">Privacy Policy</a></p>
      <p class="col-md-2"><span class="bold">Contact Us</span><br/>P.O. Box 1245<br/>Spokane, WA 99205<br/><br/>info@spiralcomics.com</p>      
    </footer>
  </div> <!-- End Container -->
  <!-- Javascript
    ================================================== --> 
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.zrssfeed.min.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>
</body>
</html>