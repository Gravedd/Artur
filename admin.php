<?php
require_once('config/db.php');
if (!$_SESSION['auth']) {
    exit('Вам сюда нельзя. <a href="login.php">Войти</a>');
}


if (isset($_POST['add_product'])) {
    $title = $_POST['title'] ?? "без названия";
    $desc = $_POST['desc'] ?? "без названия";
    $image = $_FILES['photo'] ?? die("Нет фотографии");

    $save_path = "/img/".$image['name'];
    move_uploaded_file($image["tmp_name"], __DIR__.$save_path);

    $query = "INSERT INTO `catalog` (`title`, `description`, `image`) VALUES ('$title', '$desc', '$save_path')";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    header('Location: /admin.php?success');
    die();
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
        <div class="admin-header">
            <h2>Админ-панель <a href="/scripts/logout.php">ВЫХОД</a></h2>
            <a href="/admin.php?products">Продукты</a>
            <a href="/admin.php?add_product">Добавить продукт</a>
            <a href="/admin.php?claims">Заявки</a>
        </div>
        <?php if(isset($_GET['products'])) { ?>
            <div class="admin-products-wrapper">
                <h3>Готовые предложения</h3>

                <?php foreach ($catalog as $product) { ?>
                    <div class="admin_product">
                        <div class="admin_product_id"><?= $product['id'] ?></div>
                        <div class="admin_product_title"><?= $product['title'] ?></div>
                        <div class="admin_product_desc"><?= $product['description'] ?></div>
                        <div class="admin_product_img">
                            <img height="50" src="<?= $product['image'] ?>">
                        </div>
                        <div class="admin_product_delete">
                            <a href="/scripts/deleteproduct.php?id=<?= $product['id'] ?>">Удалить</a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        <?php } ?>

        <?php if(isset($_GET['add_product'])) { ?>
            <form class="admin_add_product_form" method="post" action="" enctype="multipart/form-data">
                <h3>Добавить продукт</h3>
                <label>
                    <span>Название</span>
                    <input name="title" required>
                </label>
                <label>
                    <span>Описание</span>
                    <textarea name="desc" required></textarea>
                </label>
                <label>
                    <span>Фотография</span>
                    <input type="file" name="photo" required>
                </label>
                <label>
                    <input type="submit" name="add_product" value="Добавить" required>
                </label>
            </form>
        <?php } ?>



        <?php if(isset($_GET['claims'])) { ?>
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
                                <?
                                $query = "SELECT * FROM `catalog` WHERE `id` = ".$claim['product_id'];
                                $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                                $row = mysqli_fetch_assoc($result);
                                echo $row['title'] ?? "-";
                                ?>
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
        <?php } ?>


    </div>

    <?php include_once('components/footer.php')?>


</div>
</body>
</html>
