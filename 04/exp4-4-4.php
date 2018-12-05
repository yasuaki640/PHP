<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>exp4-4-4</title>
</head>
<body>
    <?php
    $pstnC=htmlspecialchars($_POST['postnum'], ENT_QUOTES, 'UTF-8');
    $addC=htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
    $telnC=htmlspecialchars($_POST['telnum'], ENT_QUOTES, 'UTF-8');
    $pswdC=htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    $flag = 0;

    //郵便番号の確認
    $tmp=mb_convert_kana($pstnS, 'n', 'UTF-8')
    if(preg_match('/\A\d{7}\z/', $tmp)
    {
        $pstnC=$tmp;
    }else{
        $pstnC='<font color="ff0000">ハイフン無し7桁の数値ではありません。</font><br>' . $tmp;
        $flag = 1;
    }
    //電話番号の確認
    $tmp=mb_convert_kana($telnS, 'n', 'UTF-8');
    $message=''
    if(!(preg_match('/^0/', $tmp)))
    {
        $message='<font color="ff0000">市外局番から入力してください。</font><br>';
        $flag = 1;
    }
    if(!(preg_match('/\A\d{10}\z/',$tmp) or preg_match('/\A\d{11}\z/',$tmp)))
    {
        $message=$message . '<font color="ff0000">ハイフン無しの電話番号ではありません。</font><br>'
        $flag = 1;
    }
    $telnS=$message . $tmp;
    print('
    <form action="exp4-4-5.php" method="post">
    <p>下記の内容を確認してください。</p>
    <table border="1">
        <tr>
            <td>郵便番号</td><td>' . $pstnC . '</td>
        </tr>
        <tr>
            <td>住所</td><td>' . $addC . '</td>
        </tr>
        <tr>
            <td>電話番号</td><td>' . $telnC . '</td>
        </tr>
        </tr>
    </table><br>'
    );
    if($flag == 0)
    {
        print('<input type="submit" value="確認"><br>');
        print('<input type="hidden" name="postnumS" value="'.$pstnS.'">');
        print('<input type="hidden" name="addressS" value="'.$addS.'">');
        print('<input type="hidden" name="telnumS" value="'.$telnS.'">');
    }else{
        print('ブラウザのバックボタンで戻ってください。');
    }
    print('</form>');
    ?>
</body>
</html>