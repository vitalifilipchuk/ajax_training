<?php
    $errors = array();
    $data = array();

    $db_connection = new mysqli('localhost','root','','ajax_basic');
    if ($db_connection->connect_error) {
    	$errors['db'] = "Connection failed: " . $db_connection->connect_error;
    	$data['success'] = false;
    }
    $sql = "SELECT * FROM user_messages ORDER BY id DESC LIMIT 3";

    $rows = array();
    $result = $db_connection->query($sql);
    
        while($row = mysqli_fetch_array($result))
        {
            $rows[] = $row;
        }
        $data['success'] = true;
        $data['messages'] = $rows;
    
    
    echo json_encode($data);

?>