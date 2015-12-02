<?php
require_once('login.php'); // Includes User Login Script
require_once('register.php');// Includes User Registration Script
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
	<title>Spiral Comics Terms & Conditions</title>
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
    <div class="row">
      <h1>Terms &amp; Conditions</h1>
      <div class="center-block" id="terms">
        <h3>In using this website you are deemed to have read and agreed to the following terms and conditions:</h3>
        <h4>Disclaimer</h4>
        <p>The information on this web site is provided on an "as is" basis. To the fullest extent permitted by law, this Company:</p>
        <ul>
          <li>excludes all representations and warranties relating to this website and its contents or which is or may be provided by any affiliates or any other third party, including in relation to any inaccuracies or omissions in this website and/or the Company’s literature; and </li>
          <li>excludes all liability for damages arising out of or in connection with your use of this website. This includes, without limitation, direct loss, loss of business or profits (whether or not the loss of such profits was foreseeable, arose in the normal course of things or you have advised this Company of the possibility of such potential loss), damage caused to your computer, computer software, systems and programs and the data thereon or any other direct or indirect, consequential and incidental damages. </li>
        </ul>
        <p>This Company does not however exclude liability for death or personal injury caused by its negligence. The above exclusions and limitations apply only to the extent permitted by law. None of your statutory rights as a consumer are affected.</p>
        <h4><a name="privacy"></a>Privacy Policy</h4>
        <p>The term “Personal Information”, as used in this Policy, refers to any information that can be used to identify a specific person, or any anonymous information (e.g., IP Address) that is linked to a specific person.</p>
        <p>We respect your privacy. Personal Information about you will not be sold or shared with marketers or third parties.</p>
        <p>We may disclose your Personal Information to law enforcement, government officials, or other third parties if: (i) we are compelled to do so by subpoena, court order or other legal process, (ii) we must do so to comply with laws, statutes, rules or regulations, including credit card rules, (iii) we believe in good faith that the disclosure is necessary to prevent physical harm or financial loss, to report suspected illegal activity, or to investigate violations of our Terms of Service.</p>
        <p>We will only disclose your Personal Information in response to such a request if we believe in good faith that doing so is necessary to comply with applicable law or a legal obligation to which we are bound. If we receive such a request, we will use reasonable efforts to give you prompt notice, so that you may contest it if you choose. We won’t provide you such notice if we determine in good faith that either (a) we are not permitted to provide it under applicable law, or (b) that doing so would result in an imminent risk of death, serious physical injury or significant property loss or damage to Spiral Comics or a third party.</p>
        <h4>Security</h4>
        <p>All orders placed at SpiralComics.com are processed over a secure, encrypted connection using 128 bit SSL.</p>
        <p>Once your order information is received, information including your name and address are stored in our database. We do not store credit card information at this time.</p>
        <p>SpiralComics absolutely does not share your name, address, or credit card information with any third party without your express permission. It is our commitment to keep your Personal Information private and confidential at all times.</p>
        <h4>Shipping</h4>
        <p>Shipping for all orders is a flat rate of $5.00 plus $0.50 for each additional item. You may also have your books shipped twice a month or weekly in the United States. There is an additional shipping charge per month if you would like twice a month shipments. These options are only available for orders containing books.</p>
        <h4>Shipping to PO Boxes, APO, FPO, Hawaii, and Alaska</h4>
        <p>Orders sent to PO Boxes, FPO, APO, Alaska, Hawaii, and other U.S. territories are sent by USPS and are subject to actual shipping costs. The flat rate shipping cost will be assessed to the order it is placed. When the order is packaged, the actual cost adjustments will be made to the order at that time. The only option for ground shipping to these locations is the US Postal Service and the rates are much higher than those we negotiate with our shipping carrier. Packages sent by the US Postal Service by this method are not insured, but may be insured for an additional cost. If customers do not choose insurance, we are unable to replace lost packages. Customers in these locations may also request Priority shipping either in flat rate boxes or by Priority Mail at actual cost. Please inquire for costs.</p>
        <h4>Payments</h4>
        <p>All payments are processed through the Stripe Payment API. Stripe allows you to make payments using all major credit cards and debit cards. Spiral Comics uses a PCI compliant service provider for transmission of Payment Data defined as a cardholder’s account number, expiration date, and CVV2. Spiral Comics does not store any payment data at any time.</p>
        <p>Stripe is responsible for protecting the security of Payment Data transfered to their possession during the submission of data from Spiral Comics. Stripe will maintain commercially reasonable administrative, technical, and physical procedures to protect all the personal information regarding Spiral Comics' customers that is stored in their servers from unauthorized access and accidental loss or modification. However, they cannot guarantee that unauthorized third parties will never be able to defeat those measures or use such personal information for improper purposes. By submitting a payment through the Spiral Comics website. You acknowledge that you provide this personal information at your own risk.</p>
        <h4>Links to this website</h4> 
        <p>You may not create a link to any page of this website without our prior written consent. If you do create a link to a page of this website you do so at your own risk and the exclusions and limitations set out above will apply to your use of this website by linking to it.</p>
        <h4>Links from this website</h4>
        <p>We do not monitor or review the content of other party’s websites which are linked to from this website. Opinions expressed or material appearing on such websites are not necessarily shared or endorsed by us and should not be regarded as the publisher of such opinions or material. Please be aware that we are not responsible for the privacy practices, or content, of these sites. We encourage our users to be aware when they leave our site &amp; to read the privacy statements of these sites. You should evaluate the security and trustworthiness of any other site connected to this site or accessed through this site yourself, before disclosing any personal information to them. This Company will not accept any responsibility for any loss or damage in whatever manner, howsoever caused, resulting from your disclosure to third parties of personal information.</p>
        <h4>Notification of Changes</h4>
        <p>The Company reserves the right to change these conditions from time to time as it sees fit and your continued use of the site will signify your acceptance of any adjustment to these terms. If there are any changes to our privacy policy, we will announce that these changes have been made on our home page and on other key pages on our site. If there are any changes in how we use our site customers’ Personally Identifiable Information, notification by e-mail or postal mail will be made to those affected by this change. Any changes to our privacy policy will be posted on our web site 30 days prior to these changes taking place. You are therefore advised to re-read this statement on a regular basis.</p>
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
              <label for="agree"><span></span>I Agree to the <a href="terms.html">Terms &amp; Conditions</a></label><br/>
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
      <p class="col-md-2"><span class="bold">Contact Us</span><br/>P.O. Box 1245<br/>Spokane, WA 99205<br/><br/>comics4u@spiralcomics.com</p>      
    </footer>
  </div> <!-- End Container -->
  <!-- Javascript
    ================================================== --> 
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>