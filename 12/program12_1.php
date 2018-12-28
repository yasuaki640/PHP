<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
<?php
$database = 'student_db01';
$con = mysqli_connect('localhost', 'student', 'student999')
or die('接続に失敗しました');
echo 'MySQLへの接続に成功しました。';
mysqli_select_db($con, $database)
or die($database.'に接続できません');
echo 'データベース'.$database.'に接続しました<br>';
mysqli_query($con, 'SET NAMES UTF8MB4');
mysqli_query($con, 'INSERT INTO lang(number, Lang, score) VALUES (120101007, "英", 90)')
or die('データを挿入できませんでした');
echo 'データを挿入しました<br>';

if (mysqli_close($con)) {
    echo 'MySQLとの接続を切断しました<br>';
} else {
    echo 'MySQLとの切断に失敗しました<br>';
}
?>

</body>
</html>