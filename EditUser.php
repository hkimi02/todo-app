<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./style/style.css">
    <title>edit your info</title>
</head>
<?php 
session_start();
    require_once "./db_connect.php";
    $req=$db->prepare("SELECT * FROM users WHERE id=:id");
    $req->execute(['id'=>$_SESSION['id']]);
    $res=$req->fetch();
?>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg bg-light  mb-5">
    <div class="container-fluid">
    <a class="navbar-brand" href="./listTodo.php">TODO APP</a>
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
</ul>     
<div class="d-flex information">
        <p class="text-center">welcome <strong><?= $_SESSION['name'] ?></strong></p>
        <img class="avatar" src="<?= $_SESSION['avatar']; ?>" height="40px" width="40px"> 
    </div>
</div>
</nav>
    <div class="row">
    <div class="sign-up-user-form">
<form class="shadow-lg p-5 rounded col"  method="POST" action="./processUser.php">
<h1 class="text-center">edit user</h1>
<?php if(array_key_exists('msg',$_GET)): ?>
            <div class="alert alert-<?=$_GET['type']?>">
                <?= $_GET['msg']; ?>
            </div>
    <?php endif; ?>
<input type="hidden" name="id" value="<?= $res['id']; ?>">
<div class="mb-3">
    <label for="username" class="form-label"> <i class="bi bi-person-circle"></i></label>
    <input type="text" class="form-control" id="username" name="username"  value="<?= $res['username']; ?>">
</div>
<div class="mb-3">
    <label for="email" class="form-label"><i class="bi bi-envelope"></i></label>
    <input type="email" class="form-control" id="email" name="email" value="<?= $res['email']; ?>">
</div>
<div class="mb-3">
    <label for="password" class="form-label"> <i class="bi bi-lock-fill"></i></label>
    <input type="text" class="form-control" id="password" name="password">
</div>
    <button type="submit" class="btn btn-primary" name="edit">update</button>
</form>
    </div>
<div class="col">
    <img src="<?= $res['avatar'];?>" class="img-thumbnail logo change-pic">
    <form action="./processUser.php" method="POST"  enctype="multipart/form-data">
        <div class="mb-3">
            <label for="avatar" class="form-label"><i></i> : your current profile photo</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>
        <button type="submit" class="btn btn-primary" name="change">change</button>
    </form>
</div>
</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>