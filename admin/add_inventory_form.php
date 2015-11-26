<?php
  require_once('../login.php'); //Includes User Login Script
  confirm_admin_logged_in();
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
                      <li><a href="orders.php">Order Report</a>
                      </li>
                      <li><a href="inventoryReport.php">Inventory Report</a>
                      </li>
                      <li class="active"><a href="add_inventory_form.php">Add Inventory</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
    </header>
    <div class="row">
      <h1 id="admin">Administration</h1>
      <form id="addInv" action="add_inventory.php" method="POST">
        <div class="row">
          <div class="form-group col-md-4">
              <label for="inventory_id">InventoryId</label>
              <input type="text" class="form-control" id="inventory_id" name="inventory_id">
          </div>         
          <div class="form-group col-md-2">
              <label for="qty">Quantity</label>
              <input type="text" class="form-control" id="qty" name="qty">
          </div>
          <div class="form-group col-md-3">
              <label for="cost">Cost</label>
              <input type="text" class="form-control" id="cost" name="cost">
          </div>
          <div class="form-group col-md-3">
              <label for="price">Price</label>
              <input type="text" class="form-control" id="price" name="price">
          </div>
        </div> 
        <div class="row">
          <div class="form-group col-md-3">
              <label for="grade">Grade</label>
              <input type="text" class="form-control" id="grade" name="grade">
          </div>         
          <div class="form-group col-md-9">
              <label for="grade_description">Grade Description</label>
              <input type="text" class="form-control" id="grade_description" name="grade_description">
          </div>
        </div>  
        <div class="row">
          <div class="form-group col-md-6">
            <label for="cover">Upload Cover Image</label>
            <input type="file" class="form-control" id="cover" name="cover">
          </div>
          <div class="form-group col-md-3">
            <label for="comic_type">Type</label>
            <select class="form-control filterSelect" id="comic_type" name="comic_type">
              <?php 
                //get state data
                $query  = 'SELECT * FROM tbl_comic_types';
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                //populate the state options
                while($row = mysqli_fetch_array($result)) {
                    echo '<option value="'.$row['type_id'].'" ';
                    echo '>'.$row['type'].'</option>'; 
                }
              ?>
            </select>
          </div>         
          <div class="col-md-3">                   
            <button type="submit" id="add" class="pull-right">Add Comic</button>
          </div> 
        </div>
      </form>
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