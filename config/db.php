<?php
session_start();
$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
$user = 'root'; //имя пользователя, по умолчанию это root
$password = ''; //пароль, по умолчанию пустой
$db_name = 'bagauv'; //имя базы данных

//подключение к БД
$connection = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($connection));

