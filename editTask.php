<?php
    session_start();

    $uId = $_SESSION['uId'] ?? null;
    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
    if(!$isLoggedIn)
    {
        header('Location:./index.php');
    }

    $db = new PDO('mysql:host=localhost;dbname=id20103228_todolist', 'id20103228_pikakses', '?EeJn0hiM5#YS)tY');

    $id = $_GET['id'] ?? null;
    if($id !== null && is_numeric($id))
    {
        $stmt = $db->query("SELECT * FROM task WHERE id = '$id' AND user_id = '$uId'");
        $data = $stmt->fetch();
    }
    else
    {
        header('Location:./list.php');
    }

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

    if($title !== null)
    {
        $db->query("UPDATE `task` SET `title` = '$title', `description` = '$description', `status` = '$status' WHERE id = '$id' AND user_id = '$uId'");
        header('Location: ./list.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj</title>
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
            <form action="" method="post">
                <div class="col">
                    <label for="title" class="label form-label">Tytuł</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?= $data['title'] ?>">
                </div>
                <div class="col">
                    <label for="description" class="form-label">Opis</label>
                    <textarea class="form-control mb-3" name="description" id="description"><?= $data['description'] ?></textarea>
                </div>
                <div class="col">
                    <?php if($data['status'] == 0): ?>
                        <input type="checkbox" class="form-check-input" name="status" id="status">
                    <?php else: ?>
                        <input type="checkbox" class="form-check-input" name="status" id="status" checked='checked'>
                    <?php endif; ?>
                        <label for="status" class="form-label">Czy Wykonano</label>
                </div>
                <button type="submit" class="btn btn-success mt-3">Zmień</button>
                <a href="list.php" class="btn btn-warning">Wróć</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>