<?php 
    require_once "./db_connect.php";
    extract($_POST);
    $req=$db->prepare('SELECT * FROM todos where title=:search');
    $req->execute(['search'=>$search]);
    $res=$req->fetch();
    if($req->rowCount()){
    header("location:listTodo.php?id_searched=".$res['id']);
    }
    else{
        header("location:listTodo.php?msg=todo not found !");
    }
?>