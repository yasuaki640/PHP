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
if(empty($_SESSION)){exit;}
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
$name = htmlspecialchars($_SESSION["name"], ENT_QUOTES, "UTF-8");
$message = htmlspecialchars($_SESSION["name"], ENT_QUOTES, "UTF-8");
//データ変更
$sql = "UPDATE discussion SET name='$name',message='$message' WHERE id='$id'";
$query = mysqli_query($con, $sql) or die('fail update');
//更新後を表示
$sql = "SELECT * FROM discussion WHERE id='$id'";
$query = mysqli_query($con, $sql) or die('fail');
$data = mysqli_fetch_array($query) or die('fail array');
//セッションデータの破棄
$_SESSION = array();
session_destroy();
//データベースを切断
mysqli_close($con);
?>
<!-- 処理結果の表示 -->
<p>変更確認画面</p>
<table border="1">
    <tr>
        <td>名前</td>
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <td>更新日時</td>
        <td><?php echo $data["modified"]; ?></td>
    </tr>
    <tr>
        <td>メッセージ</td>
        <td><?php echo nl2br($message); ?></td>
    </tr>
</table>
<p><a href="bbs_enter.php">トップページへ</a></p>
</body>
</html>