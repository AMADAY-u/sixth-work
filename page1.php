<?php

?>
<!--

phpの注意！
1.cssはキャッシュによって反映されない時があります！
→
正しく書いていても、あれ？あれれ？何か聞いていない？動いてない？
という現象が発生します！これはPHPあるあるですので、そういったときはキャッシュを削除！を忘れないようにしましょう！

2.phpの文法ではセミコロンに注意！
→
画面が真っ白！！！！そんなときは「書き間違えている」ことがほとんどです！
セミコロンや大文字になっていないか、また空白が入っていないかなど確認しておきましょう！

-->


<?php

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
                <div class='prof__name'>Pets Form</div>
                <div class='prof__text'><?php echo $message; ?></div>
            </div>
        </div>
        <!-- /.prof -->

        <div class='contents'>
            <div class='title'>個人情報</div>
            <div class='text'>
                個人の情報を入力してください。<br>
                「あなたの名前」「住所」「emailアドレス」「ペットの名前」「種名」を入力してください！<br>
                例）「太郎」「北海道」「＊＊＊＠test.ts」「ケン」「チワワ」
            </div>
        </div>
        <!-- /.contents -->

        <form action='insert1.php' method="post">
            <p>飼っているペットはなにかな？</p>
                <input type='radio' name="dog" value="dog">いっぬ！
                <input type='radio' name="cat" value="cat">ねっこ！
                <input type='radio' name="other" value="other">犬猫とかありえない！

                <hr>
                <ul class ='title'>
                    <li>主人名前: <input  type="text" name="name"></li>
                    <li>住所:   <input type="text" name="address"></li>
                    <li>EMAIL:  <input type="text" name="email"></li>
                    <li>ペットの名前<input  type="text" name="pname"></li>
                    <li>種類:   <input type="text" name="sp"></li>
                </ul>
            <p>ペットの好きなものや特徴を好きに書いてね！！！</p>
            <textarea name='text' id='comment'></textarea>

            <button type="submit">個人情報を送信！</button>
        </form>

        <footer class='footer'>
            <small class='copy'>&copy;Pets Form</small>
        </footer>x  
    </div>
</body>
</html>