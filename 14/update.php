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
//変更するデータの主キーを取得
if (!isset($_GET["id"])) {
    exit;
} else {
    $id = $_GET["id"];
    $_SESSION["id"] = $id;
}
//データベースに接続
$database = 'student_bbs'; //データベース名の設定
$con = mysqli_connect('localhost', 'student', 'student999')
or die('接続に失敗しました');
mysqli_select_db($con, $database)
or die($database . 'に接続できません');
mysqli_query($con, 'SET NAMES UTF8MB4')
or die('文字コードの設定に失敗しました');
//変更するデータを取得
$sql = "SELECT * FROM discussion WHERE (id='$id')";
$query = mysqli_query($con, $sql) or die('fail');
$data = mysqli_fetch_array($query);
//データベースを切断
mysqli_close($con);
?>

<p>編集画面</p>
<form method="POST" action="update-confirm.php">
    <table border="1">
        <tr>
            <td>名前</td>
            <td>
                <input type="text" name="name" size="30" value="<?php echo $data["name"]; ?>">
            </td>
        </tr>
        <tr>
            <td>メッセージ</td>
            <td>
            <textarea rows="8" cols="50" name="message">
                <?php echo $data["message"]; ?>
            </textarea>
            </td>
        </tr>
        <tr>
            <td>編集用パスワード</td>
            <td>
                <input type="text" name="passwd" size="4">
            </td>
        </tr>
    </table>
</form>
</body>
</html>