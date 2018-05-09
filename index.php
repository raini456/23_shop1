<?php
require_once './config.php';
require_once './classes/DbClass.php';
require_once './classes/DbClassExt.php';

require_once './classes/Customer.php';
require_once './classes/Address.php';

$db = new DbClassExt('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);
//$adr = new Address('Ranch 15', '12847', 'Kansas');
//$c = new Customer('John', 'Boy', $adr);
$c->insert($db);

$customerData = Customer::find($db, 'Emil');
var_dump($customerData);
//echo nl2br($c->formatedAddress());
?>  

<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <title>PHP 21 Ajax Muster</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="assets/css/styles.css">    
  <script src="assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/js/ajax.js" type="text/javascript"></script>
  <script src="assets/js/main.js" type="text/javascript"></script>
 </head>
 <body>
  <div class="container">



  </div>
 </body>
</html>
