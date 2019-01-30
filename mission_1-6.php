<html>
<head>	
<meta charset="UTF-8">
</head>
<body>
<form method="POST" action="mission_1-6.php">
<input type="text"name="comment"value="">　　　　<!-『name=""』の中身は、『$_POST['']』の中身と同じになればいいので、特に指定は無い。->
<input type="submit"value="送信">
</form>

<?php
//何度も使う値は、はじめに変数を決めておき、代入する。
$comment=$_POST['comment']; //ちなみに『$_POST['comment']."\n"』でフォームからテキストファイルへ送られた文字が、送信されるごとに改行して保存されるようになる
$filename='mission_1-6_(Kano).txt';

if(!empty($_POST['comment'])){  //『if()』で、「もし()ならば」の意味。
   //↑『empty(変数)』で、その変数に値がちゃんと代入されているか調べる。そして、『if(empty(変数))』は変数に値が代入されていない場合の対応を表記。
 $fp=fopen($filename,'a');    //今回は、『!empty(変数)』なので、その後は変数に値が代入されている場合の対応を表記。
 fwrite($fp,$comment."\r\n");  //変数は、''や""で囲まない。
                    //↑『."\r\n"』でフォームからテキストファイルへ送られた文字が、送信されるごとに改行して保存されるようになる
 fclose($fp);
}
?>


</body>
</html>