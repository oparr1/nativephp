<?php
// Access the vendor
require_once '/vendor/autoload.php';
// Access the namespace and shorten
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationExceptionInterface;
	
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

    // Define errors variable
    $errors = array();
    

    // Sanitize data
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    return $data;
    }

	// Model
    // Set Name to use for custom error message
    $validator  = v::key('name', v::string()->notEmpty()->noWhitespace()->length(2, 50)->setName('Name'))               
                   ->key('password', v::string()->notEmpty()->regex('/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#$%^&*()]{8,}$/')->setName('Password'))
                   ->key('password_confirmation', v::string()->notEmpty()->equals($password)->setName('Password confirmation'))
                   ->key('email', v::email()->notEmpty()->setName('Email'))
                   ->key('email_confirmation', v::notEmpty()->equals($email)->setName('Email confirmation'))
                   ->key('message', v::string()->notEmpty()->length(10, 500)->setName('Message'))
                   ->key('drop_down', v::string()->notEmpty())
                   ->key('radio', v::string()->notEmpty())
                   ->key('checkbox', v::arr()->notEmpty());

    // Controller
	try {
        $validator->assert($_POST);
    } 
    catch (NestedValidationExceptionInterface $exception) 
    {
    	// Custom Error Messages
        // To Specify a field e.g = name.length
        $errors = $exception->findMessages(array(
         // 'notEmpty' => '{{name}} field is required',
            'name.notEmpty' => '{{name}} field is required',
            'name.length' => '{{name}} must be between 2 and 50 characters',
            'password.notEmpty' => '{{name}} field is required',
            'regex' => '{{name}} must be 8 or more characters and have atleast one number and letter.',
            'password_confirmation.notEmpty' => '{{name}} field is required',
            'password_confirmation.equals' => '{{name}} does not match pass',
            'email.notEmpty' => '{{name}} field is required',
            'Email.email' => 'Must be a valid email address',
            'email_confirmation.notEmpty' => '{{name}} field is required',
            'email_confirmation.equals' => '{{name}} does not match email',
            'message.notEmpty' => '{{name}} field is required',         
            'message.length' => '{{name}} must be between 10 and 500 characters',
            'drop_down.notEmpty' => 'Please select an option from the lists dropdown'
        ));
    }

    // Multiple Checkbox requires $_POST so that it won't display error message before submit (validation summary and individually)
    if ($_POST && !$checkbox) 
    {
        $errors['checkbox'] = "Please choose one or more options from the list checkbox";           
    }

    // Radio requires $_POST so that it won't display error message before submit(validation summary and individually)
    if ($_POST && !$radio)
    {
        $errors['radio'] = "Please select an option from the list";
    }

    // If Validation is Successful
    if ($validator->validate($_POST)) {
        // Session - Success Message
        $errors = array("Success!");
        echo "Success";
    }

    // Find Array key name
    // var_dump($errors);

    // All Errors Together
    /*
    foreach($errors as $error) {
    	echo "<pre>".$error."</pre>";
    }
    */
?>

<!-- VIEW -->
<!DOCTYPE html>
<html>
<head>
	<meta chareset="utf-8">
	<title>Validation</title>
	</head>
<body>
<!-- removes .php if route removes it -->
<form id="form" action="form-respect" method="post" novalidate>

    <div class ="form-group">
        <label class="required">Name</label>
        <input class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $name; ?>"  >
        <?php if (isset($errors['name_notEmpty']) && isset($errors['name_length'])) { echo $errors['name_notEmpty']; echo $errors['name_length']; } ?>
    </div>

    <div class ="form-group">
        <label class="required">Password</label>
        <input id="password" class="form-control" type="password" name="password" placeholder="Password" >
        <?php if (isset($errors['password_notEmpty']) && isset($errors['regex'])) { echo $errors['password_notEmpty']; echo $errors['regex']; } ?>
    </div>

    <div class ="form-group">
        <label class="required">Confirm Password</label>
        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
        <?php if (isset($errors['password_confirmation_notEmpty']) && isset($errors['password_confirmation_equals'])) { echo $errors['password_confirmation_notEmpty']; echo $errors['password_confirmation_equals']; } ?>
    </div>

    <div class ="form-group">
        <label class="required">Email</label>
        <input id="email" class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
        <?php if (isset($errors['email_notEmpty']) && isset($errors['Email_email'])) { echo $errors['email_notEmpty']; echo $errors['Email_email']; } ?>
    </div>

    <div class ="form-group">
        <label class="required">Confirm Email</label>
        <input class="form-control" type="email" name="email_confirmation" placeholder="Confirm Email" value="<?php echo $email_confirmation; ?>">
        <?php if (isset($errors['email_confirmation_notEmpty']) && isset($errors['email_confirmation_equals'])) { echo $errors['email_confirmation_notEmpty']; echo $errors['email_confirmation_equals']; } ?>
    </div>

    <div class ="form-group">
        <label class="required">Message</label>
        <textarea class="form-control" name="message" rows="7" placeholder="Message"><?php echo $message; ?></textarea>
        <?php if (isset($errors['message_notEmpty']) && isset($errors['message_length'])) { echo $errors['message_notEmpty']; echo $errors['message_length']; } ?>
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
         <?php if (isset($errors['drop_down_notEmpty'])) { echo $errors['drop_down_notEmpty']; } ?>
    </div>

    <div class ="form-group">
        <label class="required">Option One</label>
        <input type="radio" name="radio" value="optionOne" <?php if ($radio == "optionOne") echo "checked"; ?>>
        <label class="required">Option Two</label>
        <input class="radioError" type="radio" name="radio" value="optionTwo" <?php if ($radio == "optionTwo") echo "checked"; ?>>
        <?php if(!empty($errors['radio'])){ echo $errors['radio']; } ?>  
    </div>

    <div class ="form-group">
        <label class="required">Option One</label>
          <input type="checkbox" name="checkbox[]" value="optionOne" <?php if(isset($_POST['checkbox'])) if (in_array("optionOne", $_POST['checkbox'])) { echo "checked"; } ?>>
          <label class="required">Option Two</label>
          <input type="checkbox" name="checkbox[]" value="optionTwo" <?php if(isset($_POST['checkbox'])) if (in_array("optionTwo", $_POST['checkbox'])) { echo "checked"; } ?>>
          <label class="required">Option Three</label>
          <input type="checkbox" name="checkbox[]" value="optionThree" <?php if(isset($_POST['checkbox'])) if (in_array("optionThree", $_POST['checkbox'])) { echo "checked"; } ?>>
          <label class="required">Option Four</label>
          <input class="checkboxError" type="checkbox" name="checkbox[]" value="optionFour" <?php if(isset($_POST['checkbox'])) if (in_array("optionFour", $_POST['checkbox'])) { echo "checked"; } ?>>
            <?php if(!empty($errors['checkbox'])){ echo $errors['checkbox']; } ?>  
    </div>

    <input type="submit">	
</form>


</body>
</html>