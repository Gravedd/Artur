    <?php
    require_once('../config/db.php');

    $name = $_POST['name'];
    $number = $_POST['number'];
    if (strlen($number) == 11 OR strlen($number) == 12) {
        if ($name == '' or $number == '') {
            $_SESSION['errors'] = 'Сторка состоит только из пробелов';
            $errors = true;
        }
    } else {
        $_SESSION['errors'] = "Телефон задан в неверном формате";
        $errors = true;
    }

    $product_id = $_POST['product_id'];
    $product_id = intval($product_id) ? intval($product_id) : null;
    if (!isset($errors)) {
        $query = "INSERT INTO `claims` (`name`, `number`, `product_id`) VALUES ('$name', '$number', '$product_id')";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    }
    if (isset($result)) {
        $_SESSION['claim'] = true;
        header('Location: /thank_you.php');
    } else {
        header('Location: /index.php');
    }
