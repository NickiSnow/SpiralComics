<?php
require_once('login.php'); // Includes User Login Script
require_once('register.php');// Includes User Registration Script
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
	<title>Spiral Comics Browse Titles</title>
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
                <li class="active"><a href="browse.php">Browse Titles</a>
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
    <div class="row">
      <h1>Browse Comic Book Titles</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-5">
        <div class="dropdown">
        <?php
          $query_p  = 'SELECT tbl_inventory.*, tbl_publishers.publisher_id, tbl_publishers.publisher FROM tbl_inventory ';
          $query_p .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
          $query_p .= 'JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ';
          $query_p .= 'JOIN tbl_publishers ON tbl_series.publisher_id=tbl_publishers.publisher_id ';
          $query_p .= 'GROUP BY tbl_publishers.publisher ASC ';      

          $result_p = mysqli_query($connection, $query_p);
          confirm_query($result_p);
        ?>
          <a id="publisherDrop" role="button">
            <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
            Publisher (<?php echo mysqli_num_rows($result_p)?>)
          </a>
          <form id="publisherForm" method="GET" action="">
            <ul class="publisher">
              <?php
                while($row = mysqli_fetch_array($result_p)) {
                  echo '<li><input type="checkbox" class="publisherCheckbox" id="'.$row['publisher_id'].'" name="'.$row['publisher_id'].'" value="'.$row['publisher'].'"'.(isset($_GET[$row['publisher_id']])?' checked':'').'><label for="'.$row['publisher_id'].'"><span></span></label>'.$row['publisher'].'</li>';
                }
              ?>
            </ul>
          </form>
        </div>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-7">
        <p id="titles">
          <?php
            if (isset($_GET[191])) {
              $arguments[] = "publisher LIKE '%MAR%'";
            }
            if (isset($_GET[90])) {
              $arguments[] = "publisher LIKE '%DC%'";
            }
            if (isset($_GET[85])) {
              $arguments[] = "publisher LIKE '%DARK%'";
            }
            if (isset($_GET[57])) {
              $arguments[] = "publisher LIKE '%BOOM%'";
            }
            if (isset($_GET[37])) {
              $arguments[] = "publisher LIKE '%ASTON%'";
            }
            if (isset($_GET[153])) {
              $arguments[] = "publisher LIKE '%IDW%'";
            }
            if(!empty($arguments)) {
              $str = implode(' or ',$arguments);

              $query  = 'SELECT tbl_publishers.publisher, tbl_titles.title FROM tbl_inventory ';
              $query .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
              $query .= 'JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ';
              $query .= 'JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ';
              $query .= 'JOIN tbl_publishers ON tbl_series.publisher_id=tbl_publishers.publisher_id ';
              $query .= 'WHERE '.$str;         
              $query .= 'GROUP BY tbl_titles.title ASC ';   

            } else {
              $query  = 'SELECT tbl_publishers.publisher, tbl_titles.title FROM tbl_inventory ';
              $query .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
              $query .= 'JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ';
              $query .= 'JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ';
              $query .= 'JOIN tbl_publishers ON tbl_series.publisher_id=tbl_publishers.publisher_id ';          
              $query .= 'GROUP BY tbl_titles.title ASC ';   
            }

            $result = mysqli_query($connection, $query);
            confirm_query($result);

            while($row = mysqli_fetch_array($result)) {
              echo '<a href="title.php?filter='.$row['title'].'">';
              echo $row['title'];
              echo '</a><br/>';
            }
          ?>
        </p>
      </div>
    </div><!-- End Row 1 -->
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
              <label for="agree"><span></span>I Agree to the <a href="terms.php">Terms &amp; Conditions</a></label><br/>
              <button type="submit" name="submit_register" class="pull-right">Submit</button>
            </form>
          </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
  <script src="js/jquery.zrssfeed.min.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>
</body>
</html>