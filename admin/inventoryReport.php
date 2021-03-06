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
                      <li class="active"><a href="inventoryReport.php">Inventory Report</a>
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
        <table class="table table-striped table-bordered">
          <tr>
            <th>ComicID</th>
            <th>Series</th>
            <th>Title</th>
            <th>Number</th>
            <th>Variation</th>
            <th>Condition</th>
            <th>Qty</th>
            <th>Price</th>
          </tr>
          <?php
            $query  = 'SELECT tbl_inventory.*, tbl_titles.title, tbl_comics.comic_id, tbl_comics.number, tbl_comics.description, tbl_comics.creators, tbl_comics.variation_text, tbl_series.series FROM tbl_inventory ';
            $query .= 'JOIN tbl_comics ON tbl_inventory.comic_id=tbl_comics.comic_id ';
            $query .= 'JOIN tbl_series ON tbl_comics.series_id=tbl_series.series_id ';
            $query .= 'JOIN tbl_titles ON tbl_series.title_id_text=tbl_titles.title_id_text ';
            $query .= 'ORDER BY tbl_titles.title ASC ';
            $result = mysqli_query($connection, $query);
            confirm_query($result);
            while($row = mysqli_fetch_array($result)) {
              echo '<tr>';
              echo '<td>'.$row['comic_id'].'</td>';
              echo '<td>'.$row['series'].'</td>';
              echo '<td class="narrow">'.$row['title'].'</td>';
              echo '<td class="text-center">'.$row['number'].'</td>';
              echo '<td class="narrower">'.$row['variation_text'].'</td>';
              echo '<td>'.$row['grade'].'</td>';
              echo '<td colspan="2"><form class="form-inline inventory" action="update_inventory.php" method="POST"><div class="form-group"><label for="quantity"><span>Qty</span>';
              echo '<input type="text" size="3" name="quantity" class="form-control" value="'.$row['quantity'].'" /></label></div>';
              echo '<div class="form-group"><label for="price"><span>Price</span><input type="text" size="6" name="price" class="form-control" value="'.$row['price'].'"/></label></div>';
              echo '<input type="text" class="hidden" name="id" value="'.$row['inventory_id'].'" /><button class="inventory_btn" type="submit"><img src="../images/refresh_icon.gif" /></button></form></td>';
              echo '</tr>';
            }
          ?>
        </table>
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