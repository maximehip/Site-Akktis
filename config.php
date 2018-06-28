<?php
	$host = "localhost";
	$userdb = "maxime";
	$password = "1234m";

	$connection = new mysqli($host, $userdb, $password);

	if ($connection->connect_error) {
		die("Error database connection: " . $connection->connect_error);
	}

function Close_connection($connection) {
	$connection->close();
}
?>