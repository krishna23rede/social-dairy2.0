<?php
    session_start();
    echo 'Logging you out please waittttttt.......rukh ja bhai itni kya ghai hai tujhe';
    session_destroy();
    header("Location: /social-dairy/explore.php");                 
?>