<?php
//年月日を取得
if (isset($_GET['ymd'])) {

    //日記の年月日を取得
    $ymd = basename($_GET['ymd']);
    $y = intval(substr($ymd, 0, 4));
    $m = intval(substr($ymd, 4, 2));
    $d = intval(substr($ymd, 6, 2));
    $disp_ymd = "{$y}年{$m}月{$d}日の出来事";
    //出来事のデータを取得
    $file_name = "mydata/{$ymd}.txt";
    if (file_exists($file_name)) 
    {
        $diary = file_get_contents($file_name);
    } else 
    {
        $diary = '';
    }
} else 
{
    //カレンダーを経由せず、登録画面にアクセスされた場合はカレンダーに移動
    header('Location: mycalendar.php');
}
//出来事を登録する
if (isset($_POST['action']) and $_POST['action'] == '登録する') 
{
    $diary = htmlspecialchars($_POST['diary'], ENT_QUOTES, 'UTF-8');
    //出来事が入力されたか調べる
    if (!empty($diary)) 
    {
        //入力された内容で出来事を登録
        file_put_contents($file_name, $diary);
    } else 
    {
        //出来事がなければファイルを削除
        if (file_exists($file_name)) 
        {
            unlink($file_name);
        }
    }
    //出来事が登録されれば、カレンダーに移動
    header('Location: mycalendar.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>日記・予定帳</title>
</head>
<body>
    <h1>日記・予定登録</h1>
        <form method="POST" action="">
            <table>
                <tr>
                    <td><?php print($disp_ymd); ?></td>
                </tr>
                <tr>
                    <td>
                        <textarea rows="10" cols="60" name="diary"><?php print($diary); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="action" value="登録する">
                        <input type="button" name="back" onClick="history.back()" value="戻る">
                    </td>
                </tr>
            </table>
        </form>
</body>
</html>