<?php
$con = mysqli_connect('localhost', 'root', '', 'photography');

if ($con) {
    // Connection Successful
} else {
    die("Connection Failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];

// Prepared statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO users (name, email, number) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $number);

$response = array();

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Thank you for submitting!';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $stmt->error;
}

$stmt->close();
$con->close();

echo json_encode($response);
?>
