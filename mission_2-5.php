<html>
<head>	
<meta charset="UTF-8">
</head>
<body>
<?php

//ここに編集する投稿を選択する機能をつける。
$filename="mission_2-5_(Kano).txt";
$editing=$_POST['editing'];//編集対象番号
$pw_editing=$_POST['pw_editing'];//編集フォームのパスワード
//最初のif構文(条件分岐)。パスワード付きで編集対象番号が投稿されたかどうかで分岐。
if(!empty($editing) and !empty($pw_editing)){
  $line=file($filename);//テキストファイルの中身を1行ずつ配列($line)に代入して、読み込む(取り出す)。
   foreach($line as $text){//ループを始める。
   $contribution=explode("<>",$text);//『"<>"』を区切りにして、それぞれの要素($number,$nameなど=$text)をバラバラに分割して取得。
	//二つ目のif構文(条件分岐)。編集対象番号と投稿番号を比較する
	if($editing==$contribution[0]){
		if($pw_editing==$contribution[4]){//二つ目のif構文(条件分岐)が成立。かつ条件③パスワードも正しいばあい
		  $hidden_editing=$contribution[0];//hiddenのフォームに入れる編集対象番号
		  $editingname=$contribution[1];//編集対象番号の名前。※左の変数($editingname)に右の変数($contribution[1])を代入するので、逆にするとうまく動かない。
        	  $editingcomment=$contribution[2];//編集対象番号のコメント
        	  $editingpassword=$contribution[4];//編集対象番号のパスワード
		}else{//二つ目のif構文(条件分岐)が成立。しかし条件③パスワードが間違っている場合
		  echo "パスワードが違います。"."\n";
		}//条件③閉じる
	}//二つ目のif構文(条件分岐)閉じる
   }//ループ終了
}//最初のif構文(条件分岐)閉じる

?>

<form method="POST" action="mission_2-5.php">
<input type="hidden" name="edit_number" value="<?php echo $hidden_editing; ?>"><br>  <!-編集したい投稿番号を表示する(あとでhiddenで隠し、ブラウザには表示され値いようにする。name属性は"editing"とは違うものにする)->
名前<input type="text" name="name" value="<?php echo $editingname; ?>"><br>
コメント<input type="text" name="comment" value="<?php echo $editingcomment; ?>"><br>
パスワード<input type="text" name="password" value="<?php echo $editingpassword; ?>">
<input type="submit" value="送信"><br>
<br>
削除機能<input type="text" name="numeral" placeholder="削除対象番号"><br>
パスワード<input type="text" name="pw_numeral" placeholder="パスワード">
<input type="submit" value="削除"><br>
<br>
編集機能<input type="text" name="editing" placeholder="編集対象番号"><br>
パスワード<input type="text" name="pw_editing" placeholder="パスワード">
<input type="submit" value="編集" >
</form>

<?php
//ここは投稿機能。
//テキストファイル名を変数$filenameに代入
$filename="mission_2-5_(Kano).txt";
$name=$_POST['name'];//名前
$comment=$_POST['comment'];//コメント
$date=date(Y年m月d日H時i分s秒);//投稿日時
$password=$_POST['password'];//投稿フォームのパスワード
$numeral=$_POST['numeral'];//削除対象番号
$pw_numeral=$_POST['pw_numeral'];//削除フォームのパスワード
$editing=$_POST['editing'];//編集対象番号
$pw_editing=$_POST['pw_editing'];//編集フォームのパスワード
$edit_number=$_POST['edit_number'];//hiddenのフォームで受け取った編集対象番号

//ここでは、投稿番号の取得しかしない。(間違えた場合2－2をコピペすれば元通り)
if(!empty($_POST['name']) and !empty($_POST['comment']) and !empty($_POST['password']) and empty($edit_number)){//条件①パスワード付きで投稿が行われているかどうか。かつhiddenの編集番号欄が空白か。
  if(file_exists($filename)){//条件①が成立、かつ条件②テキストファイルがある場合
    $fp2=fopen('count2-5.txt','r');//投稿番号をカウントするためのファイルを読み込みモードで開く。
    $num_text=fgets($fp2);//1行目を文字列として読み込む。
    fclose($fp2);
    $number=(int)$num_text;//文字列をint(整数)型に変換。
    $number += 1;//数字を1増やす($number=(int)$num_text+1になる)
    $fp2=fopen('count2-5.txt','w');//投稿番号をカウントするためのファイルを書き込みモードで開く。同時にこのファイルの中身は空になっている。
    fwrite($fp2,$number);//新しい数字を書き込む
    fclose($fp2);//ファイルを閉じる。これで投稿番号の取得(2回目以降の投稿である場合)
  }else{//条件②は不成立。しかし条件①は成立する(投稿は行われる)場合。
    $number="1";//1回目の投稿時の番号は必ず１。
    $fp2=fopen('count2-5.txt','w');
    fwrite($fp2,$number);
    fclose($fp2);//これで投稿番号の取得(1回目の投稿である場合)
  }//条件②閉じる
}//条件①閉じる

