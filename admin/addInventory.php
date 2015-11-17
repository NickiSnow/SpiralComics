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
                      <li><a href="orders.php">Order Report</a>
                      </li>
                      <li><a href="inventoryReport.php">Inventory Report</a>
                      </li>
                      <li class="active"><a href="addInventory.php">Add Inventory</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
    </header>
    <div class="row">
      <h1 id="admin">Administration</h1>
      <form id="addInv" action="" method="POST">
        <div class="row">
          <div class="form-group col-md-3">
              <label for="comicId">ComicId</label>
              <input type="text" class="form-control" id="comicId" name="comicId">
          </div>         
          <div class="form-group col-md-3">
              <label for="qty">Quantity</label>
              <input type="text" class="form-control" id="qty" name="qty">
          </div>
          <div class="form-group col-md-3">
              <label for="price">Price</label>
              <input type="text" class="form-control" id="price" name="price">
          </div>
          <div class="form-group col-md-3">
              <label for="series">Series</label>
              <input type="text" class="form-control" id="series" name="series">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-10">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title">
          </div>         
          <div class="form-group col-md-2">
              <label for="number">Number</label>
              <input type="text" class="form-control" id="number" name="number">
          </div>
        </div>  
        <div class="row">
          <div class="form-group col-md-6">
              <label for="variation">Variation</label>
              <input type="text" class="form-control" id="variation" name="variation">
          </div>         
          <div class="form-group col-md-6">
              <label for="condition">Condition</label>
              <input type="text" class="form-control" id="condition" name="condition">
          </div>
        </div>  
        <div class="row">
          <div class="form-group col-md-12">
              <label for="creators">Creators</label>
              <textarea class="form-control" rows="2" id="creators" name="creators"></textarea>
          </div>         
        </div>
        <div class="row">
          <div class="form-group col-md-12">
              <label for="description">Description</label>
              <textarea class="form-control" rows="3" id="description" name="description"></textarea>
          </div>         
        </div>
        <div class="row">
          <div class="form-group col-md-9">
            <label for="cover">Upload Cover Image</label>
            <input type="file" class="form-control" id="cover" name="cover">
          </div>
          <div class="col-md-3">                   
            <a id="add" class="button pull-right">Add Comic</a>
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