<?php
require_once('login.php'); // Includes User Login Script
confirm_logged_in();
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
    <title>Spiral Comics Checkout</title>
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
        <h1>Checkout</h1>
			<div class="col-lg-7 col-md-6 checkout">
		      <h3> Verify Your Order</h3>
		      <table id="tCheckout" cellpadding="0" cellspacing="0">
		        <tr>
              <th>Qty</th>
              <th>Item Description</th>
              <th class="text-right">Item Price</th>
              <th class="text-right">Sub-Total</th>
		        </tr>
            <?php
              $total = 0;
              $qty_total = 0;
              foreach ($_SESSION['cart'] as $key => $cart) {
                foreach ($cart as $key => $items){
                  echo '<tr>';
                  echo '<td>'.$items['quantity'].'</td>';
                    $qty_total += $items['quantity'];
                  echo '<td>'.$items['title'].' #'.$items['number'].' '.$items['variation_text'].' -- '.$items['grade'].'</td>';
                  echo '<td class="text-right">&#36;'.number_format($items['price'], 2).'</td>';
                  echo '<td class="text-right">&#36;';
                    $subtotal = $items['price']*$items['quantity'];
                  echo  number_format($subtotal, 2).'</td>'; 
                    $total += $subtotal;
                  echo '</tr>';
                }
              }  
            ?>            
		         <tr>
		            <td></td>
                <td></td>
                <td class="text-right"><strong>Shipping</strong></td>
                <?php $shipping = 5+0.5*($qty_total-1);?>
                <td class="text-right">&#36;<?php echo number_format($shipping,2); ?></td>
		          </tr>
		          <tr>
		            <td></td>
                <td></td>
                <td class="text-right"><strong>Total</strong></td>
                <td class="text-right">&#36;<?php $total = $total+$shipping; echo number_format($total, 2); ?></td>
		          </tr>
		      </table>
          <?php $_SESSION['Payment_Amount']=$total; ?>
		   </div>
		   <div class="col-lg-4 col-md-5 col-sm-6 checkout">
		        <h3>Enter Payment Information</h3>
		        <p>Mastercard, Visa, American Express Accepted</p>
		      <form action="charge.php" method="POST" id="payment-form" class="form-inline">
		        	<span class="payment-errors red">
              <?php 
                if (isset($_SESSION['stripe_error'])){
                  echo $_SESSION['stripe_error'];
                  echo '&nbsp;Please try again.<br/>';
                }
              ?>   
              </span>
		        	<div class="form-group">
		          	 <label for="number">Card Number</label>
		              <input type="text" size="20" id="number" data-stripe="number" class="card-number form-control"/>
		        	</div>
		        	<div class="form-group">
	          	  <label for="cvc">CVC</label>
	              <input type="text" size="4" id="cvc" data-stripe="cvc" class="card-cvc form-control"/>
	          	  <a href="#">&nbsp;&nbsp; <span class="glyphicon glyphicon-question-sign"></span> What is CVC?</a> 
		        	</div>
		        	<div class="form-group">
	          	  <label for="date">Expiration (MM/YYYY)</label>
	              <input type="text" size="2" id="date" data-stripe="exp-month" class="card-expiry-month form-control"/>
	          	  <span> / </span>
	          	  <input type="text" size="4" id="year" data-stripe="exp-year" class="card-expiry-year form-control"/>
		        	</div>
		        	<button type="submit">Submit</button>
		      </form>
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
      <p class="col-md-2"><span class="bold">Contact Us</span><br/>P.O. Box 18930<br/>Spokane, WA 99228-0930<br/><br/>comics4u@spiralcomics.com</p>      
    </footer>
  </div> <!-- End Container -->
  <!-- Javascript
    ================================================== --> 
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    // Identify this website in the createToken call below
    Stripe.setPublishableKey('pk_test_nEotTvot1nLDTv7bTBm5nI1N');
    var stripeResponseHandler = function(status, response) {
      var $form = $('#payment-form');
      if (response.error) {
        // Show the errors on the form
        $form.find('.payment-errors').text(response.error.message);
        $form.find('button').prop('disabled', false);
      } else {
        // token contains id, last4, and card type
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and re-submit
        $form.get(0).submit();
      }
    };
    jQuery(function($) {
      $('#payment-form').submit(function(e) {
        var $form = $(this);
        // Disable the submit button to prevent repeated clicks
        $form.find('button').prop('disabled', true);
        Stripe.card.createToken($form, stripeResponseHandler);
        // Prevent the form from submitting with the default action
        return false;
      });
    });
  </script>
</body>
</html>