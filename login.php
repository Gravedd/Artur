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
    <?php include_once('components/header.php')?>
  <div class="adminwrapper" align="center">
    <h2>Войти в админ-панель</h2>
    <div class="authwrapper">
      <form class="authform" method="post" action="/scripts/login.php">
        <input type="text" name="login" placeholder=" Ваш логин...">
        <input type="text" name="password" placeholder=" Ваш пароль...">
        <input type="submit" value="ВОЙТИ">
      </form>

    </div>

  </div>


    <?php include_once('components/footer.php')?>

</div>
</body>
</html>
