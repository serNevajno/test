<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = clearData($_POST['name']);
    $email = clearData($_POST['email']);
    $addr = clearData($_POST['addr']);
    $phone = clearData($_POST['phone']);
    $personal = clearData($_POST['personal']);
    $message = clearData($_POST['message']);
    $max_size = $_POST['MAX_FILE_SIZE'];

    //================Настройки============= //
    $userfile = time() . "_" . greateNameImg(basename($_FILES['userfile']['name'])); // Имя файла исключая путь

    // Текст ошибок
    $error_by_file = "<span style=\"font: bold 15px tahoma; color: red;\">Невозможно загрузить файл в директорию. Возможно её не существует</span>";

    // Начало
    if (isset($_FILES["userfile"]) AND $_FILES["userfile"]["size"] < $max_size) {
        $myfile_size = $_FILES["userfile"]["size"];
        $error_flag = $_FILES["userfile"]["error"];
        // Если ошибок не было
        if ($error_flag == 0) {
            $DOCUMENT_ROOT = $_SERVER['DOCMENT_ROOT'];
            $upfile = getcwd() . "//userfile//" . $userfile;

            if ($_FILES['userfile']['tmp_name']) {
                //Если не удалось загрузить файл
                if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)) {
                    echo "$error_by_file";
                    exit;
                }
            } elseif ($myfile_size == 0) {
                echo "Пустая форма!";
            }
            // Если ошибок не было
        }

        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO feedback (date, name, email, addr, phone, personal, message, file) VALUES ('$date', '$name', '$email', '$addr', '$phone', '$personal', '$message', '$userfile')";
        mysql_query($sql) or die(mysql_error());
    }

    header("Location: /feedback.html");

    exit;
}
?>