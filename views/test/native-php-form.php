<?php

// define variables and initialize with empty values
$name = $password = $password_confirmation = $email = $email_confirmation = "";
$message = $dropDown = $radio = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize data
    // or htmlspecialchars() on echo
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    return $data;
    }

    // Check Browser View Source if htmlspecialchars works
    // Both included to prevent Undefined Error 
    $name = isset($_POST['name']) ? clean_input($_POST['name']) : "";
    $password = isset($_POST['password']) ? clean_input($_POST['password']) : "";
    $password_confirmation = isset($_POST['password_confirmation']) ? clean_input($_POST['password_confirmation']) : "";
    $email = isset($_POST['email']) ? clean_input($_POST['email']) : "";
    $email_confirmation = isset($_POST['email_confirmation']) ? clean_input($_POST['email_confirmation']) : "";
    $message = isset($_POST['message']) ? clean_input($_POST['message']) : "";
    $dropDown = isset($_POST['drop_down']) ? clean_input($_POST['drop_down']) : "";
    $radio = isset($_POST['radio']) ? clean_input($_POST['radio']) : "";
    $checkbox = isset($_POST['checkbox']) ? clean_input(implode(", ", $_POST['checkbox'])) : '';

    // Name
    if (empty($name))
    {
        $errors['name'] = "Name field is required";
    }
    else if (strlen($_POST["name"]) < 2) {
        $errors['name'] = "A name must have 2 or more characters";
    }
    else if(strlen($_POST["name"]) > 50) {
        $errors['name'] = "A name must have 50 or less characters";
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

    // Email
    if (empty($email))
    {
        $errors['email'] = "Email field is required";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = "A valid email address is required";
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

    // Message
    if(empty($message))
    {
        $errors['message'] = "Message field is required";
    }
    else if (strlen($message) < 10)
    {
        $errors['message'] = "A message must have 10 or more characters";
    }
    else if (strlen($message) > 500)
    {
        $errors['message'] = "A message must have 500 or less characters";
    }

    // DropDown
    if(empty($dropDown))
    {
        $errors['drop_down'] = "Please select an option from the list";
    }
    // DropDown - only accept these values - OR STATEMENT ||
    else if(!$dropDown == "optionOne" || !$dropDown == "optionTwo" || !$dropDown == "optionThree" || !$dropDown == "optionFour") 
    {
        $errors['drop_down'] = "Please select an option from the list";
    }

    // Radio
    if(empty($radio))
    {
        $errors['radio'] = "Please choose one or multiple options from the list";
    }
    // Radio - only accept these values
    else if(!$radio == "optionOne" || !$radio == "optionTwo") 
    {
        $errors['radio'] = "Please choose one or multiple options from the list";
    }

    // Multiple Checkboxes
    if(empty($checkbox))
    {
        $errors['checkbox'] = "Please select an option from the list";
    }

    // Send contact form with PHPMailer
    if (empty($errors)) {
        // Session Success
        echo "Success";
    }
}

// Validation Summary
/*
foreach($errors as $error) {
    echo "<pre>".$error."</pre>";
}
*/

?>

<!-- removes .php if route removes it -->
<form id="form" action="native-php-form" method="post" novalidate>
	<div class ="form-group">
		<label class="required">Name</label>
		<input class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $name; ?>">
        <?php if(isset($errors["name"])) echo $errors['name']; ?>
	</div>
	<div class ="form-group">
		<label class="required">Password</label>
		<input id="password" class="form-control" type="password" name="password" placeholder="Password" >
        <?php if(isset($errors["password"])) echo $errors["password"]; ?>
	</div>

	<div class ="form-group">
		<label class="required">Confirm Password</label>
		<input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
        <?php if(isset($errors["password_confirmation"])) echo $errors["password_confirmation"]; ?>
	</div>

	<div class ="form-group">
		<label class="required">Email</label>
		<input id="email" class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
        <?php if(isset($errors["email"])) echo $errors["email"]; ?>
	</div>

	<div class ="form-group">
		<label class="required">Confirm Email</label>
		<input class="form-control" type="email" name="email_confirmation" placeholder="Confirm Email">
        <?php if(isset($errors["email_confirmation"])) echo $errors["email_confirmation"]; ?>
	</div>

	<div class ="form-group">
		<label class="required">Message</label>
		<textarea class="form-control" name="message" rows="7" placeholder="Message"><?php echo $message; ?></textarea>
        <?php if(isset($errors["message"])) echo $errors["message"]; ?>
	</div>

	<div class ="form-group">
		<label class="required">DropDown List</label>
		<select class="form-control" name="drop_down">
			<option value="">Select an option</option>
			<option value="optionOne" <?php if ($dropDown == "optionOne") echo 'selected="selected"'; ?>>Option One</option>
			<option value="optionTwo" <?php if ($dropDown == "optionTwo") echo 'selected="selected"'; ?>>Option Two</option>
			<option value="optionThree" <?php if ($dropDown == "optionThree") echo 'selected="selected"'; ?>>Option Three</option>
			<option value="optionFour" <?php if ($dropDown == "optionFour") echo 'selected="selected"'; ?>>Option Four</option>
         </select>
         <?php if(isset($errors["drop_down"])) echo $errors["drop_down"]; ?>
	</div>

	<div class ="form-group">
		<label class="required">Option One</label>
		<input type="radio" name="radio" value="optionOne" <?php if ($radio == "optionOne") echo "checked"; ?>>
		<label class="required">Option Two</label>
		<input class="radioError" type="radio" name="radio" value="optionTwo" <?php if ($radio == "optionTwo") echo "checked"; ?>>
        <?php if(isset($errors["radio"])) echo $errors["radio"]; ?>
	</div>

	<div class ="form-group">
    	  <label>Option One</label>
    	  <input type="checkbox" name="checkbox[]" value="optionOne" <?php if(isset($_POST['checkbox'])) if (in_array("optionOne", $_POST['checkbox'])) { echo "checked"; } ?>>
    	  <label>Option Two</label>
		  <input type="checkbox" name="checkbox[]" value="optionTwo" <?php if(isset($_POST['checkbox'])) if (in_array("optionTwo", $_POST['checkbox'])) { echo "checked"; } ?>>
		  <label>Option Three</label>
		  <input type="checkbox" name="checkbox[]" value="optionThree" <?php if(isset($_POST['checkbox'])) if (in_array("optionThree", $_POST['checkbox'])) { echo "checked"; } ?>>
		  <label>Option Four</label>
		  <input class="checkboxError" type="checkbox" name="checkbox[]" value="optionFour" <?php if(isset($_POST['checkbox'])) if (in_array("optionFour", $_POST['checkbox'])) { echo "checked"; } ?>>
          <?php if(isset($errors["checkbox"])) echo $errors["checkbox"]; ?>
	</div>

	<div class="form-group">
        <button type="submit">Submit</button>
    </div>
</form>

<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- placeholder for browsers incompatible with HTML5 -->
<script src="content/js/placeholder.js"></script>

<!-- JQuery Validation -->
<script src="content/js/jquery.validate.min.js"></script>

<script>
	// Add a Regex for password 
   $.validator.addMethod("regex", function(value, element, regexpr) {          
     return regexpr.test(value);
   }, "Password must be 8 or more characters and have atleast one number and letter."); 

$("#frm").validate({
    rules: {
        name: {
          required: true,
          minlength: 2,
          maxlength: 50
        },
        password: {
        	required: true,
        	regex: /^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%^&*()]{8,}$/
        },
        password_confirmation: {
        	required: true,
        	equalTo: "#password" // Requires id="password"
        },
        email: {
            required: true,
            email: true
        },
        email_confirmation: {
        	required: true,
        	equalTo: "#email"
        },
        message: {
            required: true,
            minlength: 10,
            maxlength: 500
        },
        drop_down: {
        	required: true
        },
        radio: {
        	required: true
        },
        checkbox: {
        	required: true
        }
    },
    messages: {
        name: {
            required: "A name is required",
            minlength: "A name must have 2 or more characters",
            maxlength: "A name must have 50 or less characters"
        },
        password: {
        	required: "A password is required"
        },
        password_confirmation: {
        	required: "A password confirmation is required",
        	equalTo: "The password confirmation does not match"
        },
        email: {
            required: "An email address is required",
            email: "A valid email address is required"
        },
        email_confirmation: {
        	required: "An email confirmation is required",
        	equalTo: "The email confirmation does not match"
        },
        message: {
            required: "A message is required",
            minlength: "A message must have 10 or more characters",
            maxlength: "A message must have 500 or less characters"
        },
        drop_down: {
        	required: "Please select an option from the list"
        },
        radio: {
        	required: "Please select an option from the list"
        },
        checkbox: {
        	required: "Please choose one or multiple options from the list"
        }
    },
    // For those pesky radio button / checkboxes errors
    errorPlacement: function(error, element) {
	    if (element.attr("type") == "radio") {
	        error.insertAfter(".radioError");
	    } 
	    else if (element.attr("type") == "checkbox") {
	    	error.insertAfter(".checkboxError");
	    }
	    else {
	        error.insertAfter(element);
	    }
	}
});
</script>