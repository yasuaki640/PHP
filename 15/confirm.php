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
$thread = $_SESSION["thread"];
// 入力値の切り替え
if (empty($name)) {
    print('名前が記入されていません<br>');
}
if (empty($message)) {
    print('メッセージが記入されていません<br>');
}
//パスワードが4桁の数字かチェック
if (preg_match("/\A\d{4}\z/", $passwd)) {
    //入力値をセッション変数に格納
    $_SESSION["name"] = $name;
    $_SESSION["passwd"] = $passwd;
    $_SESSION["message"] = $message;
} else {
    print('パスワードは4桁の数字にしてください。 <br>');
    exit('ブラウザの戻るボタンをクリックして前画面に戻り、
    パスワードを正しく入力してさい。');
}
?>
<p>追加確認画面</p>
<!-- 入力確認フォーム -->
<form method="POST" action="submit.php">
    <table border="1">
        <tr>
            <td>スレッド番号</td>
            <td><?php echo $thread; ?></td>
        </tr>
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
        <tr>
            <td colspan="2">
                <input type="submit" value="書き込む">
                <input type="button" name="back" onClick="history.back()" value="戻る">
            </td>
        </tr>
    </table>
</form></body>
</html>