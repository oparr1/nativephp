<?php 
    $metaTitle = "Password reset";
    $metaDescription = "This is the password reset page";
    include('../partials/header.php');
?>

<?php
require_once("$_SERVER[DOCUMENT_ROOT]app/autoload.php"); // include classes / functions

use Cartalyst\Sentinel\Native\Facades\Sentinel;

// define variables and initialize with empty values
$email = $password = $password_confirmation = "";
$errors = [];

// function for isset/not empty
if (get_set('id') && get_set('code')) {

		// Store GET variables in a session
		$_SESSION['id'] = $_GET['id'];
		$_SESSION['code'] = $_GET['code'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Clean Input
	$password = clean_input('password');
	$password_confirmation = clean_input('password_confirmation');

	// Password
    if (empty($password))
    {
        $errors['password'] = 'Password field is required';
    }
    else if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%^&*()]{8,}$/iD', $password))
    {
        $errors['password'] = "Password must be 8 or more characters and have atleast one number and letter.";
    }

    // Confirm Password
    if (empty($password_confirmation))
    {
        $errors['password_confirmation'] = "Password confirmation field is required";
    }
    else if ($password != $password_confirmation)
    {
        $errors['password_confirmation'] = "The password confirmation does not match";
    }

    // Validate success
    if (empty($errors)) {

    	// isset user id and code
        if (isset($_SESSION['id']) && isset($_SESSION['code'])) {
            $user = Sentinel::findById($_SESSION['id']);
            $code = $_SESSION['code'];
        }

        // if user and code is not empty
        if (!empty($user) && !empty($code)) {

    		// Check if code works with user
    		if (!Sentinel::getReminderRepository()->complete($user, $code, $password))
    		{
    			// Session - Failed Message
    		    $session->error('failed', 'Invalid or expired reset code.');
    		}
    		else
    		{
    		// Session - Success Message
            $session->success('success', 'Password reset successful. Redirecting you to the login page in 5 seconds or click <a href="login">here</a>.');

            // redirect to login page 5 seconds
            header( "refresh:5;url=login" );
            session_destroy();
    		}

        }
        else {
            // Session - Failed Message
            $session->error('failed', 'Invalid or expired reset code.');
        }
    }
}
?>

<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col9">
            <section id="sectionPadding">
        		    <!-- Success/Error message on submit -->
                    <div id="message">
                        <?php         
                            $session->success('success');
                            $session->error('failed');
                        ?>
                    </div>

					<h3>Reset your password</h3>
					<hr />

					<form class="form-horizontal" role="form" method="POST" action="reset">
						<input type="hidden" name="id" value="<?php echo html($_SESSION['id']); ?>">


						<div class="form-group">
							<div class="contacttooltips">
								<label class="col-md-4 control-label">New Password</label>
								<input id="password" type="password" class="form-control" name="password">
								<!-- Errors -->    		
	                    		<?php if (isset($errors['password'])) : ?>
	                    		 <label class="error"><?php echo $errors['password']; ?></label>
	                    		<?php endif ?>							
                    		</div>
						</div>

						<div class="form-group">
							<div class="contacttooltips">
								<label class="col-md-4 control-label">Confirm Password</label>
								<input type="password" class="form-control" name="password_confirmation">
								<!-- Errors -->    		
	                    		<?php if (isset($errors['password_confirmation'])) : ?>
	                    		 <label class="error"><?php echo $errors['password_confirmation']; ?></label>
	                    		<?php endif ?>
                    		</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>
			</section>
		</div>
	</div>
</div>

<?php include('../partials/footer.php'); ?>

<script>
    // Add a Regex for password 
   $.validator.addMethod("regex", function(value, element, regexpr) {          
     return regexpr.test(value);
   }, "Password must be 8 or more characters and have atleast one number and letter."); 

$(".form-horizontal").validate({
    rules: {
        password: {
        	required: true,
        	regex: /^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%^&*()]{8,}$/
        },
        password_confirmation: {
        	required: true,
        	equalTo: "#password" // Requires input id="password"
        }
    },
    messages: {
        password: {
        	required: "A password is required"
        },
        password_confirmation: {
        	required: "A password confirmation is required",
        	equalTo: "The password confirmation does not match"
        }
    }
});
</script> 
