<html>
<head>	
<meta charset="UTF-8">
</head>
<body>
<form method="POST" action="mission_2-2.php">
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

//テキストファイルの有無で条件分岐。ここでは、ファイルの有無で処理方法が変わる投稿番号の取得しかしない。
if(file_exists($filename)){
  $line=file($filename);
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
  }//ここまでは、mission_2-1と同じ。
?>

<?php
//ここからテキストファイルを読み込み、ブラウザに表示する。
$line=file($filename);//テキストファイルの中身を配列($line)に代入
foreach($line as $text){//$line(前行でとった配列)の先頭から一つずつ$textに代入。要素(テキストファイルの中身)の数だけ処理を繰り返す。
$contribution=explode("<>",$text);//『"<>"』を区切りにして、それぞれの要素($number,$nameなど=$text)をバラバラに分割して取得。
echo $contribution[0]." ";//代入したもの($)をブラウザに表示([0],[1],[2],[3]まで)。『" "』は1マス空欄。
echo $contribution[1]." ";
echo $contribution[2]." ";
echo $contribution[3]."<br>";//『."<br>"』で改行。
}

?>
</body>
</html>
