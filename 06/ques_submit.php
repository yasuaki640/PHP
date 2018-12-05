<?php
		//データが入力されてなければ終了、直接アクセスされた場合の対応
if (empty($_POST)) {
    exit('データが入力されてされていないため、処理を終了します');
}
?>
		<!DOCTYPE html>
		<html lang="ja">
		<head>
		<meta charset="UTF-8">
		<title>授業評価アンケート（回答完了）</title>
		</head>
		<body>
		<h1>授業評価アンケート回答完了画面</h1>
	<?php
	//入力データの取得
print ($_POST['number']);
print($_POST['name']);
$number = htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8');
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$times = htmlspecialchars($_POST['times'], ENT_QUOTES, 'UTF-8');
$faculty = htmlspecialchars($_POST['faculty'], ENT_QUOTES, 'UTF-8');
$rankL = htmlspecialchars($_POST['rankL'], ENT_QUOTES, 'UTF-8');
$rankT = htmlspecialchars($_POST['rankT'], ENT_QUOTES, 'UTF-8');
$course = htmlspecialchars($_POST['course'], ENT_QUOTES, 'UTF-8');
$comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
$interview = htmlspecialchars($_POST['interview'], ENT_QUOTES, 'UTF-8');

		//各項目の入力データを配列へ
$line = array($number, $name, $times, $faculty, $rankL, $rankT, $course, $comment, $interview);

		//ファイルへの書き込み
$file_name = 'answer.csv';
$fp = fopen($file_name, "a");
$success = fputcsv($fp, $line);
fclose($fp);

if ($success) {
    $message = '回答を受け付けました。ありがとうございました。';
} else {
    $message = 'エラーが発生しました';
}
?>

		<p><?php echo $message; ?></p>
		</body>
		</html>
