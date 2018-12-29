<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>サニタイズ例(正規表現)</title>
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

//フォームから常に成り立つ条件が入力されたと仮定
$name = "' or ''='";
echo '検索内容は　' . $name . '<br>';
$request = "SELECT * FROM students WHERE name='$name'";

//検索結果の表示(サニタイズ無し)
echo 'サニタイズなし<br>';
$query = mysqli_query($con, $request)
    or die('検索に失敗しました(サニタイズなし)');
while ($data = mysqli_fetch_array($query)) {
    echo $data[0] . ' ' . $data[1] . ' ' .
        $data['name'] . ' ' . $data['score'] . '<br>';
}

//検索結果の表示(サニタイズあり)
echo 'サニタイズあり<br>';
$request = mysqli_real_escape_string($con, $request);
echo 'SQLのリクエストは　' . $request . '<br>';
$query = mysqli_query($con, $request)
    or die('検索に失敗しました(サニタイズあり)');

while ($data = mysqli_fetch_array($query)) {
    echo $data[0] . ' ' . $data[1] . ' ' .
        $data['name'] . ' ' . $data['score'] . '<br>';
}


//MySQLとの切断
if (mysqli_close($con)) {
    echo 'MySQLとの接続を切断しました<br>';
} else {
    echo 'MySQLとの切断に失敗しました<br>';
}
?>

</body>
</html>