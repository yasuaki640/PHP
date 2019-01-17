<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>電子会議システム</title>
</head>
<body>
<?php
//表示するデータの主キーを取得
if (!isset($_GET["id"])) {
    exit;
} else {
    $id = $_GET["id"];
}
//データベースに接続
$database = 'student_bbs'; //データベース名の設定
$con = mysqli_connect('localhost', 'student', 'student999')
or die('接続に失敗しました');
mysqli_select_db($con, $database)
or die($database . 'に接続できません');
mysqli_query($con, 'SET NAMES UTF8MB4')
or die('文字コードの設定に失敗しました');
//データの取得(1件のみ)
$sql = "SELECT * FROM discussion WHERE (id='$id')";
$query = mysqli_query($con, $sql) or die('fail');
$data = mysqli_fetch_array($query);
//データベースを切断
mysqli_close($con);
?>

<p>詳細表示画面</p>
<!-- データの表示 -->
<table border="1">
    <tr>
        <td>名前</td>
        <td><?php echo $data["name"]; ?></td>
    </tr>
    <tr>
        <td>更新日時</td>
        <td><?php echo $data["modified"]; ?></td>
    </tr>
    <tr>
        <td>メッセージ</td>
        <td><?php echo $data["message"]; ?></td>
    </tr>
</table>
</body>
</html>