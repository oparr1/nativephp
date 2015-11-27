<?php
$metaTitle = "Login";
$metaDescription = "This is the Login page";
include('../partials/header.php');
?>

<?php 
require_once("$_SERVER[DOCUMENT_ROOT]app/autoload.php"); // include classes / functions

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

// define variables and initialize with empty values
$email = $password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Clean Input
	$email = clean_input('email');
	$password = clean_input('password');

	// Validation

	// Email Errors
	if (empty($email)) {
		$errors['email'] = "Email address field is required";
	}

    // Password Errors
    if (empty($password))
    {
        $errors['password'] = 'Password field is required';
    }

    if (empty($errors)) {

		try
		{
		    // Login credentials
		    $credentials = [
		        'email'    => $email,
		        'password' => $password,
		    ];

		    // remember
		    // $remember = isset($_POST['remember']) && $_POST['remember'] == 'on' ? true : false;

		    // Authenticate the user
		    if ($user = Sentinel::authenticate($credentials)) {
				header("location: /");
		    }
		    else {
		    // Error - session
		    $session->error('failed', 'Invalid email or password');
		    }
		}

		// Following is only needed if throttle is enabled
		catch (Cartalyst\Sentinel\Checkpoints\ThrottlingException $e)
		{
			echo "Too many login attempts, please wait and try again!"; // session message
		}
	}
}
	// Redirect if user is logged in to root
	if ($user = Sentinel::check()) {
		header("location: /");
	}
?>

<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col8">
            <section id="loginForm">
            	   <!-- Success/Error message on submit -->
                    <div id="message">
                        <?php
                        $session->success('success');
                        $session->error('failed');
                        ?>
                    </div>
					 <h3>Sign in with your email address</h3>
					 <hr />

					<form class="form-horizontal" role="form" method="POST" action="login" novalidate>

						<div class="form-group">
							<div class="contacttooltips">
								<label class="col-md-4 control-label">Email Address</label>
								<input type="email" class="form-control" name="email" value="<?php html($email); ?>">
								<!-- Errors -->    		
	                    		<?php if (isset($errors['email'])) : ?>
	                    		 <label class="error"><?php echo $errors['email']; ?></label>
	                    		<?php endif ?>
							</div>
						</div>

						<div class="form-group">
							<div class="contacttooltips">
								<label class="col-md-4 control-label">Password</label>
								<input type="password" class="form-control" name="password">
								<!-- Errors -->    		
	                    		<?php if (isset($errors['password'])) : ?>
	                    		 <label class="error"><?php echo $errors['password']; ?></label>
	                    		<?php endif ?>
							</div>
						</div>
						<!--
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>
						-->

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>
							</br>
								<p>Forgotten your password? Follow the link to <a class="btn btn-link" href="password">recover your password </a></p>
							</div>
						</div>
					</form>
            </section>
        </div>
    </div>
</div>

<?php include('../partials/footer.php'); ?>

<script>
$(".form-horizontal").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
        	required: true
        }
    },
    messages: {
        email: {
            required: "An email address is required",
            email: "A valid email address is required"
        },
        password: {
            required: "A password is required"
        }
    }
});
</script> 