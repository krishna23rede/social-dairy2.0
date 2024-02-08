<?php
    $showError="false";
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
       include 'dbconnect.php';
       $user_email=$_POST['signup-email'];
       $pass=$_POST['signup-pass'];
       $cpass=$_POST['signup-cpass'];

          // Check whether this email exists    
           $existSql = "select * from `users` where user_email = '$user_email'";
           $result = mysqli_query($conn, $existSql);     
           $numRows = mysqli_num_rows($result);     
           if($numRows>0)
           {         
                $showError = "Email already in use";     
            }     
            else
            {         
                if($pass == $cpass)
                {
                    $hash = password_hash($pass, PASSWORD_DEFAULT);                 
                    $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ( '$user_email', '$hash', 
                    current_timestamp())";             
                    $result = mysqli_query($conn, $sql);                          
                    if($result)
                    {                 
                        $showAlert = true;                 
                        header("Location: /social-dairy/explore.php?signupsuccess=true");                 
                        exit();//script will not move further                               
                    }         
                }         
                else
                {             
                    header("Location: /social-dairy/login.php?signupsuccess=false&error=$showError");  
                    $showError = "Passwords do not match"; 
                }
            }
                header("Location: /social-dairy/login.php?signupsuccess=false&error=$showError");  
    } 
?>