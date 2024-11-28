<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Require Composer's autoloader.
require 'vendor/autoload.php';

// namespace.
use Medoo\Medoo;
use \BinanceApi\Binance;
require_once "src/config.php";
if (isset($_POST["order_number"]))

{
  require "src/createinvoice.php";
} elseif (isset($_GET["in"])){
  require "src/currencytemplate.php";
} elseif (isset($_POST["invoice_id"]))
{
  require "src/updateinvoice.php";
  if (!isset($error) && $invoice_id) {
    require "src/address.php";
    require "src/paytemplate.php";
  }
} elseif (isset($_GET['checkpayment'])){
  require "src/checkpayment.php";
} elseif (isset($_GET["pay_id"])){
  require "src/paycheck.php";
} else {
  $error = "No Information Available or Authentication Error. ";
}
if (isset($error)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <title>Error 404</title>
</head>
<body>
    <div class="container">
      <div class="warning-notification-bar">
            <div class="icon">
                <img src="assets/img/warning.png" alt="Warning Icon"/>
            </div>
            <div class="notification">
                <?php echo $error; ?>
            </div>
        </div>
      </div>
<?php } elseif (isset($success)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <title>Success Information</title>
</head>
<body>
    <div class="container">
      <div class="notification-bar">
            <div class="icon">
                <img src="assets/img/success.png" alt="Success Icon"/>
            </div>
            <div class="notification">
                <?php echo $success; ?>
            </div>
        </div>
      </div>
<?php
}
?>
