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
$stmt = $pdo->prepare("SELECT * FROM honer_db ORDER BY id DESC LIMIT 1");
$status = $stmt->execute();

//３．データ表示
$pet = "";
$name = "";
$address = "";
$email = "";
$pname = "";
$sex = "";
$birth = "";
$sp = "";
$mhistory = "";
$hospital = "";
$text = "";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $pet .= $result["pet"] ;
    $name .= $result["name"] ;
    $address .= $result["address"] ;
    $email .= $result["email"] ;
    $pname .= $result["pname"] ;
    $sex .= $result["sex"] ;
    $birth .= $result["birth"] ;
    $sp .= $result["sp"] ;
    $mhistory .= $result["mhistory"] ;
    $hospital .= $result["hospital"] ;
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
            <div class='title'>個人情報</div>
            <div class='text'>種：<?=$pet;?></div>
            <div class='text'>主人名前：<?=$name;?></div>
            <div class='text'>住所：<?php echo $address;?></div>

            <div class='text'>アドレス：<?php echo $email;?></div>
            <div class='text'>ペットの名前：<?php echo $pname;?></div>
            <div class='text'>性別：<?php echo $sex;?></div>
            <div class='text'>誕生日：<?php echo $birth;?></div>

            <div class='text'>種名：<?php echo $sp;?></div>
            <div class='text'>既往歴：<?php echo $mhistory;?></div>
            <div class='text'>かかりつけの病院：<?php echo $hospital;?></div>
            <div class='text'>特徴：<?php echo $text;?></div>
        </div>
        <!-- /.contents -->

        <div class='contents'>
            <div class='title'>毎日の食餌・体調を記録する</div>
            <ul>
                <li><a href="page1.php">個人情報修正</a></li>
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