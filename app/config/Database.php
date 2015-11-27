<?php

// MySqli
function mysqliConnected() {
	// Variables to connect to database
   $servername = "servername";
   $username = "usernamet";
   $password = "password";
   $dbname = "dbname";

   $conn = new mysqli($servername, $username, $password, $dbname);
   // Change to Utf8
   $conn->set_charset("utf8");

   if($conn->connect_error) {
     die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
 	}

 	// else { echo "connection is real";}

   return $conn;
}

// PDO
function pdoConnected() {
	$servername = "servername";
	$username = "username";
	$password = "password";
	$dbname = "dbname";

	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    }
	catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    return $conn;
}  

// Test if connection is closed or not
/*
  if (mysqli_thread_id($conn)) {
    echo "Connection working";
  }
  else {
    echo "Connection closed";
  }
*/

// Import the necessary classes
use Illuminate\Database\Capsule\Manager as Capsule;

// Include the composer autoload file
require("$_SERVER[DOCUMENT_ROOT]/vendor/autoload.php");

// Setup a new Eloquent Capsule instance
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'servername',
    'database'  => 'dbname',
    'username'  => 'username',
    'password'  => 'password',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
]);

$capsule->bootEloquent();