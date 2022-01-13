<?php

$username         = $_POST['username'];
$email            = $_POST['email'];
$password         = $_POST['password'];
$confirm_password = $_POST['confirm_password'];





if (!empty($username)  ||  !empty($email)  ||  !empty($password)  ||  !empty(confirm_password)  )
 {
	
   $host = "localhost";
   $dbusername = "root";
   $dbpassword = "";
   $dbname = "vampire";


   //Create connection
   $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname );

   if (mysqli_connect_error()){
      die('Connect Error ('. mysqli_connect_errno() .' ) '. mysqli_connect_error());
   }


else{
	$SELECT = "SELECT email From signup where email = ? Limit 1";
	$INSERT = "INSERT Into signup ( username, email , password , confirm_password ) values(?,?,?,?)";


	//Prepare Statement

	     $stmt = $conn->prepare($SELECT);
	     $stmt->bind_param("s", $email);
	     $stmt->execute();
	     $stmt->bind_result($email);
	     $stmt->store_result();
	     $rnum = $stmt->num_rows;


	     //checking username
	       if ($rnum==0) {
	       	$stmt->close();
	       	$stmt = $conn->prepare($INSERT);
	       	$stmt->bind_param("ssss", $username, $email, $password, $confirm_password);
	       	$stmt->execute();
	       	echo "<h2>New record inserted successfully</h2>"; header("Location: aftersignup.html");
           }
           else {
	       	echo "<h2>Someone already register using this email</h2>";  

	       }
	       $stmt->close();
	       $conn->close();
	    }

} else {
	echo "Also field are required";
	die();
}  
?>