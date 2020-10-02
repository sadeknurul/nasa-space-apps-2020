<?php include 'config.php';
date_default_timezone_set('Asia/Dhaka');
$date = date("Y-m-d h:i:sa");

if(isset($_POST['addTodb'])){
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$details = $_POST['details'];
	$latlong = $_POST['latlong'];

	mysqli_query($con,"INSERT into data(id,name,phone,details,lat_long,date_time) values(null,'$name','$phone','$details','$latlong','$date')");

	$msg = "Relief Request From ARRS:\n";
	$msg .= $name." has request ARRS: \nPhone: ";
	$msg .= $phone."\nDetails: ";
	$msg .= $details."\nLocation: ";
	$msg .= "https://goo.gl/maps/VdjZBrwJBJewe5SF9";

// use wordwrap() if lines are longer than 70 characters
	$msg = wordwrap($msg,70);

// send email
	mail("mhsabuj1@gmail.com","ARRS",$msg);
}

?>