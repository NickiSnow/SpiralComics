<?php
  require_once('includes/session.php');
  require_once('includes/functions.php');
  require_once("includes/db_connection.php");
  require_once('config.php');
  require 'vendor/autoload.php';

  // Get the credit card details submitted by the form
  $token = $_POST['stripeToken'];

  // Create the charge on Stripe's servers - this will charge the user's card
  try {
    $charge = \Stripe\Charge::create(array(
      "amount" => $_SESSION['Payment_Amount']*100, // amount in cents, again
      "currency" => "usd",
      "source" => $token,
      "description" => $_SESSION['email']
      ));

    //Create order in the database
    $user_id = $_SESSION['user_id'];
    $query  = "INSERT INTO tbl_orders (";
    $query .= "  user_id";
    $query .= ") VALUES (";
    $query .= "  '{$user_id}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);
    confirm_query($result);

    //Get the order_id of the order just created
    $query = "SELECT * from tbl_orders";
    $query .= " ORDER BY order_date DESC";
    $query .= " LIMIT 1";
    $order_result = mysqli_query($connection, $query);
    confirm_query($order_result);
    $order_result = mysqli_fetch_array($order_result);
    $order_id = $order_result['order_id'];

    //Add items to order in database
    foreach ($_SESSION['cart'] as $key => $cart) {
      foreach ($cart as $key => $items){
        $query  = "INSERT INTO tbl_order_line_items (";
        $query .= "  order_id, inventory_id, item_quantity";
        $query .= ") VALUES ( ";
        $query .= $order_id.", '".$items['inventory_id']. "', ".$items['quantity'];
        $query .= ")";
        $result = mysqli_query($connection, $query);
        confirm_query($result);
      }
    }

    //Clear cart and any remaining card errors
    unset($_SESSION['cart']);
    unset($_SESSION['stripe_error']);
    redirect_to('thanks.php');

  } catch(\Stripe\Error\Card $e) {
    // The charge failed for some reason. Stripe's message will explain why.
    $message = $e->getMessage();
    $_SESSION['stripe_error'] = $message;
    redirect_to('checkout.php');
  }
?>