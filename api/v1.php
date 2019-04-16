<?php

	// Content Type JSON
	header("Content-type: application/json");

	// Database connection
	$conn = new mysqli("localhost", "root", "", "phpvue");
	if ($conn->connect_error) {
		die("Database connection failed!");
	}
	$res = array('error' => false);


	// Read data from database
	$action = 'read';

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}

	if ($action == 'read') {
		$result = $conn->query("SELECT * FROM `users`");
		$users  = array();

		while ($row = $result->fetch_assoc()) {
			array_push($users, $row);
		}
		$res['users'] = $users;
	}


	// Insert data into database
	if ($action == 'create') {
		$username = $_POST['username'];
		$email    = $_POST['email'];
		$mobile   = $_POST['mobile'];

		$result = $conn->query("INSERT INTO `users` (`username`, `email`, `mobile`) VALUES('$username', '$email', '$mobile')");

		if ($result) {
			$res['message'] = "User added successfully";
		} else {
			$res['error']   = true;
			$res['message'] = "User insert failed!";
		}
	}


	// Update data

	if ($action == 'update') {
		$id       = $_POST['id'];
		$username = $_POST['username'];
		$email    = $_POST['email'];
		$mobile   = $_POST['mobile'];


		$result = $conn->query("UPDATE `users` SET `username`='$username', `email`='$email', `mobile`='$mobile' WHERE `id`='$id'");

		if ($result) {
			$res['message'] = "User updated successfully";
		} else {
			$res['error']   = true;
			$res['message'] = "User update failed!";
 		}
	}


	// Delete data

	if ($action == 'delete') {
		$id       = $_POST['id'];
		$username = $_POST['username'];
		$email    = $_POST['email'];
		$mobile   = $_POST['mobile'];

		$result = $conn->query("DELETE FROM `users` WHERE `id`='$id'");

		if ($result) {
			$res['message'] = "User delete success";
		} else {
			$res['error']   = true;
			$res['message'] = "User delete failed!";
		}
	}


	// Close database connection
	$conn->close();

	// print json encoded data
	echo json_encode($res);
	die();

?>