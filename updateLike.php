<?php

include './dbconn.php';

//echo "<pre>";
//print_r($_POST);
//DIE;

$is_like = $_POST['is_like'];
$ip = $_POST['ip'];

//$sql = "select * from camp where remote_address_ip = '$ipaddress'";  // where 
//$sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com')"; // insert
$sql = "UPDATE camp SET is_like='$is_like' WHERE remote_address_ip= '$ip' "; // update
$resultUpdate = $conn->query($sql);

//print_r($result);die;
$result = [];
if ($resultUpdate) {
    $result['status'] = "success";
} else {
    $result['status'] = "error";
}

echo json_encode($result);

//$ipdata = $result->fetch_assoc();
?>