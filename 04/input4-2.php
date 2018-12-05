<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録完了</title>
</head>
<body>
    <p>下記の内容で登録を完了しました。</p>
    <table border="1">
        <tr>
            <td>学籍番号</td>
            <td><?php print(htmlspecialchars($_POST['numberS'],ENT_QUOTES, 'UTF-8'))?></td>
        </tr>
        <tr>
            <td>名前</td>
            <td><?php print(htmlspecialchars($_POST['nameS'],ENT_QUOTES, 'UTF-8'))?></td>
        </tr>
        <tr>
            <td>メールアドレス</td>
            <td><?php print(htmlspecialchars($_POST['mailS'],ENT_QUOTES, 'UTF-8'))?></td>
        </tr>
        <tr>
            <td>コメント</td>
            <td><?php print(htmlspecialchars($_POST['commentS'],ENT_QUOTES, 'UTF-8'))?></td>
        </tr>
    </table>
</body>
</html>