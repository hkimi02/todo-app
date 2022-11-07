<?php session_start(); ?>
<?php
 if(!isset($_SESSION['name'])){
    header('location:loginUser/process.php?msg=you have to log in to access your account&class=danger');
 }
else{
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo app</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./style/style.css">
  </head>
 
<body>
    <div class="container">
    <nav class="navbar navbar-expand-lg bg-light  mb-5">
    <div class="container-fluid">
    <a class="navbar-brand" href="#">TODO APP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./loginUser/logout.php"><span class="material-symbols-outlined">
home
</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./loginUser/logout.php"><span class="material-symbols-outlined">
logout
</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./addtodo/"><span class="material-symbols-outlined">
add
</span></a>
        </li>
</ul>     <div class="d-flex information">
          <p class="text-center">welcome <strong><?= $_SESSION['name'] ?></strong></p>
          <img class="avatar" src="<?= $_SESSION['avatar']; ?>" height="40px" width="40px"> 
          </div>
        </div>
</div>
</nav>
        <h1 class="text-center">todo list</h1>
        <form action="listTodo.php" method="GET">
            <div class="input-group rounded">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" value=<?= isset($_GET['search'] ) ? $_GET['search'] : '' ?>>
                <button class="btn btn-primary" type="submit">
                    <span class="input-group-text border-0 btn btn-primary" id="search-addon">
                      <i class="bi bi-search"></i>
                    </span>
              </button>
          </div>
</form>
<br><br>
<?php if(array_key_exists('msg',$_GET)) :?>
        <div class="alert alert-success">
            <?=$_GET['msg']?>
        </div>
        <?php endif; ?>
<?php 
require_once "./db_connect.php";
if(array_key_exists('search',$_GET)){
    extract($_GET);
     $search_title='%'.$search.'%';
     $query=$db->prepare('SELECT * FROM todos where title like :search AND id_user=:id_user');
     $query->execute(['search'=>$search_title,
                      'id_user'=>$_SESSION['id'],
    ]);
     $todos=$query->fetchAll();
     if(!$todos){
        $todos='vide';
     }
}else{
$query=$db->prepare('SELECT * FROM todos where id_user=:id_user');
$query->execute(['id_user'=>$_SESSION['id']]);
$todos=$query->fetchAll();
}?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <?php if($todos=='vide') : ?>
  <tbody >
     <tr>
        <td>
           Not found !
        </td>
     </tr>
 </tbody>
 <?php else : ?>
  <tbody>
<?php
 foreach($todos as $todo){
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $todo['title']; ?> details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      description : <?php echo $todo['description']; ?><br>
      due date : <?php echo $todo['due_date']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <tr>
      <th scope="row">
         <form action="./checktodo.php" method="GET">
          <input type="hidden" name="id" value=<?=$todo['id']?>>
          <input  type="checkbox"  onChange="this.form.submit()" <?php echo $todo['complete'] ?  'checked' : ''?>>
        </form>
      </th>
      <td class="<?php echo $todo['complete'] ?  'text-decoration-line-through' : ''?>"><?php echo $todo['title'] ?></td>
    <td>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-info"></i></button>
        <a href="deletetodo.php?delete=<?= $todo['id']?>"><button class="btn btn-danger" onclick="return confirm('do you want delete this !! ')"><i class="bi bi-trash3-fill"></i></button></a>
        <a href="./addtodo/index.php?edit=<?= $todo['id']?>"><button class="btn btn-warning"><i class="bi bi-pen"></i></button></a>
    </td>
    </tr>
<?php
}
?>
  </tbody>
  <?php endif; ?>
</table>
</div>
<script src="./script/script.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>