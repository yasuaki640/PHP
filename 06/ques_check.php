<?php
//データが入力されてなければ終了、直接アクセスされた場合の反応
if (empty($_POST)) {
    exit('データが入力されていないため、処理を終了します');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>授業評価アンケート（確認）</title>
</head>
<body>
    <?php
    //すでにユーザ登録されているか確認
    //学籍番号を取得
    $number = htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8');
    //念のため半角英数字へ変換
    $number = mb_convert_kana($number, 'n', 'UTF-8');
    //スペースを取り除く
    $number = str_replace(" ", "", $number);
    //answer.csvは事前に用意　文字コードはUTF-8
    if (($fp = fopen("./answer.csv", "r")) !== false) {
        while (($data = fgetcsv($fp, 1000, ",")) !== false) {
            if ($data[0] == $number) {
                fclose($fp);
                exit('学籍番号' . $number . 'は回答済みです');
            }
        }
        fclose($fp);
    }
    //評価と数値の対応付け
    $rank = array('5' => '満足', '4' => 'やや満足', '3' => '普通', '2' => 'やや不満', '1' => '不満');

    //入力値の取得とチェック
    if (empty($number)) {
        exit('学籍番号を入力して下さい<br>');
    }

    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    if (empty($name)) {
        exit('氏名を入力して下さい<br>');
    }

    $times = htmlspecialchars($_POST['times'], ENT_QUOTES, 'UTF-8');
    if (empty($times)) {
        exit('履修回数を入力して下さい<br>');
    }

    $faculty = htmlspecialchars($_POST['faculty'], ENT_QUOTES, 'UTF-8');
    if (empty($faculty)) {
        exit('学部を入力して下さい<br>');
    }

    $rankL = htmlspecialchars($_POST['rankL'], ENT_QUOTES, 'UTF-8');
    if (empty($rankL)) {
        exit('授業の満足度を入力して下さい<br>');
    }

    $rankT = htmlspecialchars($_POST['rankT'], ENT_QUOTES, 'UTF-8');
    if (empty($rankT)) {
        exit('教員の対応を評価して下さい<br>');
    }


    if (empty($_POST['course'])) {
        exit('卒業後の希望進路を選択して下さい<br>');
    } else {
        $course = implode(' ', $_POST['course']);
    }
    $course = htmlspecialchars($course, ENT_QUOTES, 'UTF-8');

    $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
    if (empty($comment)) {
        exit('コメントを入力してください。特になければ「特になし」と入力してください<br>');
    }

    if (@$_POST['interview'] == 'on') {
        $interview = '進路相談希望';
    } else {
        $interview = '進路相談を希望しない';
    }
    ?>
        
         <!-- 回答の確認 -->
        	<p>入力内容を確認してください。</p>
        	<form method="post" action="ques_submit.php">
        	<table border="1">
        	<tr>
        	<td>学籍番号</td>
        	<td><?php print($number); ?></td>
        	</tr>
        	<tr>
        	<td>氏名</td>
        	<td><?php print($name); ?></td>
        	</tr>
        	<tr>
    	<td>履修回数</td>
        	<td><?php print($times); ?></td>
        	</tr>
        	<tr>
        	<td>学部</td>
        	<td><?php print($faculty); ?></td>
        	</tr>
        	<tr>
        <td>授業の満足度</td>
        <td><?php print($rank[$rankL]); ?></td>
        </tr>
        	<tr>
        <td>教員の対応</td>
        <td><?php print($rank[$rankT]); ?></td>
        	</tr>
        	<tr>
        	<td>卒業後の志望進路（複数回答可）</td>
        	<td><?php print($course); ?></td>
        </tr>
        	<tr>
    	<td>授業に対するコメント</td>
        <td><?php print(nl2br($comment, false)); ?></td>
        	</tr>
        <tr>
        	<td>進路相談</td>
        	<td><?php print($interview); ?></td>
        	</tr>
       	<tr>
        	<td align="right" colspan="2">
        	<input type="submit" value="回答を送信する" name="submit1">
        	</td>
        	</tr>
        	</table>
        	<input type="hidden" name="number" value="<?php print($number); ?>">
        	<input type="hidden" name="name" value="<?php print($name); ?>">
        	<input type="hidden" name="times" value="<?php print($times); ?>">
        	<input type="hidden" name="faculty" value="<?php print($faculty); ?>">
        	<input type="hidden" name="rankL" value="<?php print($rankL); ?>">
        	<input type="hidden" name="rankT" value="<?php print($rankT); ?>">
        	<input type="hidden" name="course" value="<?php print($course); ?>">
        	<input type="hidden" name="comment" value="<?php print($comment); ?>">
        	<input type="hidden" name="interview" value="<?php print($interview); ?>">
</form>
</body>
</html>
