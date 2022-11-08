<?php 
require_once "./db_connect.php";
if(array_key_exists('id_delete',$_GET)){
    $req=$db->prepare("DELETE from users where id=:id");
    $req->execute(['id'=>$_GET['id']]);
    session_start();
    session_destroy();
    unset($_SESSION['name']);
    header("location:./loginUser/process.php?msg=your account has been deleted&class=danger");
}

if(isset($_POST['edit'])){
    extract($_POST);
    $name_file= $_FILES['avatar']['name'];
    $type=pathinfo($name_file,PATHINFO_EXTENSION);
        $type_dispo=['png','jpg','jpeg','gif'];
        if(!in_array($type,$type_dispo)){
            header("location:EditUser.php?msg=extention invalid&type=danger");
            exit;
        }
        $size=$_FILES['avatar']['size'];
        if($size>999999999){
            header("location:EditUser.php?msg=image size too large&type=danger");
            exit;
        }
        $name_file=md5(mt_rand()).'.'.$type;
        
        if(!move_uploaded_file($_FILES['avatar']['tmp_name'],'./storage/'.$name_file)){
            header("location:EditUser.php?msg=image not uploaded&type=danger");
            exit;
        }
        $avatar='./storage/'.$name_file;
        $req=$db->prepare("UPDATE users SET username=:username,email=:email,password=:password,avatar=:avatar WHERE id=:id");
        $req->execute(
            ['username'=>$username,
            'email'=>$email,
            'password'=>$password,
            'avatar'=>$avatar,
            'id'=>$id
    ]);
    unset($_SESSION['name']);
    unset($_SESSION['avatar']);
    $_SESSION['name']=$username;
    $_SESSION['avatar']=$avatar;
    header("location:listTodo.php");
}
















?>