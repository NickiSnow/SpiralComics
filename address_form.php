<?php
require_once('login.php'); // Includes User Login Script
confirm_logged_in();
require_once('add_address.php'); // Includes Script to add address to database
require_once('includes/db_connection.php');// Includes Database Connection Script
//Check if search data was submitted
if (isset($_GET['search'])){
  // Store search term into a variable
  $search_term = $_GET['search'];

  //redirect to search results
  redirect_to('search_results.php?search='.$search_term);
}
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
    <title>Spiral Comics Shipping Form</title>
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
            <form class="navbar-form navbar-right search" role="search" action="" method="GET">
              <div class="input-group">
                <input type="search" class="form-control" placeholder="Search. . ." name="search">
                <div class="input-group-btn">
                    <button class="btn btn-default searchBtn" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                  </div>
              </div>
            </form>
        </div>
      </nav>
    </header>
    <div class=" row grey-box">
        <a href="shop.php"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Continue Shopping</a>
        <h1>Enter Your Shipping Address</h1>
        <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
            <form id="addressForm" action="" method="POST">
                <div class="form-group">
                    <label for="fName">Name</label>
                    <input type="text" class="form-control" id="fName" name="fName" value="<?php echo ($_SESSION['fName']);?>" required>
                    <input type="text" class="form-control" id="lname" name="lName" value="<?php echo ($_SESSION['lName']);?>" required>
                </div>         
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo ($_SESSION['address1']);?>" required>
                    <input type="text" class="form-control" id="address2" name="address2" value="<?php echo ($_SESSION['address2']);?>">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo ($_SESSION['city']);?>" required>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <select id="state" name="state" class="form-control">
                        <?php 
                            //get state data
                            $query  = 'SELECT * FROM tbl_states';
                            $result = mysqli_query($connection, $query);
                            confirm_query($result);
                            //populate the state options
                            while($row = mysqli_fetch_array($result)) {
                                echo '<option value="'.$row['state'].'" ';
                                if($_SESSION['state'] == $row['state']){ 
                                    echo 'selected="selected"'; 
                                }
                                echo '>'.$row['stateName'].'</option>'; 
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="zip">Zipcode</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?php echo ($_SESSION['zip']);?>">
                </div>
                <button type="submit" name="submit_address">Continue</button>
            </form>
        </div>
    </div>    
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