<html>
<head>	
<meta charset="UTF-8">
</head>
<body>
<form method="POST" action="mission_2-3.php">
<input type="text" name="name" placeholder="名前"><br>  <!-『placeholder』で、フォームにグレーの初期値(入力すると自動で消える)を掲示できる->
<input type="text" name="comment" placeholder="コメント">
<input type="submit" value="送信"><br>
<br>
<input type="text" name="numeral" placeholder="削除対象番号">
<input type="submit" value="削除">
</form>

<?php
//ここは投稿機能。
//テキストファイル名を変数$filenameに代入
$filename="mission_2-1_(Kano).txt";
$name=$_POST['name'];//名前
$comment=$_POST['comment'];//コメント
$date=date(Y年m月d日H時i分s秒);//投稿日時
$numeral=$_POST['numeral'];//削除対象番号
//ここでは、投稿番号の取得しかしない。(間違えた場合2－2をコピペすれば元通り)
if(!empty($_POST['name']) and !empty($_POST['comment'])){//条件①投稿が行われているかどうか
  if(file_exists($filename)){//条件①が成立、かつ条件②テキストファイルがある場合
    $fp2=fopen('count.txt','r');//投稿番号をカウントするためのファイルを読み込みモードで開く。
    $num_text=fgets($fp2);//1行目を文字列として読み込む。
    fclose($fp2);
    $number=(int)$num_text;//文字列をint(整数)型に変換。
    $number += 1;//数字を1増やす($number=(int)$num_text+1になる)
    $fp2=fopen('count.txt','w');//投稿番号をカウントするためのファイルを書き込みモードで開く。同時にこのファイルの中身は空になっている。
    fwrite($fp2,$number);//新しい数字を書き込む
    fclose($fp2);//ファイルを閉じる。これで投稿番号の取得(2回目以降の投稿である場合)
  }else{//条件②は不成立。しかし条件①は成立する(投稿は行われる)場合。
    $number="1";//1回目の投稿時の番号は必ず１。
    $fp2=fopen('count.txt','w');//投稿番号をカウントするためのファイルを書き込みモードで開く。同時にこのファイルの中身は空になっている。
    fwrite($fp2,$number);//新しい数字を書き込む
    fclose($fp2);//ファイルを閉じる。これで投稿番号の取得(1回目の投稿である場合)
  }//条件②閉じる
}//条件①閉じる

//ここから投稿番号、名前、コメント、投稿日時を追記していく。
$sentence=$number."<>".$name."<>".$comment."<>".$date."\n";//テキストファイルに出力される内容を、一つの変数にする。『."\n"』で改行。
if(!empty($_POST['name']) and !empty($_POST['comment'])){  //『if()』で、「もし()ならば」の意味。フォームに記述されているかでさらに条件分岐
  //ファイルに追記する。
  $fp=fopen($filename,'a');
  fwrite($fp,$sentence);  //変数は、''や""で囲まない。
  fclose($fp);
}//ここまでは、mission_2-1と同じ。


//ここで削除機能を作る。
//最初のif構文(条件分岐)。削除対象番号が投稿されたかどうかで分岐。
if(!empty($numeral)){
  $line=file($filename);//テキストファイルの中身を1行ずつ配列($line)に代入して、読み込む(取り出す)。
  $fp=fopen($filename,'w');//書き込み準備。同時にファイルの中身は空になっている。
   //ここからループを始める。
   foreach($line as $text){//$line(配列)の先頭から1行ずつ$textに代入。要素(テキストファイルの中身)の数だけ処理を繰り返す(ループ)。
   $contribution=explode("<>",$text);//『"<>"』を区切りにして、それぞれの要素($number,$nameなど=$text)をバラバラに分割して取得。
	//二つ目のif構文(条件分岐)。削除対象番号と投稿番号($contribution[0])が一致しないかどうか条件分岐
	if($numeral != $contribution[0]){
	  fwrite($fp,$contribution[0]."<>".$contribution[1]."<>".$contribution[2]."<>".$contribution[3]);//行の内容をファイルに書き込む。ここでは勝手に改行してくれるので、改行はいらない。
	}//二つ目のif構文(条件分岐)閉じる
   }//ループ終了
 fclose($fp);
}//最初のif構文(条件分岐)閉じる


//ここからブラウザに表示する。mission_2-2を使う。
$line=file($filename);
foreach($line as $text){
$contribution=explode("<>",$text);
echo $contribution[0]." ";//代入したもの($)をブラウザに表示([0],[1],[2],[3]まで)。『" "』は1マス空欄。
echo $contribution[1]." ";//名前
echo $contribution[2]." ";//コメント
echo $contribution[3]."<br>";//投稿日時。『."<br>"』で改行。
}
?>


</body>
</html>