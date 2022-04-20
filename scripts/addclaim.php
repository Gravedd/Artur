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
    if (!isset($errors)) {
        $query = "INSERT INTO `claims` (`name`, `number`) VALUES ('$name', '$number')";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    }
    if (isset($result)) {
        $_SESSION['claim'] = true;
        header('Location: /index.php');
    } else {
        header('Location: /index.php');
    }
