<?php 

class Session {

	// Start session to access session data on different pages - Session::start();
	function start() {

		if(session_status() == PHP_SESSION_NONE){
		    //session has not started
		    session_start();
		}
	}

	// Success/Error Html in the view - Flash 
	function flash($name = '', $message = '')
	{
   		 //We can only do something if the name isn't empty
		if(!empty($name))
		{
		    //No message, create it
		    if(!empty($message) && empty($_SESSION[$name]))
		    {
		        if( !empty( $_SESSION[$name] ) )
		        {
		            unset( $_SESSION[$name] );
		        }
		        $_SESSION[$name] = $message;
		    }
		    //Message exists, display it
		    elseif(!empty($_SESSION[$name]) && empty($message))
		    {
		        echo $_SESSION[$name];
		        unset($_SESSION[$name]);
		    }
		}
	}

	// Success - Flash Template
	function success($name = '', $message = '')
	{
   		 //We can only do something if the name isn't empty
		if(!empty($name))
		{
		    //No message, create it
		    if(!empty($message) && empty($_SESSION[$name]))
		    {
		        if( !empty( $_SESSION[$name] ) )
		        {
		            unset( $_SESSION[$name] );
		        }
		        $_SESSION[$name] = $message;
		    }
		    //Message exists, display it
		    elseif(!empty( $_SESSION[$name]) && empty($message))
		    {
		    	// Find Template and replace message - better to use include path to not conflict with htaccess
		        $templated_message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'views/flash/success.php', FILE_USE_INCLUDE_PATH);
		        $templated_message = str_replace('{{success}}', $_SESSION[$name], $templated_message);
		        echo $templated_message;
		        unset($_SESSION[$name]);
		    }
		}
	}

	// Error - Flash Template
	function error($name = '', $message = '')
	{
   		 //We can only do something if the name isn't empty
		if(!empty($name))
		{
		    //No message, create it
		    if(!empty($message) && empty($_SESSION[$name]))
		    {
		        if(!empty( $_SESSION[$name]))
		        {
		            unset( $_SESSION[$name]);
		        }
		        // Initialise it
		        $_SESSION[$name] = $message;
		    }
		    //Message exists, display it
		    elseif(!empty( $_SESSION[$name]) && empty($message))
		    {
		    	// Find Template and replace message - better to use include path to not conflict with htaccess
		        $templated_message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'views/flash/error.php', FILE_USE_INCLUDE_PATH);

		        $templated_message = str_replace('{{error}}', $_SESSION[$name], $templated_message);
		        echo $templated_message;
		        unset($_SESSION[$name]);
		    }
		}
	}

	// Check if session has started across multiple pages
	function is_session_started()
	{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
	}

}

/*
// Get all $_SESSIONS
print_r($_SESSION);

//Ensure that a session exists (just in case)
if(session_status() == PHP_SESSION_NONE){session_start();}

// Declare class
$session = new Session();
or
Session::

$session->success('success', 'Thank you for contacting us! We will get back to you shortly.');
$session->error('failed', 'Big error');

// call the session
$session->success('success'); 
$session->error('failed');
*/ 

?>
