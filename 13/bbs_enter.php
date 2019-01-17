<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>電子会議システム</title>
</head>
<body>
<h1>電子会議システム</h1>
<!-- データ入力フォーム -->
<form method="POST" action="confirm.php">
    <table border="1">
        <tr>
            <td>名前</td>
            <td><input type="text" name="name" size="30"></td>
        </tr>
        <tr>
            <td>メッセージ</td>
            <td>
                <textarea rows="8" cols="50" name="message"></textarea>
            </td>
        </tr>
        <tr>
            <td>編集用パスワード</td>
            <td><input type="password" name="passwd" size="4"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="確認する">
            </td>
        </tr>
    </table>
</form>
<?php
//データベースに接続
$database = 'student_bbs'; //データベース名の設定
$con = mysqli_connect('localhost', 'student', 'student999')
or die('接続に失敗しました');
mysqli_select_db($con, $database)
or die($database . 'に接続できません');
mysqli_query($con, 'SET NAMES UTF8MB4')
or die('文字コードの設定に失敗しました');
//データの取得
$query = mysqli_query($con, 'SELECT * FROM discussion ORDER BY id DESC')
or die('検索に失敗しました');
//文字コードをUTF-8にする
mb_internal_encoding('UTF-8');

//取得したデータを一覧表示
while ($data = mysqli_fetch_array($query)) {
    echo "<hr>{$data["id"]} : ";
    echo $data["name"];
    echo "(" . date("Y/m/d H:i", strtotime($data["modified"])) . ")";
    //先頭から50文字だけを表示
    if (mb_strlen($data["message"]) >= 50) {
        echo "<p>" . nl2br(mb_substr($data["message"], 0, 50))
            . '<font color="blue"> ・・・続きは[詳細]をクリック</font>' ."</p>";
    } else {
        echo "<p>" . nl2br(mb_substr($data["message"],0,50)) . "</p>";
    }
    //編集・削除・詳細表示画面へのリンク
    echo "<a href=\"update.php?id=" . $data["id"] . "\">編集</a> ";
    echo "<a href=\"delete.php?id=" . $data["id"] . "\">削除</a> ";
    echo "<a href=\"detail.php?id=" . $data["id"] . "\">詳細</a> ";
}
//データベースを切断
mysqli_close($con);
?>
</body>
</html>