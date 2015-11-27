<?php 
    $metaTitle = "Password reset";
    $metaDescription = "This is the password reset page";
    include('../partials/header.php');
?>

<?php 
require_once("$_SERVER[DOCUMENT_ROOT]app/autoload.php"); // include classes / functions

use Cartalyst\Sentinel\Native\Facades\Sentinel;

// define variables and initialize with empty values
$email = $password = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Clean Input
	$email = clean_input('email');
	$password = clean_input('password');

	// Email Errors
	if (empty($email)) {
		$errors['email'] = "Email address field is required";
	}

	$credentials = [
    	'email' => $email,
	];

	// Check if input email exists
	$user = Sentinel::findByCredentials($credentials);

	// Validation success
	if (empty($errors)) {

		// Check if code exists/create
		// Calling repostory - no facade for native
		$reminder = Sentinel::getReminderRepository()->exists($user) ?: Sentinel::getReminderRepository()->create($user);

		// Get reset code
		$code = $reminder->code;

		// reset link
		$reset_link = "http://$_SERVER[HTTP_HOST]"."/auth/reset?id=".$user->id."&code=".$code;

		// Send message
        $mail->IsHTML(true);
        $mail->CharSet = "text/html; charset=UTF-8;";

        $mail->From = 'email';
        $mail->FromName = null; // Change to 'NAME';
        $mail->addAddress($email); // To
 
        $mail->Subject = 'Password Reset';
        $mail->Body = "Click <a href=\"{$reset_link}\">here</a> to reset your password";

        if(!$mail->send()) {
            // Session - Failed Message
            $session->error('failed', 'Failed to send message. Please try again.');
        } 
        else 
        {
            // Session - Success Message
            $session->success('success', 'A password reset link has been sent to your email address.');
        } 
	}
}
?>

<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col8">
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

					<form class="form-horizontal" role="form" method="POST" action="password" novalidate>

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
$(".form-horizontal").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
    },
    messages: {
        email: {
            required: "An email address is required",
            email: "A valid email address is required"
        }
    }
});
</script> 