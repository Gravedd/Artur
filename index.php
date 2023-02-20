<?php
    require_once ('config/db.php');

    $query = "SELECT * FROM `comments` ORDER BY `ID` DESC LIMIT 3";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    for ($rewiews = []; $row = mysqli_fetch_assoc($result); $rewiews[] = $row);

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
    <div class="claimwrapper">
        <div class="claim">
            <h2 id="claimform">Покупаете подержанный автомобиль?</h2>
            <div class="tag">Мы подберем для вас оптимальное предложение на рынке с гарантией технической и юридической чистоты</div><br><br>
            <? if (!isset($_SESSION['claim'])) { ?>
            <form class="claimform" method="post" action="/scripts/addclaim.php">
                <? if (isset($_SESSION['errors'])) { echo "<script>alert('". $_SESSION['errors']."')</script>"; unset($_SESSION['errors']); } ?>
                <input type="text" name="name" placeholder="Ваше имя...">
                <input type="tel" name="number" placeholder="Номер телефона...">
                <button type="submit">Подобрать авто</button>
            </form>
            <? } else { ?>
                <h3>Заявка была успешно отправлена!</h3>
            <? } ?>
        </div>
        <div class="claim carsbg"></div>
    </div>
    <section class="tosell">
        <h1 style="text-align: center;margin-bottom: 16px;font-size: 23pt;">Готовые предложения</h1>
        <div class="offers">
            <?php foreach ($catalog as $item) { ?>
                <div class="offer-wrapper">
                    <img src="<?= $item['image'] ?>" width="200">
                    <div class="offer-title"><?= $item['title'] ?></div>
                    <div class="description"><?= $item['description'] ?></div>
                    <form class="offer-claim" method="post" action="/scripts/addclaim.php">
                        <input type="text" name="name" placeholder="Ваше имя...">
                        <input type="tel" name="number" placeholder="Номер телефона...">
                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                        <button type="btn">Купить</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </section>
    <section class="reviews" id="reviews">
        <h1>Отзывы наших клиентов</h1>
        <div class="reviewswrapper">
            <?php foreach ($rewiews as $rewiew) { ?>
                <div class="reviewwrapper">
                    <h3><?php echo $rewiew['name'] ?></h3>
                    <div class="reviewtext"><?php echo $rewiew['comment'] ?></div>
                </div>
            <?php } ?>
        </div>
    </section>
    <section class="addreview">
        <div class="claim carsbg2">
        </div>
        <div class="claim" id="addreview">
            <h3>Добавить отзыв</h3><br>
            <form class="reviewform" action="/scripts/addreview.php" method="post">
                <input type="text" name="reviewname" placeholder="Ваше имя..." minlength="2" maxlength="32">
                <textarea name="reviewtext" placeholder="Ваш отзыв..." minlength="10" maxlength="430"></textarea>
                <button>Отправить отзыв</button>
            </form>
        </div>
    </section>
    <?php include_once('components/footer.php')?>


</div>
</body>
</html>
