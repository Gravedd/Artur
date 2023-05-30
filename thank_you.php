<?php
session_start();
if (isset($_SESSION['auth'])) {
    header('Location: /admin.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Автоподбор</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">
    <?php include_once('components/header.php') ?>
    <div class="adminwrapper" align="center">
        <h2>Ваша заявка принята!</h2>
        <div>Если у Вас возникли вопросы, пожалуйста <a href="/feedback.php">свяжитесь с нами.</a></div>
        <div>Спасибо за ваше доверие!</div>
        <div><a href="/">На главную</a></div>
    </div>

    <?php include_once('components/footer.php') ?>

</div>
</body>
</html>
