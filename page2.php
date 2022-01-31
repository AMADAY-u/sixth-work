<?php
$message = date('Y/m/d/l');

//POSTで送られてきたデータは$_POST['目印名'];で取得
// name='text' → $_POST['text'];
function h($val){
    return htmlspecialchars($val,ENT_QUOTES);
}


$text = $_POST['text'];
if(isset($_POST['dog'])){
    $last = 'だワン！';
}elseif(isset($_POST['cat'])){
    $last = 'だニャン！';
}elseif(isset($_POST['other'])){
    $last = 'だよ！';
};



$name = $_POST["name"];
$address = $_POST["address"];
$email = $_POST["email"];
$pname = $_POST["pname"];
$sp = $_POST["sp"];


$file = fopen("./data/data.txt","a");

fwrite($file,"<h2 style = 'text-align:center; font-size: 30px; font-weight:bold'>".h($pname).'</h2>'.'<br>');

fclose($file);

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



    // $result = $stmt->fetch(PDO::FETCH_ASSOC)
    // $name .=  $result["name"];
    // $address .= $result["address"];
    // $email .= $result["email"];
    // $pname .= $result["pname"];
    // $sp .= $result["sp"];
    // $text .= $result["comment"];

}
?>





<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Pets profile</title>
    <link rel='stylesheet' href='css/reset.css'>
    <link rel='stylesheet' href='css/style.css'>
</head>
<body>
    <div class='wrap'>
        <div class='prof'>
            <div class='prof__img active'><img src="img/2_Precious_Pets_2-1.jpg" alt=""></div>
            
            <div class='prfo__contents'>
                <div class='prof__name'>Pets Form Profile</div>
                <div class='prof__text'></div>
            </div>
        </div>
        <!-- /.prof -->

        <div class='contents'>
            <div class='title'>個人情報<?=$last?></div>
            <div class='text'>主人名前：<?=$name;?></div>
            <div class='text'>住所：<?php echo $address;?></div>

            <div class='text'>アドレス：<?php echo $email;?></div>
            <div class='text'>ペットの名前：<?php echo $pname;?></div>

            <div class='text'>種名：<?php echo $sp;?></div>
            <div class='text'>特徴：<?php echo $text;?></div>
        </div>
        <!-- /.contents -->

        <div class='contents'>
            <div class='title'>毎日の食餌・体調を記録する</div>
            <ul>
                <li><a href="page3.php">記録フォームへ</a></li>
            </ul>
            <div class='text'></div>
        </div>
        <!-- /.contents -->

        <div class='icon <?= $active;?>'><img src='img/icon_01.png' alt=''></div>
        <!-- iconの後半角スペースを入れること -->

        <footer class='footer'>
            <small class='copy'>&copy;Pets Form</small>
        </footer>

    </div>
</body>
</html>