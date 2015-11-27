 <?php
    session_start();

    require_once("$_SERVER[DOCUMENT_ROOT]app/autoload.php"); // include classes / functions
    
 	use Cartalyst\Sentinel\Native\Facades\Sentinel;

 	// Logout
    Sentinel::logout();

    if(!empty($_SESSION["redirectURL"])) //check if session exists
	{
	   	// Redirect to the previous page
		header("location:".$_SESSION['redirectURL']);	
	}

	session_destroy();
 ?>