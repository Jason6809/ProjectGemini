<?php
$operationDesc = array();
?>

<?php
//DELETE
if (isset($_GET["delete"])) {
	$id = $_GET["delete"];	

	$query = "DELETE FROM service WHERE service_id = '$id'";


	if (mysqli_query($connection, $query)) {

		$operationDesc[] = "Delete Successful. Please clear the form.";

	} else {

		$operationDesc[] = "Delete Error.";

	}
}
?>


<?php
//CHECK SUBMIT
if (isset($_POST["submit"])) {
	$name  = $_POST["name"];
	$price = $_POST["price"];
	$type  = $_POST["type"];

	$insertServiceQuery = "INSERT INTO service(service_name, service_price, service_type) VALUES('$name', '$price', '$type')";

	if (mysqli_query($connection, $insertServiceQuery)) {

		$operationDesc[] = "Submit Successful.";

	} else {

		$operationDesc[] = "Submit Error.";

	}
}
?>



<?php
if (isset($_GET["deletetype"])) {
	$id = $_GET["deletetype"];

	$query = "DELETE FROM service_type WHERE service_type_id ='$id'";

	if (mysqli_query($connection, $query)) {
		$operationDesc[] = "Delete Type Successful.";
	} else {
		$operationDesc[] = "Delete Type Failed.";
	}
}
?>


<?php
if (isset($_POST["submitType"])) {
	$type = $_POST["type"];

	$query = "INSERT INTO service_type(type_name) VALUES('$type')";

	if (mysqli_query($connection, $query)) {
		$operationDesc[] = "Create Type Successful.";
	} else {
		$operationDesc[] = "Create Type Failed.";
	}
}
?>