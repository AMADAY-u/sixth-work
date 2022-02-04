<?php
//1.  DB接続します
try {
//ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=vet_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM pets_db");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p class='contents'>";
    $view .= $result["indate"] ." /". $result["content"] ."/". $result["hung"]."/". $result["act"]."/". $result["freq"]."<br>". $result["pcomment"];
    $view .= "</p>";
    }

}
$message = date('Y/m/d/l');

?>


<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Pets form</title>
    <link rel='stylesheet' href='css/reset.css'>
    <link rel='stylesheet' href='css/style.css'>
</head>
<body>
    <div class='wrap'>
        <div class='prof'>
            <div class='prof__img'><img src='img/2_Precious_Pets_2-1.jpg'alt=''></div>
            <div class='prfo__contents'>
                <div class='prof__name'>Pets Healthy Log</div>
                <div class='prof__text'><?php echo $message; ?></div>
            </div>
        </div>
        <!-- /.prof -->
<h1 class='contents' style='font-size: 25px; font-weight: bold;'>毎日の健康記録<br>
(記録日時/食餌内容/食欲/活動量/食餌頻度/コメント)</h1>
<?=$view;?>
    <div>
    <div class='title'>メニュー</div>
        <ul>
            <li class='contents'><a href="page3.php">記録する</a></li>
            <li class='contents'><a href="page2.php">プロフィールへ</a></li>
        </ul>
    </div>

</body>
</html>











