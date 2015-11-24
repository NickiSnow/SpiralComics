<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_53T4DtQ8izR4oemSjlVxGBS0",
  "publishable_key" => "pk_test_nEotTvot1nLDTv7bTBm5nI1N"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>