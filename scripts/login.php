<?php
    require_once ('../config/db.php');
    $login = $_POST['login'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
    if (!empty($user)) {
        $_SESSION['auth'] = true;
        header('Location: /admin.php');
    } else {
        echo 'Неправильный логин/пароль <br>';
        echo "<a href='/login.php'>Вернутся обратно</a>";
    }

