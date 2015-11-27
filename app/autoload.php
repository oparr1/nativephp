<?php

// Include classes
spl_autoload_register(function($class){
   require_once("$_SERVER[DOCUMENT_ROOT]app/functions/$class.php");
});

// Initiate classes
$session = new Session();

// Include functions
require_once("$_SERVER[DOCUMENT_ROOT]app/config/database.php"); // Database
require_once("$_SERVER[DOCUMENT_ROOT]app/config/Mail.php"); // Mail
require_once("$_SERVER[DOCUMENT_ROOT]app/functions/sanitise.php"); // Sanitise


/* ================================================================
							Notes
================================================================ */

// Check if class works
/*
      function __construct() {
          echo 'Class sanitise working <br />';
      }
*/

?>
