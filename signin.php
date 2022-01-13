<?php      

    $host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "vampire";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    } 
      

       $email = $_POST['email'];  
       $password = $_POST['password']; 

        //to prevent from mysqli injection  
        $email = stripcslashes($email);  
        $password = stripcslashes($password);  
        $email = mysqli_real_escape_string($con, $email);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "SELECT * FROM signin where email = '" . $email. "' and password = '" . $password. "' ";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            echo   header("Location: textarea.html");
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
?> 