//ここから投稿番号、名前、コメント、投稿日時、パスワードを追記していく。
$sentence=$number."<>".$name."<>".$comment."<>".$date."<>".$password."<>"."\n";//テキストファイルに出力される内容を、一つの変数にする。『."\n"』で改行。
if(!empty($_POST['name']) and !empty($_POST['comment']) and !empty($_POST['password']) and empty($edit_number)){  //パスワード付きでフォームに記述されているか、かつhiddenの編集番号欄が空白かでさらに条件分岐
  //ファイルに追記する。
  $fp=fopen($filename,'a');
  fwrite($fp,$sentence);  //変数は、''や""で囲まない。
  fclose($fp);
}//ここまでは、mission_2-1と同じ。


//ここで削除機能を作る。
//最初のif構文(条件分岐)。パスワード付きで削除対象番号が投稿されたかどうかで分岐。
if(!empty($numeral) and !empty($pw_numeral)){
  $line=file($filename);//テキストファイルの中身を1行ずつ配列($line)に代入して、読み込む(取り出す)。
  $fp=fopen($filename,'w');//書き込み準備。同時にファイルの中身は空になっている。
   //ここからループを始める。
   foreach($line as $text){//$line(配列)の先頭から1行ずつ$textに代入。要素(テキストファイルの中身)の数だけ処理を繰り返す(ループ)。
   $contribution=explode("<>",$text);
	//二つ目のif構文(条件分岐)。パスワードが間違っているか
	if($numeral==$contribution[0] and $pw_numeral != $contribution[4]){//削除対象番号と投稿番号($contribution[0])が一致するが、パスワードが間違いの場合。
	  echo "パスワードが違います"."\n"."<br>";
	}//二つ目のif構文(条件分岐)閉じる
	//三つ目のif構文(条件分岐)。削除対象番号と投稿番号($contribution[0])が一致しない、またはパスワードが間違っている場合。
	if($numeral != $contribution[0] or $pw_numeral != $contribution[4]){
	  fwrite($fp,$contribution[0]."<>".$contribution[1]."<>".$contribution[2]."<>".$contribution[3]."<>".$contribution[4]."<>"."\n");//行の内容をファイルに書き込む。ここでは勝手に改行してくれるので、改行はいらない。
	}//三つ目のif構文(条件分岐)閉じる
   }//ループ終了
  fclose($fp);
}//最初のif構文(条件分岐)閉じる

//ここで編集した内容を上書きする機能をつける。
$edit_number=$_POST['edit_number'];//hiddenのフォームで受け取った編集対象番号。隠さないフォームの編集対象番号($editing)とは違う変数を用意する
$name=$_POST['name'];//名前
$comment=$_POST['comment'];//コメント
$password=$_POST['password'];//投稿フォームのパスワード
$editsentence=$edit_number."<>".$name."<>".$comment."<>".$date."<>".$password."<>"."\n";//編集したデータ。
//最初のif構文(条件分岐)。hiddenのフォームに編集対象番号があるか無いか
if(!empty($edit_number)){
  $line=file($filename);
  $fp=fopen($filename,'w');
   foreach($line as $text){
   $contribution=explode("<>",$text);
	//二つ目のif構文(条件分岐)。hiddenの編集対象番号と投稿番号が一致するか
	if($edit_number == $contribution[0]){
	fwrite($fp,$editsentence);//編集したデータを記入
	}else{
	fwrite($fp,$contribution[0]."<>".$contribution[1]."<>".$contribution[2]."<>".$contribution[3]."<>".$contribution[4]."<>"."\n");//元の内容を書き込む。
	}//二つ目のif構文(条件分岐)閉じる
   }//ループ閉じる
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