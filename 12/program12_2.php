<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>検索結果の出力</title>
</head>
<body>
<?php
$database = 'student_db01';
$con = mysqli_connect('localhost', 'student', 'student999')
    or die('接続に失敗しました');
echo 'MySQLへの接続に成功しました。<br>';
mysqli_select_db($con, $database)
    or die($database . 'に接続できません');
echo 'データベース' . $database . 'に接続しました<br>';
mysqli_query($con, 'SET NAMES UTF8MB4');

//検索結果の表示
$query = mysqli_query($con, 'SELECT * FROM students')
    or die('検索に失敗しました');
echo '<table border="1">';
while($data=mysqli_fetch_array($query))
{
    echo '<tr>';
    echo '<td>' . $data[0] . '</td>' .
        '<td>' . $data[1] . '</td>' .
        '<td>' . $data['name'] . '</td>' .
        '<td>' . $data['subjects'] . '</td>';
        echo '</tr>';
}
echo '</table>';

//MySQLとの切断
if (mysqli_close($con)) {
    echo 'MySQLとの接続を切断しました<br>';
} else {
    echo 'MySQLとの切断に失敗しました<br>';
}
?>

</body>
</html>