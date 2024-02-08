<?php
$loginError="false";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $email = $_POST['login-email'];
    $pass = $_POST['login-pass'];
    
   
    // Check whether this email exists
    $existSql = "select * from `users` where user_email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
       $row = mysqli_fetch_assoc($result);
       if (password_verify($pass, $row['user_pass'])) {
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['sno'] = $row['sno'];
          $_SESSION['user_email']=$email;
          header("Location: /social-dairy/explore.php?logins=true");
         }
        else{
           header("Location: /social-dairy/login.php?logins=false");
         }
         
      }
   }  
        
  
  
   
?>
