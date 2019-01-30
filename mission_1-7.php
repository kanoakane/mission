<html>
<head>	
<meta charset="UTF-8">
</head>
<body>
<form method="POST" action="mission_1-7.php">
<input type="text"name="comment"value="">
<input type="submit"value="送信">
</form>

<?php
//何度も使う値は、はじめに変数を決めておき、代入する。
$comment=$_POST['comment']."\n";//『."\n"』でフォームからテキストファイルへ送られた文字が、送信されるごとに改行して保存されるようになる
$filename='mission_1-6_(Kano).txt';

if(!empty($_POST['comment'])){  //『if()』で、「もし()ならば」の意味。
   //↑『empty(変数)』で、その変数に値がちゃんと代入されているか調べる。そして、『if(empty(変数))』は変数に値が代入されていない場合の対応を表記。
 $fp=fopen($filename,'a');    //今回は、『!empty(変数)』なので、その後は変数に値が代入されている場合の対応を表記。
 fwrite($fp,$comment);  //変数は、''や""で囲まない。
 fclose($fp);
}
?>


<?php
//ここからテキストファイルを読み込み、ブラウザに表示する。
$lines=file($filename);//テキストファイルの中身を配列($lines)に代入
foreach($lines as $line){//$lines(前行でとった配列)の先頭から一つずつ$lineに代入。要素(テキストファイルの中身)の数だけ処理を繰り返す。
echo $line."<br>";//代入したもの($line)をブラウザに表示。(『."<br>"』があるので処理のたびに改行)
}//繰り返し行うプログラミングはここまで。
?>

</body>
</html>