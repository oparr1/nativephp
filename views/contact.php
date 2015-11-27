<?php
$metaTitle = "Contact";
$metaDescription = "This is the Contact page";
include('partials/header.php');
?>
<?php
// Mail
require_once '../app/config/Mail.php';
// Access the vendor
require_once '../vendor/autoload.php';
// Session
require_once '../app/functions/session.php';
// Access the namespace and shorten
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationExceptionInterface;
    
    // Start Session
    $session = new Session();  

    // Check Browser View Source if htmlspecialchars works
    // Both included to prevent Undefined Error 
    $name = clean_input('name'); // isset($_POST['name']) && !empty($_POST['name]) ? $_POST['name']) : "";
    $email = clean_input('email');
    $message = clean_input('message');

    // Define errors variable
    $errors = array();

    // Escape output safely - only use on echo / OUTPUT
    function html($data) {
        $data = htmlspecialchars($data, ENT_QUOTES); // <>
        return $data;
    }

    // Sanitise and isset/empty data
    function clean_input($data, $default = NULL) {
        // Sanitise data
        $data = trim($data);
        $data = stripslashes($data);
        // return isse, not empty and POST
        return isset($_POST[$data]) ? $_POST[$data] : $default;
    }

    // Model
    // Set Name to use for custom error message
    $validator  = v::key('name', v::string()->notEmpty()->noWhitespace()->length(2, 50)->setName('Name'))               
                   ->key('email', v::email()->notEmpty()->setName('Email'))
                   ->key('message', v::string()->notEmpty()->length(10, 500)->setName('Message'));

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
            'email.notEmpty' => '{{name}} field is required',
            'Email.email' => 'Must be a valid email address',
            'message.notEmpty' => '{{name}} field is required',         
            'message.length' => '{{name}} must be between 10 and 500 characters'
        ));
    }

    // If Validation is Successful
    if ($validator->validate($_POST)) {

        // Send Contact message to us
        $mail->IsHTML(true);
        $mail->CharSet = "text/html; charset=UTF-8;";

        // HTML
        $contact_message = file_get_contents('../views/emails/html/contact.php');
        $contact_message = str_replace('{{ name }}', $name, $contact_message); // {{ name }} in views/emails/html/contact.php
        $contact_message = str_replace('{{ email }}', $email, $contact_message);
        $contact_message = str_replace('{{ message }}', $message, $contact_message);

        // Plain Text
        $contact_message_text = file_get_contents('../views/emails/text/contact.php');
        $contact_message_text = str_replace('{{ name }}', $name, $contact_message_text); // {{ name }} in views/emails/text/contact.php
        $contact_message_text = str_replace('{{ email }}', $email, $contact_message_text);
        $contact_message_text = str_replace('{{ message }}', $message, $contact_message_text);

        $mail->From = 'email';
        $mail->FromName = null; // Change to 'NAME';
        $mail->addAddress('email'); // To
 
        $mail->Subject = 'Contact Us';
        $mail->Body = $contact_message;
        $mail->AltBody = $contact_message_text;

        if(!$mail->send()) {
            // Session - Failed Message
            $session->error('failed', 'Failed to send message. Please try again.');
        } 
        else 
        {
            // Session - Success Message
            $session->success('success', 'Thank you for contacting us! We will get back to you shortly.');
        } 
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
<div id="mapcontainer">
    <div id="map-canvas">
    </div>
</div>
<div id="address">
    <div class="onepcssgrid-1200">
        <div class="onerow">
            <p><span>Address:</span>123 Fake Street, Town, City, Post Code, Phone Number</p>
        </div> <!-- Row Closing -->
    </div> <!-- 1200 Closing -->
</div>
<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col9">
            <section id="contact">
                <h3>Contact Us</h3>
                <!-- removes .php if route removes it -->
                <form id="contactForm" action="contact" method="post" novalidate>
                    <!-- Success/Error message on submit -->
                    <div id="message">
                        <?php         
                            $session->success('success');
                            $session->error('failed');
                        ?>
                    </div>
                    <div class ="form-group">
                        <div class="contacttooltips">
                            <label class="required">Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Name" value="<?php echo html($name); ?>"  >
                            <?php 
                                if (!empty($errors)) {
                                    if ($errors['name_notEmpty'] == true || $errors['name_length'] == true ) {
                                        echo '<label class="error">'.$errors['name_notEmpty'].$errors['name_length'].'</label>';
                                    }
                                }
                            ?>
                        </div>
                    </div>

                    <div class ="form-group">
                        <div class="contacttooltips">
                            <label class="required">Email</label>
                            <input id="email" class="form-control" type="text" name="email" placeholder="Email" value="<?php echo html($email); ?>">
                           <?php 
                                if (!empty($errors)) {
                                    if ($errors['email_notEmpty'] == true || $errors['Email_email'] == true ) {
                                        echo '<label class="error">'.$errors['email_notEmpty'].$errors['Email_email'].'</label>';
                                    }
                                }
                            ?>

                        </div>
                    </div>

                    <div class ="form-group">
                        <div class="contacttooltipstextarea">
                            <label class="required">Message</label>
                            <textarea class="form-control" name="message" rows="7" placeholder="Message"><?php echo html($message); ?></textarea>
                            <?php 
                                if (!empty($errors)) {
                                    if ($errors['message_notEmpty'] == true || $errors['message_length'] == true ) {
                                        echo '<label class="error">'.$errors['message_notEmpty'].$errors['message_length'].'</label>';
                                    }
                                }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                      <button type="submit">Submit</button>
                    </div>	
                </form>
            </section>
        </div>
    </div> <!-- Row Closing -->
</div> <!-- 1200 Closing -->

<!-- placeholder for browsers incompatible with HTML5 -->
<script src="/public/js/placeholder.js"></script>

<?php include('partials/footer.php'); ?>

<!-- Google Maps -->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    function initialize() {

        var myLatlng = new google.maps.LatLng(52.923073, -1.477864);
        var mapOptions = {
            zoom: 13, // The initial zoom level when your map loads (0-20)
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP // Set the type of Map
        }

        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng, // Position marker to coordinates
            map: map, // assign the market to our map variable
            title: 'Click to visit our company on Google Places' // Marker ALT Text
        });
        google.maps.event.addDomListener(window, 'resize', function () { map.setCenter(myLatlng); });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
    // Add a Regex for password 
   $.validator.addMethod("regex", function(value, element, regexpr) {          
     return regexpr.test(value);
   }, "Password must be 8 or more characters and have atleast one number and letter."); 

$("#contactForm").validate({
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
        message: {
            required: true,
            minlength: 10,
            maxlength: 500
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
        message: {
            required: "A message is required",
            minlength: "A message must have 10 or more characters",
            maxlength: "A message must have 500 or less characters"
        }
    }
});
</script> 