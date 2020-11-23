<?php
include "database.php";
$id = $_POST['id'];
$query="SELECT * from registration WHERE id = '" . $id . "'";
$result=$conn->query($query); 
$cust = $result -> fetch_array(MYSQLI_NUM);
//$cust = mysqli_fetch_array($result);
if($cust) {
echo json_encode($cust);
}  

?>