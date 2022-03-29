<?php
    require_once ('../config/db.php');
    $login = $_POST['login'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
var_dump($query);
    if (!empty($user)) {
        $_SESSION['auth'] = true;
        header('Location: /admin.php');
    } else {
        echo 'не правильный логин/пароль';
        echo "<a href='/login.php'>Вернутся обратно</a>";
    }

