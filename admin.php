<?php
require_once('config/db.php');
if (!$_SESSION['auth']) {
    exit('Вам сюда нельзя. <a href="login.php">Войти</a>');
}
$query = "SELECT * FROM `claims`";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
for ($claims = []; $row = mysqli_fetch_assoc($result); $claims[] = $row) ;


$query = "SELECT * FROM `catalog`";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
for ($catalog = []; $row = mysqli_fetch_assoc($result); $catalog[] = $row);

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
    <div class="adminwrapper cabinet">
        <h2>Админ-панель <a href="/scripts/logout.php">ВЫХОД</a></h2>
        <table class="table_price">
            <caption>Заявки</caption>
            <tr>
                <th>Имя</th>
                <th colspan="2">Номер телефона</th>
                <th>Продукт</th>
            </tr>
            <?php
            foreach ($claims as $claim) {
                ?>
                <tr>
                    <td><?php echo $claim['name'] ?></td>
                    <td><?php echo $claim['number'] ?></td>
                    <td>
                        <?php if ($claim['product_id']) { ?>
                            <?= $catalog[$claim['product_id']]['title'] ?>
                        <?php } else {?>
                            -
                        <?php } ?>
                    </td>
                    <td><a href="/scripts/deleteclaim.php?id=<?php echo $claim['id']?>">Удалить заявку</a></td>
                </tr>
                <?php
            }
            ?>
        </table>


    </div>

    <?php include_once('components/footer.php')?>


</div>
</body>
</html>
