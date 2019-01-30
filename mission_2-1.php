<html>
<head>	
<meta charset="UTF-8">
</head>
<body>
<form method="POST" action="mission_2-1.php">
名前:<input type="text" name="name" value=""><br>
コメント:<input type="text" name="comment" value=""><br>
<input type="submit" value="送信">
</form>

<?php
//テキストファイル名を変数$filenameに代入
$filename='mission_2-1_1(Kano).txt';
//名前、コメント、投稿日時のためにあらかじめ変数を用意する。
$name=$_POST['name'];//名前
$comment=$_POST['comment'];//コメント
$date=date(Y年m月d日H時i分s秒);//投稿日時


if(file_exists($filename)){//テキストファイルの有無で条件分岐。ここでは、ファイルの有無で処理方法が変わる投稿番号の取得しかしない。
  $line=file($filename);//テキストファイルの中身を配列($line)に1つずつ代入
  $numbers=count($line);//行数($numbers)。『count(変数)』で変数(＝配列)の中の要素数をカウントする。
  $number=$numbers+1;//投稿番号の取得(2回目以降の投稿である場合の方法)
}else{
  $number="1";//投稿番号を取得する(1回目の投稿の場合の方法)。
}

//ここから投降番号、名前、コメント、投稿日時を追記していく。
$sentence=$number."<>".$name."<>".$comment."<>".$date."\n";//テキストファイルに出力される内容を、一つの変数にする。『."\n"』で改行。
  if(!empty($_POST['name']) and !empty($_POST['comment'])){  //『if()』で、「もし()ならば」の意味。フォームに記述されているかでさらに条件分岐
  //ファイルに追記する。
  $fp=fopen($filename,'a');
  fwrite($fp,$sentence);  //変数は、''や""で囲まない。
  fclose($fp);
  }
?>

</body>
</html>
