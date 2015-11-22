<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
  //check for Add To Cart submit
  if (isset($_POST['submit_add'])) {
    // Process the form
    
    if (empty($errors)) {
      // Attempt to find inventory item

      $id = $_POST["id"];
      $quantity = $_POST["quantity"];
      
      $found_item = find_inventory($id);

      if ($found_item) {
        // Success
        $_SESSION['cart']['cart'.$id]=array(); // Declaring session array
        array_push($_SESSION['cart']['cart'.$id],  $found_item);
        redirect_to('shop.php');
      } else {
        // Failure
        $_SESSION["message"] = "Item not found.";
      }
    }
  } // end: if (isset($_POST['submit_add']))
?>