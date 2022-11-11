<?php 
session_start();
require_once "../db_connect.php";
if(isset($_POST['submit'])){
    extract($_POST);
    if(empty($email)){
        header("location:process.php?msg=please enter your email&class=danger");
        exit;
    }
    else if($password==""){
        header("location:process.php?msg=please enter your password&class=danger");
        exit;
    }
    $req=$db->prepare("SELECT * from users where email=:email");
    $req->execute(['email'=>$email]);
    if(!$req->rowCount()){
        header("location:process.php?msg=please enter an exciting email&class=danger");
        exit;
    }
    $res=$req->fetch();
    if(md5($password)!=$res['password']){
        header("location:process.php?msg=verify your password&class=danger");
        exit;
    }else{
    $_SESSION['name']=$res['username'];
    $_SESSION['avatar']=$res['avatar'];
    $_SESSION['id']=$res['id'];
    header("location:../listTodo.php");
    }
}
include "./loginPage.phtml";
?>