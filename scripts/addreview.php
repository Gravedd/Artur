<?php
    require_once ('../config/db.php');
    $name = trim($_POST['reviewname']);
    $comment = trim($_POST['reviewtext']);
    //проверка
    // Проверка на пробелы
    if(!(trim($name)) AND !(trim($comment))) {
        exit('Сторка состоит только из пробелов');
    }
    $query = "INSERT INTO `comments` (`name`, `comment`) VALUES ('$name', '$comment')";

    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    if ($result == true) {
        header('Location: /index.php');
    } else {
        header('Location: /index.php?');
    }
