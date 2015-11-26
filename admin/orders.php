<?php
  require_once('../login.php'); //Includes User Login Script
  confirm_admin_logged_in(); //User must be logged in and admin
  require_once('../includes/db_connection.php');// Includes Database Connection Script
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
                      <li><a href="add_inventory_form.php">Add Inventory</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
    </header>
    <div class="row">
      <h1 id="admin">Administration</h1>
      <div class="table-responsive">
        <form id="orders" action="update_orders.php" method="POST">
          <table class="table table-striped table-bordered">      
          <?php 
            //Get order and user data for each order that has not shipped
            $query  = 'SELECT tbl_orders.*, tbl_users.* FROM tbl_orders ';
            $query .= 'JOIN tbl_users ON tbl_orders.user_id=tbl_users.user_id ';
            $query .= 'WHERE shipped=0';      
            $order_result = mysqli_query($connection, $query);
            confirm_query($order_result);
            //For each order
            while($order = mysqli_fetch_array($order_result)) {
              //Get item information
              $item_query = 'SELECT tbl_orders.*, tbl_order_line_items.inventory_id, tbl_order_line_items.item_quantity, tbl_inventory.price, tbl_inventory.grade, tbl_series.series, tbl_comics.number, tbl_comics.variation_text, tbl_titles.title FROM tbl_orders ';
              $item_query .= 'JOIN tbl_order_line_items ON tbl_orders.order_id=tbl_order_line_items.order_id ';
              $item_query .= 'JOIN tbl_inventory ON tbl_inventory.inventory_id=tbl_order_line_items.inventory_id ';
              $item_query .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
              $item_query .= 'JOIN tbl_series ON tbl_series.series_id=tbl_comics.series_id ';
              $item_query .= 'JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ';
              $item_query .= 'WHERE tbl_orders.order_id='.$order['order_id'];
              $item_result = mysqli_query($connection, $item_query);
              confirm_query($item_result);
              //Create empty string variables
              $price_string = '';
              $quantity_string = '';
              $grade_string = '';
              $title_string = '';
              $address_string = '';
              //For each item ordered, create info as strings
              while($item = mysqli_fetch_array($item_result)) {
                $price_string .= '<br/>$'.$item['price'];
                $quantity_string .= '<br/>'.$item['item_quantity'];
                $grade_string .= '<br/>'.$item['grade'];
                $title_string .= '<br/>'.$item['title'].' ('.$item['series'].') #'.$item['number'].' '.$item['variation_text'];
              }
              //Build users shipping information
              $address_string .= '<br/>'.$order['first_name'].' '.$order['last_name'].'<br/>'.$order['address1'];
              if($order['address2']!=''){
                $address_string.= '<br/>'.$order['address2'];
              }
              $address_string .= '<br/>'.$order['city'].', '.$order['state'].' '.$order['zip'];
              //Display order
              echo '<tr>';
              echo '<td class="narrowest"><strong>Order Date</strong><br/>'.date('M j Y', strtotime($order['order_date'])).'</td>';
              echo '<td><strong>Price</strong>'.$price_string.'</td>';
              echo '<td class="text-center"><strong>Qty</strong>'.$quantity_string.'</td>';
              echo '<td><strong>Condition</strong>'.$grade_string.'</td>';
              echo '<td class="medium"><strong>Comic Book Title, Series, Number, Variation</strong>'.$title_string.'</td>';
              echo '<td><strong>Username</strong><br/>'.$order['username'].'</td>';
              echo '<td><strong>Shipping Address</strong>'.$address_string.'</td>';
              echo '<td class="text-center"><strong>Shipped ?</strong><br/>';
              echo '<input type="checkbox" id="'.$order['order_id'].'" name="'.$order['order_id'].'"/>';
              echo '<label for="'.$order['order_id'].'"><span></span></label></td>';
              echo '</tr>';
            }
          ?>
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