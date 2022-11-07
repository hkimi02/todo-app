<?php 
    session_start();
    session_destroy();
    unset($_SESSION['name']);
    header("location:process.php?msg=you have been loged out&class=success");
?>