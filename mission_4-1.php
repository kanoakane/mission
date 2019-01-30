<html>
<head>	
<meta charset="UTF-8">
</head>
<body>

<?php
//データベースへの接続
//$dsnの式の中は、半角スペースもNG。
$dsn='データベース名';//データベース名とホストを指定。
$user='ユーザー名';//ユーザー名を指定
$password='パスワード';//パスワードを指定
$pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
//(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)とは、データベース操作で発生したエラーを警告として表示してくれる設定をするための要素。これはつけておく。


//ここからはテーブル作成をする。この際には『createコマンド』を使う。今回のテーブルの名前は「katable」
$sql="CREATE TABLE IF NOT EXISTS katable"
."("
."id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,"
."name char(32),"
."comment TEXT,"
."report_time char(32),"
."password char(32)"
.");";//(32)は文字数。
$stmt=$pdo->query($sql);
//『IF NOT EXISTS』を入れないと2回目以降にこのプログラムを呼び出した際に、すでに存在するテーブルを作成しようとしたときに発生するエラーが出る。
//『INT AUTO_INCREMENT NOT NULL PRIMARY KEY』で投稿番号(id)を自動で取得。他の機能(投稿機能など)では記載しない
//『report_time』が投稿時刻。


//ここに編集する投稿を選択し、フォームに表示する機能をつける。
$editing=$_POST['editing'];//編集対象番号
$pw_editing=$_POST['pw_editing'];//編集フォームのパスワード
if(!empty($editing) and !empty($pw_editing)){
  $sql='SELECT * FROM katable WHERE id=:id';
  $stmt=$pdo->prepare($sql);
  $stmt->bindParam(':id',$editing,PDO::PARAM_INT);
  $stmt->execute();
  $results=$stmt->fetchAll();
  $editingrow=$results[0];
	if($pw_editing==$editingrow["password"]){
	  $hidden_editing=$editingrow["id"];
	  $editingname=$editingrow["name"];
	  $editingcomment=$editingrow["comment"];
	  $editingpassword=$pw_editing;
	}else{
	?><h3>パスワードが間違っています。</h3><?php
	}
}
?>


<form method="POST" action="mission_4-1.php">
<input type="hidden" name="edit_number" value="<?php echo $hidden_editing; ?>"><br>  <!-編集したい投稿番号を表示する(あとでhiddenで隠し、ブラウザには表示され値いようにする。name属性は"editing"とは違うものにする)->
名前<input type="text" name="name" value="<?php echo $editingname; ?>"><br>
コメント<input type="text" name="comment" value="<?php echo $editingcomment; ?>"><br>
パスワード<input type="text" name="pass" value="<?php echo $editingpassword; ?>">
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
//新規投稿機能
if(!empty($_POST['name']) and !empty($_POST['comment']) and !empty($_POST['pass']) and empty($_POST['edit_number'])){//パスワード付きで投稿が行われているかどうか。かつhiddenの編集番号欄が空白か。
  $sql = $pdo -> prepare("INSERT INTO katable (name,comment,report_time,password) VALUES (:name,:comment,:report_time,:password)");
  $name=$_POST['name'];//名前
  $comment=$_POST['comment'];//コメント
  $date=date("Y年m月d日H時i分s秒");//投稿日時
  $pass=$_POST['pass'];//投稿フォームのパスワード
  $sql->bindParam(':name',$name,PDO::PARAM_STR);//bindParamの引数(:nameや:commentなど)は3-2でどのようなカラム(列:データの属性を表す)を設定したかで変える必要がある。
  $sql->bindParam(':comment',$comment,PDO::PARAM_STR);
  $sql->bindParam(':report_time',$date,PDO::PARAM_STR);
  $sql->bindParam(':password',$pass,PDO::PARAM_STR);
  $sql->execute();
}


//削除機能
$numeral=$_POST['numeral'];//削除対象番号
$pw_numeral=$_POST['pw_numeral'];//削除フォームのパスワード
$sql='SELECT password FROM katable WHERE id=:id';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':id',$numeral,PDO::PARAM_INT);
$stmt->execute();
$results=$stmt->fetch(PDO::FETCH_ASSOC);

if(!empty($numeral) and !empty($pw_numeral)){//一つ目の条件分岐
	if($pw_numeral==$results["password"]){//二つ目の条件分岐
	  $sql='delete from katable where id=:id';
	  $stmt=$pdo->prepare($sql);
	  $stmt->bindParam(':id',$numeral,PDO::PARAM_INT);
	  $stmt->execute();
	}else{
	?><h3>パスワードが間違っています。</h3><?php
	}//二つ目の条件分岐閉じる
}//一つ目の条件分岐閉じる


//編集実行機能。
$edit_number=$_POST['edit_number'];//hiddenのフォームで受け取った編集対象番号。隠さないフォームの編集対象番号($editing)とは違う変数を用意する
$name=$_POST['name'];//名前
$comment=$_POST['comment'];//コメント
$date=date("Y年m月d日H時i分s秒");//投稿日時
$pass=$_POST['pass'];//投稿フォームのパスワード

if(!empty($edit_number)){
  //echo "分岐１";
  //echo $edit_number;
  $sql='update katable set id=:id,name=:name,comment=:comment,report_time=:report_time,password=:password where id=:id';
  $stmt=$pdo->prepare($sql);
  $stmt->bindParam(':id',$edit_number,PDO::PARAM_INT);
  $stmt->bindParam(':name',$name,PDO::PARAM_STR);//bindParamの引数(:nameや:commentなど)は3-2でどのようなカラム(列:データの属性を表す)を設定したかで変える必要がある。
  $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
  $stmt->bindParam(':report_time',$date,PDO::PARAM_STR);
  $stmt->bindParam(':password',$pass,PDO::PARAM_STR);
  $stmt->execute();
}


//ブラウザに表示
$sql='SELECT * FROM katable ORDER BY id ASC';
$stmt=$pdo->query($sql);////
$results=$stmt->fetchAll();////
foreach($results as $row){
 //$rowの中にはテーブルのカラム(列:データの属性を表す)の名前が入る。
echo $row['id'].',';//$rowの添字([]の中)は3-2でどのような名前のカラムを設定したかで変える必要がある。
echo $row['name'].',';
echo $row['comment'].',';
echo $row['report_time'].'<br>';
}

?>

</body>
</html>