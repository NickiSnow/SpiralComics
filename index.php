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
                <li class="active"><a href="#">Home</a>
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
        <a href="shop.php?filter=new"><h2>Newly added comics</h2></a>
        <?php
          $query  = 'SELECT tbl_inventory.*, tbl_titles.title, tbl_comics.number, tbl_comics.description, tbl_comics.creators, tbl_comics.variation_text, tbl_publishers.publisher FROM tbl_inventory ';
          $query .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
          $query .= 'JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ';
          $query .= 'JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ';
          $query .= 'JOIN tbl_publishers ON tbl_series.publisher_id=tbl_publishers.publisher_id ';
          $query .= 'ORDER BY tbl_inventory.date_added DESC ';      
          $query .= 'LIMIT 3';
          $new_result = mysqli_query($connection, $query);
          confirm_query($new_result);
        ?>       
        <div class="row box-content">
        <?php
          while($row = mysqli_fetch_array($new_result)) {
            echo '<div class="col-sm-4">';
            echo '<a href="" class="open-ComicDetails" data-title="'.$row['title'].'" data-number="'.$row['number'].'" data-variation="'.$row['variation_text'].'" data-description="'.$row['description'].'" data-image="'.$row['picture_500'].'" data-creators="'.$row['creators'].'" data-price="'.$row['price'].'" data-condition="'.$row['grade'].'" data-toggle="modal" data-target="#comicModal">';
            echo '<img class="img-responsive" src="images/comics/'.$row['picture_500'].'" alt="comic cover"></a>';
            echo '<p>'.$row['title'].' #'.$row['number'].' '.$row['variation_text'].'<br/>'.$row['publisher'].'<br/>'.$row['grade'].'<br/> Price: $'.$row['price'].'</p>';
            echo '</div>';
          }
        ?>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-1 blue-box">
        <a href="shop.php?filter=cgc"><h2>CGC Graded Comics</h2></a>
          <div class="row box-content">
            <div class="col-md-7 col-sm-4 col-xs-8">
              <?php
                $query  = 'SELECT tbl_inventory.*, tbl_titles.title, tbl_comics.number, tbl_comics.description, tbl_comics.creators, tbl_comics.variation_text, tbl_grades.grade_number FROM tbl_inventory ';
                $query .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
                $query .= 'JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ';
                $query .= 'JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ';
                $query .= 'JOIN tbl_grades ON tbl_inventory.grade=tbl_grades.grade ';
                $query .= 'WHERE type_id=3 ';
                $query .= 'ORDER BY RAND() ';      
                $query .= 'LIMIT 1';
                $cgc_result = mysqli_query($connection, $query);
                confirm_query($new_result);
                $cgc_result = mysqli_fetch_array($cgc_result);
              ?>
              <?php
                echo '<a href="" class="open-ComicDetails" data-title="'.$cgc_result['title'].'" data-number="'.$cgc_result['number'].'" data-variation="'.$cgc_result['variation_text'].'" data-description="'.$cgc_result['description'].'" data-image="'.$cgc_result['picture_500'].'" data-creators="'.$cgc_result['creators'].'" data-price="'.$cgc_result['price'].'" data-condition="CGC '.$cgc_result['grade_number'].'" data-toggle="modal" data-target="#comicModal">';
                echo '<img class="img-responsive" src="images/comics/'.$cgc_result['picture_500'].'" alt="CGC Comic cover"></a>';
                echo '<p>'.$cgc_result['title'].' #'.$cgc_result['number'].' '.$cgc_result['variation_text'].'<br/> CGC '.$cgc_result['grade_number'].'<br/> Price: $'.$cgc_result['price'].'</p>'
              ?>
              
            </div>
            <div class="col-md-5 col-sm-5 col-xs-4">
              <img class="img-responsive middle" src="images/cgc.jpeg" alt="CGC Logo">
            </div>
          </div>
      </div>
    </div><!-- End Row 2 -->
    <div class="row">
      <div class="col-md-7 blue-box">
        <?php
          $query  = 'SELECT tbl_inventory.*, tbl_titles.title, tbl_comics.number, tbl_comics.description, tbl_comics.creators, tbl_comics.variation_text, tbl_publishers.publisher FROM tbl_inventory ';
          $query .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
          $query .= 'JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ';
          $query .= 'JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ';
          $query .= 'JOIN tbl_publishers ON tbl_series.publisher_id=tbl_publishers.publisher_id ';
          $query .= 'WHERE tbl_titles.title="STAR WARS" AND tbl_series.series="1977" ';      
          $query .= 'LIMIT 3';
          $feature_result = mysqli_query($connection, $query);
          confirm_query($feature_result);
        ?>
        <a href="title.php?filter=STAR WARS"><h2>Featured Title: Star Wars</h2>
        <div class="row box-content">
        <?php
          while($row = mysqli_fetch_array($feature_result)) {
            echo '<div class="col-sm-4">';
            echo '<a href="" class="open-ComicDetails" data-title="'.$row['title'].'" data-number="'.$row['number'].'" data-variation="'.$row['variation_text'].'" data-description="'.$row['description'].'" data-image="'.$row['picture_500'].'" data-creators="'.$row['creators'].'" data-price="'.$row['price'].'" data-condition="'.$row['grade'].'" data-toggle="modal" data-target="#comicModal">';
            echo '<img class="img-responsive" src="images/comics/'.$row['picture_500'].'" alt="comic cover"></a>';
            echo '<p>'.$row['title'].' #'.$row['number'].' '.$row['variation_text'].'<br/>'.$row['publisher'].'<br/>'.$row['grade'].'<br/> Price: $'.$row['price'].'</p>';
            echo '</div>';
          }
        ?>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-1 blue-box">
        <a href="shop.php?filter=dollar"><h2>Dollar Deals</h2>
          <div class="row box-content">
            <div class="col-md-7 col-sm-4 col-xs-8">
              <?php
                $query  = 'SELECT tbl_inventory.*, tbl_titles.title, tbl_comics.number, tbl_comics.description, tbl_comics.creators, tbl_comics.variation_text, tbl_publishers.publisher FROM tbl_inventory ';
                $query .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
                $query .= 'JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ';
                $query .= 'JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ';
                $query .= 'JOIN tbl_publishers ON tbl_series.publisher_id=tbl_publishers.publisher_id ';
                $query .= 'WHERE price=1.00 ';
                $query .= 'ORDER BY RAND() ';      
                $query .= 'LIMIT 1';
                $dollar_result = mysqli_query($connection, $query);
                confirm_query($dollar_result);
                $dollar_result = mysqli_fetch_array($dollar_result);
              ?>
              <?php
                echo '<a href="" class="open-ComicDetails" data-title="'.$dollar_result['title'].'" data-number="'.$dollar_result['number'].'" data-variation="'.$dollar_result['variation_text'].'" data-description="'.$dollar_result['description'].'" data-image="'.$dollar_result['picture_500'].'" data-creators="'.$dollar_result['creators'].'" data-price="'.$dollar_result['price'].'" data-condition="'.$dollar_result['grade'].'" data-toggle="modal" data-target="#comicModal">';
                echo '<img class="img-responsive" src="images/comics/'.$dollar_result['picture_500'].'" alt="Dollar Deal Comic cover"></a>';
                echo '<p>'.$dollar_result['title'].' #'.$dollar_result['number'].' '.$dollar_result['variation_text'].'<br/>'.$dollar_result['publisher'].'<br/>'.$dollar_result['grade'].'<br/> Price: $'.$dollar_result['price'].'</p>'
              ?>
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
            <p class="text-center red"><?php if (isset($_SESSION['message'])) {
              echo $_SESSION['message'];}?>
            </p>
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
    <!-- comicModal -->
    <div class="modal modal-wide fade" id="comicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h1 class="modal-title" id="title"></h1>
            </div><!-- /.modal-header -->
            <div class="modal-body">
              <div class="row">
                <div class="col-md-5 col-sm-6">
                  <div class="pull-left"><img class="img-responsive" id="modalImage" src=""></div>
                </div>
                <div class="col-md-7 col-sm-6">
                  <h3>Creators</h3>
                  <p id="creators"></p>
                  <h3>Description</h3>
                  <p id="description"></p>
                  <h3>Condition</h3>
                  <p id="condition"></p>
                  <h3>Price $<span id="price"></span></h3>
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
  <script type="text/javascript">
    <?php if(isset($_POST['submit_login']) && $_SESSION['message']=='Username/password not found.') { ?> /* Checking that the login form has been submitted */
    $(function() {                       
        $('#loginModal').modal('show');     // Show the modal
    });
    <?php } ?>
  </script>
</body>
</html>