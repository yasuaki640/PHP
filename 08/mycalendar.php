<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>簡単日記・予定帳</title>
</head>
<body>
    <h1>簡単日記・予定帳</h1>
    <?php
    //現在の年月の取得
    $thisYear = date('Y');
    $thisMonth = date('m');

    if (isset($_POST['year'])) {
        //選択された年月の取得
        $year = intval($_POST['year']);
        $month = intval($_POST['month']);
    } else {
        //現在の年月の取得
        $year = $thisYear;
        $month = $thisMonth;
    }
    //年月選択メニューを表示
    $me = $_SERVER['SCRIPT_NAME'];
    echo "<form method=\"POST\" action=\"$me\">";
    //年の選択メニュー
    echo '<select name="year">';
    for ($i = $thisYear - 10; $i <= $thisYear + 3; ++$i) {
        echo '<option';
        if ($i == $year) {
            echo ' selected';
        }
        echo ">$i</option>";
    }
    echo '</select>年';
    //月の選択メニュー
    echo '<select name="month">';
    for ($i = 1; $i <= 12; ++$i) {
        echo '<option';
        if ($i == $month) {
            echo ' selected';
        }
        echo ">$i</option>";
    }
    echo '</select>月';
    echo '<input type="submit" value="カレンダーを表示" name="submit1">';
    echo '</form>';
    ?>
    <!-- カレンダーを表示 -->
    <table border="1">
    <tr>
    <th>日</th>
    <th>月</th>
    <th>火</th>
    <th>水</th>
    <th>木</th>
    <th>金</th>
    <th>土</th>
    </tr>
    <tr>
    <?php
    //1日の曜日まで移動
    $first = date('w', mktime(0, 0, 0, $month, 1, $year));
    for ($i = 1; $i <= $first; ++$i) {
        echo '<td>  </td>';
    }

    $day = 1;
    while (checkdate($month, $day, $year)) {
        //日にちを表示
        $link = 'mydiary.php?ymd=%04d%02d%02d';
        echo '<td><a href="'.sprintf($link, $year, $month, $day)."\">{$day}</a></td>";
        //土曜日の場合
        if (date('w', mktime(0, 0, 0, $month, $day, $year)) == 6) {
            //週を終了
            echo '</tr>';
            //次週があるときは行を追加
            if (checkdate($month, $day + 1, $year)) {
                echo '<tr>';
            }
        }
        //日付を１つ進める
        ++$day;
    }
    //最終週の土曜日まで移動
    $last = date('w', mktime(0, 0, 0, $month + 1, 0, $year));
    for ($i = 1; $i < 7 - $last; ++$i) {
        echo '<td>  </td>';
    }
    ?>
    </tr>
    </table>
</body>
</html>