<?php 
    require_once "./db_connect.php";
if(array_key_exists('delete',$_GET)){
    $req=$db->prepare('DELETE FROM todos WHERE id=:id');
    $req->execute(['id'=>$_GET['delete']]);
    header("location:listTodo.php?msg=delete with success");
}

?>