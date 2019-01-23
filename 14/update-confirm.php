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
//入力値の取得・空白削除
$name = htmlspecialchars(str_replace(" ", "", $_POST["name"]), ENT_QUOTES, "UTF-8");
$passwd = htmlspecialchars($_POST["passwd"], ENT_QUOTES, "UTF-8");
$message = htmlspecialchars($_POST["message"], ENT_QUOTES, "UTF-8");
//データベースに接続
$database = 'student_bbs'; //データベース名の設定
$con = mysqli_connect('localhost', 'student', 'student999')
or die('接続に失敗しました');
mysqli_select_db($con, $database)
or die($database . 'に接続できません');
mysqli_query($con, 'SET NAMES UTF8MB4')
or die('文字コードの設定に失敗しました');

//編集用パスワードの確認
$id = $_SESSION["id"];
$sql = "SELECT * FROM discussion WHERE (id-'$id')";
$query = mysqli_query($con, $sql) or die('fail');
$data = mysqli_fetch_array($query);
if ($data["passwd"] != $passwd) {
    exit('編集用パスワードが違います。ブラウザの戻るボタンをクリックして前画面に戻り、パスワードを正しく入力してください。');
}

// 変更内容をセッション変数に格納
$_SESSION["name"] = $name;
$_SESSION["message"] = $message;
//データベースを切断
mysqli_close($con);
?>
<p>変更確認画面</p>
<!-- 変更データの確認フォーム -->
<form method="POST" action="update-submit.php">
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
        <tr>
            <td colspan="2">
                <input type="submit" value="変更する">
            </td>
        </tr>
    </table>
</form>
</body>
</html>