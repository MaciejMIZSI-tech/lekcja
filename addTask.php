<?php
    session_start();

    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
    if(!$isLoggedIn)
    {
        header("Location: ./index.php");
    }

    $db = new PDO('mysql:host=localhost;dbname=id20103228_todolist', 'id20103228_pikakses', '?EeJn0hiM5#YS)tY');

    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $status = $_POST['status'] ?? null;
    if($status !== null)
    {
        $status = 1;
    }
    else
    {
        $status = 0;
    }

    $uId = $_SESSION['uId'] ?? null;

    if ($title !== null && $uId !== null)
    {
        $db->query("INSERT INTO task VALUES (null, '$title', '$description', '$status', '$uId')");    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="list.php">To-Do List</a>
            <a class="btn btn-danger" href="logout.php">Wyloguj</a>
        </div>
    </nav>
    <div class="container text-center">
        <div class="row justify-content-center mt-4">
            <form action="addtask.php" method="post">
                <div class="col">
                    <label for="title" class="label form-label">Tytuł</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="col">
                    <label for="description" class="form-label">Opis</label>
                    <textarea name="description" id="description" class="form-control mb-3"></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3">Dodaj</button>
                <a href="list.php" class="btn btn-warning">Wróć</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>