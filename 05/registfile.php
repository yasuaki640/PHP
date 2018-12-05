<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>パスワード登録</title>
</head>
<body>
    <?php
    $user=$_POST['user'];
    $passwd=$_POST['passwd'];

    if(empty($user)){
        echo 'ユーザ名が入力されていません';
        exit;
    }
    if(empty($passwd)){
        echo 'パスワードが入力されていません';
        exit;
    }

    //すでにユーザ登録されているか確認
    if(($fp=fopen("./passwd/passwd.csv","r")) !== false)
    {
        while(($data=fgetcsv($fp,100,",")) !== false)
        {
            if($data[0]==$user)
            {
                echo 'ユーザ名' . $user . 'は登録済みです<br>';
                fclose($fp);
                exit;
            }
        }
        fclose($fp);
    }

    //ファイルにユーザ名とパスワードを登録
    $fp=fopen("./passwd/passwd.csv","a"); //ファイルを追記で開く
    $data=array($_POST['user'],$_POST['passwd']);
    fputcsv($fp, $data); //CSVファイルで出力
    fclose($fp);
    print('ユーザ名(' . $user . ')とパスワード(' . $passwd . ')を登録しました<br>');
    ?>
</body>
</html>