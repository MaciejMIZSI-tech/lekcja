<?php
    session_start();

    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
    if(!$isLoggedIn)
    {
        header("Location: ./index.php");
    }

    $db = new PDO('mysql:host=localhost;dbname=id20103228_todolist', 'id20103228_pikakses', '?EeJn0hiM5#YS)tY');
    $uId = $_SESSION['uId'];

    $id = $_GET['id'] ?? null;
    if($id !== null && is_numeric($id))
    {
        $stmt = $db->query("SELECT * FROM task WHERE id = '$id' AND user_id = '$uId'");
        $data = $stmt->fetch();
        if($data['status'] == 0)
        {
            $stmt = $db->query("UPDATE task SET `status` = 1 WHERE id = '$id' AND user_id = '$uId'");
        }
        else
        {
            $stmt = $db->query("UPDATE task SET `status` = 0 WHERE id = '$id' AND user_id = '$uId'");
        }
        header('Location:./list.php');
    }
    else
    {
        header('Location:./list.php');
    }
