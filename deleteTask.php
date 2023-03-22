<?php
    session_start();

    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
    if(!$isLoggedIn)
    {
        header("Location: ./index.php");
    }

    $db = new PDO('mysql:host=localhost;dbname=id20103228_todolist', 'id20103228_pikakses', '?EeJn0hiM5#YS)tY');

    $id = $_GET['id'] ?? null;
    $uId = $_SESSION['uId'] ?? null;

    if($id !== null)
    {
        $db->query("DELETE FROM task WHERE id = '$id' AND user_id = '$uId'");
        header('Location:./list.php');
    }