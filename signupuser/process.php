<?php
require_once "../db_connect.php";
$error=[];
if(isset($_POST['submit'])){
    extract($_POST);
    if($username=="" || $email=="" || $password=="" || $password2==""){
        header("location:process.php?msg=all form feilds should be feild&type=danger");
        exit;
    }
    $req=$db->prepare('SELECT * FROM users where email=:email');
    $req->execute(['email'=>$email]);
    if($req->rowCount()){
        header("location:process.php?msg=enter a not excisting email&type=danger");
        exit;   
    }
    else{
        if(!strlen($_FILES['avatar']['name'])){
            header("location:process.php?msg=file required&type=danger");
            exit;
        }
    $name_file= $_FILES['avatar']['name'];
    $type=pathinfo($name_file,PATHINFO_EXTENSION);
        $type_dispo=['png','jpg','jpeg','gif'];
        if(!in_array($type,$type_dispo)){
            header("location:process.php?msg=extention invalid&type=danger");
            exit;
        }
        $size=$_FILES['avatar']['size'];
        if($size>999999999){
            header("location:process.php?msg=image size too large&type=danger");
            exit;
        }
        $name_file=md5(mt_rand()).'.'.$type;
        
        if(!move_uploaded_file($_FILES['avatar']['tmp_name'],'../storage/'.$name_file)){
            header("location:process.php?msg=image not uploaded&type=danger");
            exit;
        }
        $avatar='./storage/'.$name_file;
        if($password!=$password2){
            header("location:process.php?msg=passwords dont match&type=danger");
            exit;
        }
            $req=$db->prepare("INSERT INTO users (username,email,password,avatar) VALUES(:username,:email,:password,:file)");
            $req->execute(['username'=>$username,
                            'email'=>$email,
                            'password'=>$password,
                            'file'=>$avatar
        ]);
        header("location:process.php?msg=user saved you may now log in&type=success");  
    }
}
show:
include "./home.phtml";
?>