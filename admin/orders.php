<?php
  require_once('../login.php'); //Includes User Login Script
  confirm_admin_logged_in();
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
	<title>Spiral Comics Admin</title>
	<meta name="description" content="Spiral Comics is an online comic book sales site that specializes in Star Wars comics and recent hot comics.">
	<meta name="author" content="Nicole Snow">
		<!-- Mobile Specific Metas
  	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<!-- CSS / Bootstrap
  	================================================== --> 
  <link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet" />
    <!-- Favicon
    ================================================== --> 
    <!-- for FF, Chrome, Opera -->
  <link rel="icon" type="image/png" href="../images/favicon-16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="../images/favicon.png" sizes="32x32">
    <!-- for IE -->
  <link rel="icon" type="image/x-icon" href="../images/favicon.ico" >
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico"/> 
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
        <img src="../images/Spiral-Comics-logo.gif" alt="Spiral Comics Logo" />
        <div class="right pull-right">
          <?php
            if(isset($_SESSION['username'])){
                echo 'Hi, '.$_SESSION['username'].'!';
                echo '&nbsp;&nbsp;&nbsp;<a href="../logout.php">Logout</a>';
            }
          ?>
        </div>
      </div>
      <div id="admin-menu" class="navbar navbar-default " role="navigation">
          <div class="container-fluid">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menu"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                  </button>
              </div>
              <div class="collapse navbar-collapse navbar-menu">
                  <ul class="nav navbar-nav navbar-left">
                      <li class="active"><a href="orders.php">Order Report</a>
                      </li>
                      <li><a href="inventoryReport.php">Inventory Report</a>
                      </li>
                      <li><a href="addInventory.php">Add Inventory</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
    </header>
    <div class="row">
      <h1 id="admin">Administration</h1>
      <div class="table-responsive">
        <form id="orders" action="" method="POST">
          <table class="table table-striped table-bordered">
            <tr>
              <td><strong>Order Date</strong><br/>Sept 24, 2015</td>
              <td><strong>Price</strong><br/>$4.99<br/>$3.99</td>
              <td class="text-center"><strong>Qty</strong><br/>1<br/>1</td>
              <td><strong>Condition</strong><br/>VF+<br/>NM</td>
              <td><strong>Comic Book Title #</strong><br/>Star Wars (1977) #27<br/>Star Wars Clone Wars #1</td>
              <td><strong>Username</strong><br/>snowbi-wan</td>
              <td><strong>Shipping Address</strong><br/>Glenn Snow<br/>1234 Sierra Highway<br/>Apt 101<br/>Santa Clarita, CA 91351</td>
              <td class="text-center"><strong>Shipped ?</strong><br/>
                <input type="checkbox" id="shipped1" name="shipped1"/>
                <label for="shipped1"><span></span></label>
              </td>
            </tr>
            <tr>
              <td><strong>Order Date</strong><br/>Sept 23, 2015</td>
              <td><strong>Price</strong><br/>$2.49<br/>$3.29<br/>$2.99<br/>$2.99</td>
              <td class="text-center"><strong>Qty</strong><br/>2<br/>1<br/>1<br/>1<br/>1</td>
              <td><strong>Condition</strong><br/>NM<br/>NM<br/>NM<br/>VF+<br/>NM</td>
              <td><strong>Comic Book Title #</strong><br/>Uncanny Avengers #1<br/>Wildcats (2006) #1<br/>Wildcats (2006) #2<br/>Savage Wolverine (2013) #1<br/>Wolverine (2013) #1</td>
              <td><strong>Username</strong><br/>rogue_two</td>
              <td><strong>Shipping Address</strong><br/>Paul Nguyen<br/>10023 Washington St<br/>Spokane, WA 99208</td>
              <td class="text-center"><strong>Shipped ?</strong><br/>
                <input type="checkbox" id="shipped2" name="shipped2"/>
                <label for="shipped2"><span></span></label>
              </td>
            </tr>
            <tr>
              <td><strong>Order Date</strong><br/>Sept 23, 2015</td>
              <td><strong>Price</strong><br/>$4.99<br/>$3.99</td>
              <td class="text-center"><strong>Qty</strong><br/>3<br/>1</td>
              <td><strong>Condition</strong><br/>VF+<br/>NM</td>
              <td><strong>Comic Book Title #</strong><br/>Batman Incorporated #1<br/>Star Wars Clone Wars #1</td>
              <td><strong>Username</strong><br/>comicfan01</td>
              <td><strong>Shipping Address</strong><br/>Joshua Morgan<br/>12439 N Division Rd<br/>Unit 304<br/>Lewisville, TX 75077</td>
              <td class="text-center"><strong>Shipped ?</strong><br/>
                <input type="checkbox" id="shipped3" name="shipped3"/>
                <label for="shipped3"><span></span></label>
              </td>
            </tr>
            <tr>
              <td><strong>Order Date</strong><br/>Sept 22, 2015</td>
              <td><strong>Price</strong><br/>$4.99<br/>$3.99</td>
              <td class="text-center"><strong>Qty</strong><br/>1<br/>1</td>
              <td><strong>Condition</strong><br/>VF+<br/>NM</td>
              <td><strong>Comic Book Title #</strong><br/>Star Wars (1977) #27<br/>Star Wars Clone Wars #1</td>
              <td><strong>Username</strong><br/>snowbi-wan</td>
              <td><strong>Shipping Address</strong><br/>Glenn Snow<br/>1234 Sierra Highway<br/>Apt 101<br/>Santa Clarita, CA 91351</td>
              <td class="text-center"><strong>Shipped ?</strong><br/>
                <input type="checkbox" id="shipped4" name="shipped4"/>
                <label for="shipped4"><span></span></label>
              </td>
            </tr>
          </table>
          <button class="pull-right" type="submit">Update Shipped</button>
        </form>
        <div class="clearfix"></div>
      </div>
    </div><!-- End Row 1 -->
    <footer class="row">
      <p class="col-lg-4">This Website &copy; 2015 SpiralComics.<br/>All characters are copyrighted by their respective publishers.</p>
    </footer>
  </div> <!-- End Container -->
  <!-- Javascript
    ================================================== --> 
  <script src="../js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>