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
//文字コードをUTF-8にする
mb_internal_encoding('UTF-8');
//削除データの主キーを取得
$id = $_SESSION["id"];
//データベースに接続
$database = 'student_bbs'; //データベース名の設定
$con = mysqli_connect('localhost', 'student', 'student999')
or die('接続に失敗しました');
mysqli_select_db($con, $database)
or die($database . 'に接続できません');
mysqli_query($con, 'SET NAMES UTF8MB4')
or die('文字コードの設定に失敗しました');
//削除するデータを取得
$sql = "SELECT * FROM discussion WHERE id='$id'";
$query = mysqli_query($con, $sql) or die('fail');
$data = mysqli_fetch_array($query) or die('fail array');
//編集用パスワードの確認
$passwd = htmlspecialchars($_POST["passwd"], ENT_QUOTES, "UTF-8");
if ($data["passwd"] != $passwd) {
    exit('編集用パスワードが違います。ブラウザの戻るボタンをクリックして前画面に戻り、パスワードを正しく入力してください。');
}
//データベースを切断
mysqli_close($con);
?>
<p>削除画面</p>
<!-- 変更データの確認フォーム -->
<form method="POST" action="delete-submit.php">
    <table border="1">
        <tr>
            <td>名前</td>
            <td><?php echo $data["name"]; ?></td>
        </tr>
        <tr>
            <td>メッセージ</td>
            <td><?php echo nl2br($data["message"]); ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="削除する">
            </td>
        </tr>
    </table>
</form>
</body>
</html>