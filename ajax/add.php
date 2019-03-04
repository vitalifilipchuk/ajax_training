<?php
 $errors = array();
 $data = array();

 if (empty($_POST['name'])) {
    $errors['name'] = 'Name is required.';
 }
 if (empty($_POST['message'])) {
    $errors['message'] = 'Message can\'t be empty.';
 }

 if (!empty($errors)) {
        $data['errors']  = $errors;
        $data['success'] = false;
    } else {

        $db_connection = new mysqli('localhost','root','','ajax_basic');
        if ($db_connection->connect_error) {
        	$errors['db'] = "Connection failed: " . $db_connection->connect_error;
        	$data['success'] = false;
		}
		$sql = "INSERT INTO user_messages (username, message) VALUES ('". $_POST['name'] ."', '". $_POST['message'] ."')";

        if ($db_connection->query($sql) === TRUE) {
		    $data['success'] = true;
		    $data['message'] = "Successfully added!";
		} else {
		    $errors['db'] = "Error: " . $sql . "<br>" . $db_connection->error;
		    $data['errors']  = $errors;
		    $data['success'] = false;
		}
    }
echo json_encode($data);

?>