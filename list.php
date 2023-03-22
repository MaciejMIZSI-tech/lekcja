<?php
    session_start();

    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
    if(!$isLoggedIn)
    {
        header("Location: ./index.php");
    }

    $uId = $_SESSION['uId'];

    $db = new PDO('mysql:host=localhost;dbname=id20103228_todolist', 'id20103228_pikakses', '?EeJn0hiM5#YS)tY');

    $stmt = $db->query("SELECT * FROM task WHERE user_id = '$uId' AND status = 1");
    $data = $stmt->fetchAll();

    $stmt2 = $db->query("SELECT * FROM task WHERE user_id = '$uId' AND status = 0");
    $notdone = $stmt2->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>To-do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="list.php">To-Do List</a>
            <a class="btn btn-success" href="addTask.php">Dodaj Zadanie</a>
            <a class="btn btn-danger" href="logout.php">Wyloguj</a>
        </div>
    </nav>
    <div class="container text-center">
        <?php foreach($data as $d): ?>
            <div class="row justify-content-center mt-4">
                <div class="col-9">
                    <ul class="list-group">          
                        <div class="fw-bold"><li class="list-group-item list-group-item-secondary rounded-top"> <?= $d['title'] ?></li></div>
                        <li class="list-group-item text-brake"> <?= $d['description'] ?></li>
                        <li class="list-group-item list-group-item-info">Wykonano</li>
                    </ul>
                    <a class="btn btn-danger mt-1 del" href="deleteTask.php?id=<?= $d['id'] ?>">Usuń</a>
                    <a class="btn btn-warning mt-1 del" href="editTask.php?id=<?= $d['id'] ?>">Edytuj</a>
                    <a class="btn btn-info mt-1 del" href="changeStatus.php?id=<?= $d['id'] ?>">Zmień Status</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach($notdone as $nd): ?>
            <div class="row justify-content-center mt-4">
                <div class="col-9">
                    <ul class="list-group">          
                        <div class="fw-bold"><li class="list-group-item list-group-item-secondary rounded-top"> <?= $nd['title'] ?></li></div>
                        <li class="list-group-item text-brake"> <?= $nd['description'] ?></li>
                        <li class="list-group-item list-group-item-danger">Nie wykonano</li>
                    </ul>
                    <a class="btn btn-danger mt-1 del" href="deleteTask.php?id=<?= $nd['id'] ?>">Usuń</a>
                    <a class="btn btn-warning mt-1 del" href="editTask.php?id=<?= $nd['id'] ?>">Edytuj</a>
                    <a class="btn btn-info mt-1 del" href="changeStatus.php?id=<?= $nd['id'] ?>">Zmień Status</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>