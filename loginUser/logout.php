<?php 
    session_start();
    session_destroy();
    unset($_SESSION['name']);
    header("location:loginPage.phtml?msg=you have been loged out&type=success");
?>