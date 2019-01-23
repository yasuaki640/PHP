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
if (empty($_SESSION)) {exit;}
//データベースに接続
$database = 'student_bbs'; //データベース名の設定
$con = mysqli_connect('localhost', 'student', 'student999')
or die('接続に失敗しました');
mysqli_select_db($con, $database)
or die($database . 'に接続できません');
mysqli_query($con, 'SET NAMES UTF8MB4')
or die('文字コードの設定に失敗しました');

//入力内容の取得($_SESSIONから)
$name = htmlspecialchars($_SESSION["name"], ENT_QUOTES, "UTF-8");
$passwd = htmlspecialchars($_SESSION["passwd"], ENT_QUOTES, "UTF-8");
$message = htmlspecialchars($_SESSION["message"], ENT_QUOTES, "UTF-8");

//データの追加 各変数は文字列として扱う
$sql = "INSERT INTO discussion(name, message, passwd) VALUES ('$name', '$message', '$passwd')";
$query = mysqli_query($con,$sql) or die('fail');

//セッションデータの破棄
$_SESSION = array();
session_destroy();
//データベースを切断
mysqli_close($con);
?>

<!-- 処理結果の表示 -->
<p>追加完了画面</p>
<table border="1">
    <tr>
        <td>名前</td>
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <td>メッセージ</td>
        <td><?php echo nl2br($message); ?></td>
    </tr>
    <tr>
        <td>パスワード</td>
        <td><?php echo $passwd; ?></td>
    </tr>
</table>
<p><a href="bbs_enter.php">トップページへ</a></p>
</body>
</html>