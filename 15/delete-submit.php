<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>電子会議システム</title>
</head>
<body>
<?php
//セッションの開始
session_start();
if (empty($_SESSION)) {
    exit;
}
//文字コードをUTF-8にする
mb_internal_encoding('UTF-8');
//データベースに接続
$database = 'student_bbs'; //データベース名の設定
$con = mysqli_connect('localhost', 'student', 'student999')
or die('接続に失敗しました');
mysqli_select_db($con, $database)
or die($database . 'に接続できません');
mysqli_query($con, 'SET NAMES UTF8MB4')
or die('文字コードの設定に失敗しました');
//変更内容を取得(変更データの主キーも含む)
$id = $_SESSION["id"];
//データを削除
$sql = "DELETE FROM discussion WHERE id='$id'";
$query = mysqli_query($con, $sql) or die('$id データを削除できませんでした');
$message = 'データを削除しました<br>';

//セッションデータの破棄
$_SESSION = array();
session_destroy();
?>
<!-- 処理結果の表示 -->
<p>変更確認画面</p>
<table border="1">
    <p>削除完了画面</p>
    <p><?php echo $message; ?></p>
    <p><a href="title_enter.php">トップページへ</a></p>
</body>
</html>