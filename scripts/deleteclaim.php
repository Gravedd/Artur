<?php
require_once ('../config/db.php');
if ($_SESSION['auth']) {
    $id = $_GET['id'];
    $query = "DELETE FROM `claims` WHERE `id` = $id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    header('Location: /admin.php');
} else {
    exit('Вам сюда нельзя. <a href="login.php">Войти</a>');
}


