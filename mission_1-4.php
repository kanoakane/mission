<html>
<head>	
<meta charset="UTF-8">
</head>
<body>
<form method="POST" action="mission_1-4.php">       <!-methodがフォーム情報送信の方法。actionが送信先->
<input type="text"name="comment"value="コメント">　　　　<!-『name=""』の中身は、『$_POST['']』の中身と同じになればいいので、特に指定は無い。->
<input type="submit"value="送信">
</form>
   <!-フォームの下にphpを記入すると、フォームの下に文字が表示される->
ご入力ありがとうございます。<br>
<?php
$date=date(Y年m月d日H時i分);//date(Y年m月d日H時i分)で現在の時刻を表示
echo $date;
?>
"に"
<?php
//html(入力フォーム)から値(フォームに入力されたデータ)を受け取る
$comment=$_POST['comment'];//『$_POST['']』の''の中身は『name=""』の""の中身と同じにする。
echo $comment;        //受け取った値を表示する
?>
を受け付けました。


</body>
</html>