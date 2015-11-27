<!DOCTYPE html>
<html>
<body>

<?php
// Use require_once for DB
require_once('config/database.php');
// Call the Function
$conn = pdoConnected();
$conn->exec("set names utf8");

// PDO QUERY
$statement = $conn->prepare("SELECT firstName, lastName, addressOne, addressTwo, city, region, postCode, phoneNumber 
                             FROM Address 
                             WHERE ID = ?");
$statement->bindValue(1, $ID); // ?
$ID = 3;
$statement->execute();

$row = $statement->fetch(PDO::FETCH_ASSOC);

// Define Variables outside of the loop
$firstName = $row['firstName'];
$lastName = $row['lastName'];
$addressOne = $row['addressOne'];
$addressTwo = $row['addressTwo'];
$city = $row['city'];
$region = $row['region'];
$postCode = $row['postCode'];
$phoneNumber = $row['phoneNumber'];

$errors = array();

// Escape output safely - only use on echo / OUTPUT
function html($data) {
	$data = htmlspecialchars($data, ENT_QUOTES); // <>
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Clean input before post
	function clean_input($data, $default = NULL) {
		// trim(); // no whitespaces
		// stripslashes(); // strip slashes \\\\
		// strip_tags(); // <p></p> only if you dont want html tags

		// return isset and sanitized POST
	    return isset($_POST[$data]) ? stripslashes(trim($_POST[$data])) : $default;
	}

	$firstName = clean_input('firstName'); // isset($_POST['firstName']) && !empty($_POST['firstName]) ? $_POST['firstName']) : "";
	$lastName = clean_input('lastName');
	$addressOne = clean_input('addressOne');  
	$addressTwo = clean_input('addressTwo');
	$city = clean_input('city'); 
	$region = clean_input('region');
	$postCode = clean_input('postCode'); 
	$phoneNumber = clean_input('phoneNumber'); 

	// Error Validation Here

if (empty($errors)) {
	// Update the Address table 'TABLE NAME', SET'column names', ? 'numbered bindValue'
	$ID = 3;
	$statement = $conn->prepare("UPDATE Address SET firstName = ?, lastName = ?, addressOne = ?, addressTwo = ?, city = ?, region = ?, postCode = ?, phoneNumber = ? WHERE ID = ? ");
	$statement->bindValue(1, $firstName); // firstName = ?
	$statement->bindValue(2, $lastName); 
	$statement->bindValue(3, $addressOne); 
	$statement->bindValue(4, $addressTwo); 
	$statement->bindValue(5, $city); 
	$statement->bindValue(6, $region); 
	$statement->bindValue(7, $postCode); 
	$statement->bindValue(8, $phoneNumber);
	$statement->bindValue(9, $ID); // ID = ?
	$statement->execute();
	echo "Record updated successfully";
}

}

$conn = null;

?>

<form id="form" action="pdo-update" method="post" novalidate>
	 <div class="form-group">
		<label class="required">First Name</label>
		<input class="form-control" type="text" name="firstName" placeholder="First Name" value="<?php echo html($firstName); ?>">
	</div>
	 <div class="form-group">
		<label class="required">Last Name</label>
		<input class="form-control" type="text" name="lastName" placeholder="Last Name" value="<?php echo html($lastName); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Address Line 1</label>
	    <input class="form-control" type="text" name="addressOne" placeholder="Address Line 1" value="<?php echo html($addressOne); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Address Line 2</label>
	    <input class="form-control" type="text" name="addressTwo" placeholder="Address Line 2" value="<?php echo html($addressTwo); ?>">
	</div>
	<div class="form-group">
	    <label class="required">City</label>
	    <input class="form-control" type="text" name="city" placeholder="City" value="<?php echo html($city); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Region</label>
	    <input class="form-control" type="text" name="region" placeholder="Region" value="<?php echo html($region); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Post Code</label>
	    <input class="form-control" type="text" name="postCode" placeholder="Post Code" value="<?php echo html($postCode); ?>">
	</div>
	<div class="form-group">
	    <label class="required">Phone Number</label>
	    <input class="form-control" type="text" name="phoneNumber" placeholder="Phone Number" value="<?php echo html($phoneNumber); ?>">
	</div>
	<div class="form-group">
	    <div class="col-md-offset-2 col-md-10">
	        <button type="submit" value="Create" class="btn btn-default">Submit</button>
	    </div>
	</div>
</form>


</body>
</html> 