<?php
$message = date('Y/m/d/l');
$date = date('Y-m-d-l');



function h($val){
    return htmlspecialchars($val,ENT_QUOTES);
}
$content = $_GET["content"];
$hung = $_GET["hung"];
$act = $_GET["act"];
$freq = $_GET["freq"];
$pcomment = $_GET["pcomment"];


$file = fopen("./data/data.txt","a");
// ファイルに書き込み

fwrite($file," <div style = 'text-align:center; font-size: 20px;'> ".h($date)." / ".h($content)." / ".h($hung)." / ".h($act)." / ".h($freq).'<br>'.h($pcomment)." </div> ".'<br>');
fclose($file);
//文字作成

?>

<?php
//1.  DB接続します
try {
  //ID:'root', Password: 'root'
  $pdo = new PDO('mysql:dbname=vet_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM honer_db WHERE id=2");
$status = $stmt->execute();

//３．データ表示
$name = "";
$address = "";
$email = "";
$pname = "";
$sp = "";
$text = "";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $name .= $result["name"] ;
    $address .= $result["address"] ;
    $email .= $result["email"] ;
    $pname .= $result["pname"] ;
    $sp .= $result["sp"] ;
    $text .= $result["comment"] ;
    
    $view .= "</p>";
  }




}
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
                <div class='prof__name'>Pets healthy Log</div>
                <div class='prof__text'><?php echo $message; ?></div>
            </div>
        </div>
        <!-- /.prof -->
    <h1 style='text-align:center;  font-size:30px;'>
        <div style='font-size:25px; font-weight: bold; margin: 32px 0;'>
        食事内容：<?=$content?><br>
        食欲：<?=$hung?><br>
        活動量：<?=$act?><br>
        食餌頻度：<?=$freq?><br>
        コメント：<?=$pcomment?><br>

        </div>
        と書き込みしました。
    </h1>

    <div class='contents'>
        <div class='title'>メニュー</div>
        <ul>
            <li><a href="page5.php">確認する</a></li>
            <li><a href="page3.php">もう一度記録する</a></li>
        </ul>
    </div>
</body>

</html>
