<?php
    require_once ('../config/db.php');
    $name = trim($_POST['name']);
    $number = trim($_POST['number']);
    if(!(trim($name)) AND !(trim($number))) {
        exit('Сторка состоит только из пробелов');
    }
    if(!preg_match('~^(?:\+7|8)\d{10}$~', $number)) echo ("Телефон задан в неверном формате");
    $query = "INSERT INTO `claims` (`name`, `number`) VALUES ('$name', '$number')";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    if ($result == true) {
        header('Location: /index.php');
    } else {
        header('Location: /index.php?');
    }
