<?php include 'database.php'; 
// validation
// define variables and set to empty values
$fname = $lname = $email = $password = $img = $fnameErr = $lnameErr = $emailErr = $pnameErr = "";

if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["fname"])) {
   
   if (empty($_POST["fname"])) {
    $fnameErr = "First Name is required";
  } else { 
 
    $name = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $fnameErr = "Only letters and white space allowed"; 
	  return $fnameErr;
    }
  } 
  if (empty($_POST["lname"])) {
    $lnameErr = "Last Name is required";
  } else {
    $name = test_input($_POST["lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $lnameErr = "Only letters and white space allowed"; 
	   return $lnameErr;
    }
  }
    if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
	   return $emailErr;
    }
  }
    if (empty($_POST["password"])) {
    $pnameErr = "Password is required";
  } else {
    $name = test_input($_POST["password"]);
    // check if name only contains letters and whitespace and numbers
    if (!preg_match("/^[a-zA-Z-'0-9 ]*$/",$name)) {
      $pnameErr = "Only letters and white space allowed"; 
	   return $pnameErr;
    }
  }  
  
 if (empty($fnameErr && $lnameErr && $emailErr && $pnameErr)) { 


	$fname=$_POST['fname']; 
	$lname=$_POST['lname']; 
	$email=$_POST['email'];  
	$password=password_hash($_POST['password'], PASSWORD_DEFAULT); 
	//$target_dir = "img";
    //$target_file = $target_dir . basename($_FILES["image"]["name"]); 
    //move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	$img=$_FILES['image']['name']; 
	 move_uploaded_file($_FILES["image"]["tmp_name"],
      "img/" . $_FILES["image"]["name"]);
   // move_uploaded_file($img,login/images/$img);


//To check user already exists or not
$sql="select email from registration where email='$email'"; 
$result=$conn->query($sql); 
$return=$result->num_rows; 

//if $return returns true value it means user's email already exists
if($return)
{ 

$msg=ucfirst($email)." is already exists choose another email"; 
 header('Location: http://localhost/login/registration.php?message='.$msg);
}
else
{
$query="insert into registration values('','$fname','$lname','$email','$password','$img')"; 
$conn->query($query); 
$conn->close();
$msg= "Registered successfully"; 
 header('Location: http://localhost/login/registration.php?message='.$msg);
}
}
}  
 
 


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} 

 if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["username"])) {
	 $user=$_POST['username']; 
	 $pass=$_POST['password']; 
	  if (empty ($user)) //if username field is empty echo below statement
    {
       echo "<script>alert('you must enter your unique username')</script>";
    }
    if (empty ($pass)) //if password 1 field is empty echo below statement
    {
        echo "<script>alert('you must enter your password')</script>";
    }
	if (isset($user)) { 
	$sql="select email , password from registration where email='$user'"; 
    $result=$conn->query($sql); 
	$obj = $result -> fetch_object(); 
	$hash = $obj->password; 
	$verify = password_verify($pass, $hash); 
	  if ($verify) { 
      
	   header('Location: http://localhost/login/home.php');
  } else { 
    $msg= "Incorrect username and password!!"; 
    header('Location: http://localhost/login/login.php?message='.$msg);
  } 
   
	
	} 
 } 
 
 
 
 



?>