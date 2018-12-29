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
$input = '5 or 5=5';
echo '検索内容は　' . $input . '<br>';
echo 'SQLのリクエストは　' . "SELECT ** FROM students WHERE id=$input" . '<br>';

//検索結果の表示(サニタイズ無し)
echo 'サニタイズなし<br>';
$query = mysqli_query($con, "SELECT * FROM students WHERE id=$input")
    or die('検索に失敗しました');
while ($data = mysqli_fetch_array($query)) {
    echo $data[0] . ' ' . $data[1] . ' ' .
        $data['name'] . ' ' . $data['score'] . '<br>';
}

//検索結果の表示(サニタイズあり)　数字以外の文字があると検索結果を表示しない
echo 'サニタイズあり<br>';
if (preg_match('/[^0-9]/', $input)) {
    print('数字以外は入力しないでください<br>');
} else {
    $query = mysqli_query($con, "SELECT * FROM students WHERE id=$input")
        or die('検索に失敗しました');

    while ($data = mysqli_fetch_array($query)) {
        echo $data[0] . ' ' . $data[1] . ' ' .
            $data['name'] . ' ' . $data['score'] . '<br>';
    }
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