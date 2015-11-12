<?php
require_once('login.php'); // Includes User Login Script
require_once('register.php');// Includes User Registration Script
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
    <title>Thanks! From Spiral Comics</title>
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
<!-- Begin Content Container -->
  <div class="container">
    <header>
      <div class="row">
        <div class="col-xs-7">
          <a href="index.php"><img class="img-responsive" src="images/Spiral-Comics-logo.gif" alt="Spiral Comics Logo" /></a>
        </div>
        <div class="col-xs-5">
          <div class="pull-right right">
            <?php 
              if(isset($_SESSION['cart'])){
                echo '<a href="cart.php">View Cart <span class="red glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> ('.sizeof($_SESSION['cart']).')&nbsp;&nbsp|';
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
              <li><a href="index.php">Home</a>
              </li>
              <li><a href="shop.php">Shop Spiral Comics</a>
              </li>
              <li><a href="browse.php">Browse Titles</a>
              </li>
              <li><a href="about.php">About Us</a>
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
    <div class="row grey-box">
      <h1>Thanks for Shopping SpiralComics.com</h1>
      <div class="col-lg-4 col-lg-offset-3 col-md-5 col-md-offset-2 col-sm-offset-1">
        <p>Your payment has been received.</p>
        <p>You will receive an email receipt shortly.</p>
      </div>
    </div><!--End Row 1-->    
    <footer class="row">
      <p class="col-md-4">This Website &copy; 2015 SpiralComics.<br/>All characters are copyrighted by their respective publishers.</p>
      <p class="col-md-2"><span class="bold">Site Links</span><br/>
        <a href="index.php">Home</a><br/>
        <a href="shop.php">Shop</a><br/>
        <a href="browse.php">Browse by Title</a><br/>
        <a href="about.php">About Us</a><br/>
        <a href="shipping.php">Shipping</a></p>
      <p class="col-md-2"><span class="bold">Shopping Catogories</span><br/>
        <a href="shop.php?filter=new">Newly Added</a><br/>
        <a href="shop.php?filter=cgc">CGC<br/>Featured Title</a><br/>
        <a href="shop.php?filter=dollar">Dollar Deals</a></p>
      <p class="col-md-2"><span class="bold">The Fine Print</span><br/>
        <a href="terms.php">Terms &amp; Conditions</a><br/>
        <a href="terms.php#privacy">Privacy Policy</a></p>
      <p class="col-md-2"><span class="bold">Contact Us</span><br/>P.O. Box 1245<br/>Spokane, WA 99205<br/><br/>info@spiralcomics.com</p>      
    </footer>
  </div> <!-- End Container -->
  <!-- Javascript
    ================================================== --> 
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>