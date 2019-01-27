<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>電子会議システム</title>
</head>
<body>
<h1>電子会議システム</h1>
参加したいスレッド番号をクリックしてください。<br>
<hr>
<h2>スレッド一覧</h2>
<?php
mb_internal_encoding('UTF-8');
//データベースに接続
$database = 'student_bbs'; //データベース名の設定
$con = mysqli_connect('localhost', 'student', 'student999')
or die('接続に失敗しました');
mysqli_select_db($con, $database)
or die($database . 'に接続できません');
mysqli_query($con, 'SET NAMES UTF8MB4')
or die('文字コードの設定に失敗しました');
//タイトル取得
if (isset($_GET["title"]) $title = htmlspecialchars($_GET["title"]));
//データの取得
$query = mysqli_query($con, 'SELECT * FROM discussion ORDER BY id DESC')
or die('検索に失敗しました');
$flag = 0;
while ($data = mysqli_fetch_array($query)) {
    //スレッ\ドタイトルのデータが存在すればagendaテーブルに挿入
    if (!empty($title) and $data["title"] == $title) {
        echo '<br>すでにスレッド番号' . $data["thread"] .
            'で同名のタイトルが存在します。<br>同名のスレッドは作成できません。';
        $flag = 1;
    }
}
if ($flag == 0 and !empty($title))
    $query = mysqli_query($con, "INSERT INTO agenda(title,created)
VALUES('$title', NOW())") or die('スレッドの作成に失敗しました');
        //データの表示
        $query = mysqli_query($con, 'SELECT * FROM agenda ORDER BY thread DESC')
        or die('検索に失敗しました');
        while ($data = mysqli_fetch_array($query)) {
            echo "<hr><a href=\"title_enter.php?thread=" . $data["thread"] . "\"> ";
            echo $data["thread"] . ":" . $data["title"] . "</a>";
            echo "(" . date("Y/m/d H:i", strtotime($data["created"])) . "作成)";
        }
        //データベースを切断
mysqli_close($con);
        ?>
<!-- スレッド名入力フォーム -->
<hr>
<h2>スレッド作成</h2>
新しいスレッド(議題)のタイトルを入力してください。<br>
<form method="GET" action="bbs_top.php">
    <input type="text" name="title" size="50">
    <br>
    <input type="submit" value="スレッド作成">
</form>
</body>
</html>
