<?php
include 'database.php'; 
    

$fname = $_POST['fname'];
 $lname = $_POST['lname'];
$email = $_POST['email']; 
$img=$_FILES['image']['name']; 


$query = "UPDATE registration set  fname='" . $_POST['fname'] . "', lname='" . $_POST['lname'] . "', email='" . $_POST['email'] . "', image='" . $img . "' WHERE id='" . $_POST['id'] . "'"; 

$res = $conn->query($query); 
if($res) {
echo json_encode($res);
} 

 
?>