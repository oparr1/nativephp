<?php 
    $metaTitle = "Register";
    $metaDescription = "This is the Register page";
    include('../partials/header.php');
?>

<?php
require_once("$_SERVER[DOCUMENT_ROOT]app/autoload.php"); // include classes / functions

use Cartalyst\Sentinel\Native\Facades\Sentinel;

// define variables and initialize with empty values
$name = $password = $password_confirmation = $email = $email_confirmation = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Clean Input
	$name = clean_input('name');
	$email = clean_input('email');
	$email_confirmation = clean_input('email_confirmation');
	$password = clean_input('password');
	$password_confirmation = clean_input('password_confirmation');

	// Register
	$credentials = [
	    'first_name'     => $name,
	    'email'    		 => $email,
	    'password' 		 => $password,
	];

	// Name Errors
	if (empty($name)) {
		$errors['name'] = "Name field is required";
	}
	else if (strlen($name) < 2) {
        $errors['name'] = "A name must have 2 or more characters";
    }
    else if(strlen($name) > 50) {
        $errors['name'] = "A name must have 50 or less characters";
    }

	// Email Errors
	if (empty($email)) {
		$errors['email'] = "Email address field is required";
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "A valid email address is required";
    }
	// Check if email is unique
	else if(Sentinel::findByCredentials([
    	'login' => $email,
	])) 
	{
		$errors['email'] = "User already exists with this email.";
	}

    // Confirm Email
    if (empty($email_confirmation))
    {
        $errors['email_confirmation'] = "Email confirmation field is required";
    }
    else if ($email != $email_confirmation)
    {
        $errors['email_confirmation'] = "The email confirmation does not match";
    }

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

	// if errors empty - register the user
	if(empty($errors)) {

		Sentinel::registerAndActivate($credentials);

		// Session - Success Message
        $session->success('success', 'You have successfully created an account!');
	}
	else {
		// Session - Error Message
		$session->error('failed', 'Failed to create an account! Please check if there are any errors to correct below.');
	}
	
}
	// Redirect if user is logged in to root
	if ($user = Sentinel::check()) {
		header("location: /");
	}
?>

<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col10">
        	<section id="registerbox">
        		    <!-- Success/Error message on submit -->
                    <div id="message">
                        <?php         
                            $session->success('success');
                            $session->error('failed');
                        ?>
                    </div>

					<h3>Create a new account</h3>
        			<hr />

					<form class="form-horizontal" role="form" method="POST" action="register" novalidate>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<div class="contacttooltips">
								<label class="col-md-4 control-label">Name</label>							
								<input type="text" class="form-control" name="name" value="<?php echo html($name); ?>">	
								<!-- Errors -->    		
	                    		<?php if (isset($errors['name'])) : ?>
	                    		 <label class="error"><?php echo $errors['name']; ?></label>
	                    		<?php endif ?>				
                    		</div>
						</div>

						<div class="form-group">
							<div class="contacttooltips">
								<label class="col-md-4 control-label">Email Address</label>
								<input id="email" type="email" class="form-control" name="email" value="<?php echo html($email); ?>">
								<!-- Errors -->    		
	                    		<?php if (isset($errors['email'])) : ?>
	                    		 <label class="error"><?php echo $errors['email']; ?></label>
	                    		<?php endif ?>
                    		</div>
						</div>

						<div class="form-group">
							<div class="contacttooltips">
								<label class="col-md-4 control-label">Confirm Email</label>
								<input type="email" class="form-control" name="email_confirmation">
								<!-- Errors -->    		
	                    		<?php if (isset($errors['email_confirmation'])) : ?>
	                    		 <label class="error"><?php echo $errors['email_confirmation']; ?></label>
	                    		<?php endif ?>
                    		</div>
                    	</div>

						<div class="form-group">
							<div class="contacttooltips">
								<label class="col-md-4 control-label">Password</label>
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
									Register
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
        name: {
          required: true,
          minlength: 2,
          maxlength: 50
        },
        email: {
            required: true,
            email: true
        },
        email_confirmation: {
        	required: true,
        	equalTo: "#email" // input id #email
        },
       	password: {
        	required: true,
        	regex: /^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%^&*()]{8,}$/
        },
        password_confirmation: {
        	required: true,
        	equalTo: "#password" // Requires id="password"
        }
    },
    messages: {
        name: {
            required: "A name is required",
            minlength: "A name must have 2 or more characters",
            maxlength: "A name must have 50 or less characters"
        },
        email: {
            required: "An email address is required",
            email: "A valid email address is required"
        },
        email_confirmation: {
        	required: "An email confirmation is required",
        	equalTo: "The email confirmation does not match"
        },
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
