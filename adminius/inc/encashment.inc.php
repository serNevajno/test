<?if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = date("Y-m-d H:i:s");
    $sum = $_POST["sum"];
    $comment = $_POST["comment"];
    $region = $_POST["region"];
    $bal = cashbox($region);
    $balance = $bal - $sum;
    if ($bal>=$sum AND $sum>0) {
        mysql_query("INSERT INTO encashment (balance, sum, date, comment, region) VALUES ('$balance', '$sum', '$date', '$comment', '$region')");
    }
    header('Location: index.php?code=finance');
    exit;
}?>