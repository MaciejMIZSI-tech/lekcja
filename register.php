<?php
    session_start();

    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
    if($isLoggedIn)
    {
        header("Location: ./list.php");
    }

    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;

    $error = [];
    if($login !== null && $password !== null)
    {
        $db = new PDO('mysql:host=localhost;dbname=id20103228_todolist', 'id20103228_pikakses', '?EeJn0hiM5#YS)tY');

        $stmt = $db->query("SELECT * FROM user WHERE login='$login'");
        $user = $stmt->fetch();

        if(!$user) 
        {
            $db->query("INSERT INTO user VALUES(null, '$login', '$password')");
            header("Location: list.php");
        }
        else
        {
            $error[] = "Nazwa użytkownika już istnieje";
            //sus
        }
    }
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracaj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-6 ">
                <?php if(!empty($error)): ?>
                <p><?= implode('<br>', $error) ?></p>
                <?php endif; ?>
                <form class="p-1" action="./register.php" method="post">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" name="login" class="form-control" id="login" >
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Hasło</label>
                        <input type="password" name="password" class="form-control" id="password" >
                    </div>

                    <button type="submit" class="btn btn-success">Zarejestruj</button><br>
                    <a href="index.php" class="btn btn-warning mt-3">Wróć</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>