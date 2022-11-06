<?php
 
 require_once "./db_connect.php";

     $id=$_GET['id'];
     $req0=$db->query("SELECT  * from todos where id=$id");
     $todo_check=$req0->fetch();

     $req=$db->prepare('UPDATE todos SET complete=:complete  WHERE id=:id');
     $req->execute([
         'id' =>$id,
         'complete'=>$todo_check['complete'] ? 0 : 1,
     ]); 
    
 
 
 include "./listTodo.php";

?>