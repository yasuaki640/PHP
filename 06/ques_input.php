<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>授業評価アンケートフォーム</title>
</head>
<body>
    <h1>「実践プレゼンテーション技法」授業評価アンケート（記名式）</h1>
    <p>すべての質問に回答した後、「確認する」ボタンをクリックしてください。</p>
    <form method="POST" action="ques_check.php">
        <table border="1">
            <tr>
                <td>学籍番号</td>
                <td><input type="text" name="number" size="50"></td>
            </tr>
            <tr>
                <td>氏名</td>
                <td><input type="text" name="name" size="50"></td>
            </tr>
            <tr>
                <td>履修回数</td>
                <td>
                    <input type="radio" name="times" value="1回">1回
                    <input type="radio" name="times" value="2回">2回
                    <input type="radio" name="times" value="3回以上">3回以上
                </td>
            </tr>
            <tr>
                <td>学部</td>
                <td>
                    <select name="faculty">
                        <option value="">▼選択</option>
                        <option>教育学部</option>
                        <option>文学部</option>
                        <option>経済学部</option>
                        <option>工学部・理工学部（工系）</option>
                        <option>工学部・理工学部（理系）</option>
                        <option>農学部</option>
                        <option>医学部・薬学部</option>
                        <option>その他</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>授業の満足度は？</td>
                <td>
                    <?php
$rank = array('5' => '満足', '4' => 'やや満足', '3' => '普通', '2' => 'やや不満', '1' => '不満');
foreach ($rank as $key => $value) {
    echo "<input type=\"radio\" name=\"rankL\" value=\"{$key}\">{$value}";
}
?>
                </td>
            </tr>
            <td>教員の反応は？</td>
                <td>
                    <?php
foreach ($rank as $key => $value) {
    echo "<input type =\"radio\" name=\"rankT\" value=\"{$key}\">{$value}";
}
?>
                </td>
            </tr>
            <tr>
                <td>卒業後の進路（複数選択可）</td>
                <td>
                    <input type="checkbox" name="course[]" value="就職（技術系）">就職（技術系）
                    <input type="checkbox" name="course[]" value="就職（事務系）">就職（事務系）
                    <input type="checkbox" name="course[]" value="進学（本学大学院）">進学（本学大学院）
                    <input type="checkbox" name="course[]" value="進学（他大学院）">進学（他大学院）
                    <input type="checkbox" name="course[]" value="その他">その他
                </td>
            </tr>
            <tr>
            <td>授業に対するコメント</td>
            <td>
                <textarea name="comment" cols="80" rows="5"></textarea>
            </td>
            </tr>
            <tr>
            <td>進路相談</td>
            <td>
                <input type="checkbox" name="interview" checked>進路相談を希望する
            </td>
            </tr>
            <tr>
                <td align="right" colspan="2">
                    <input type="submit" value="確認する" name="submit1">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>