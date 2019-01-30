<html>
<head>	
<meta charset="UTF-8">
</head>
<body>

<?php
//これらはPHP領域に記載する。このミッションで行う、データベースへの接続はmission3-2以降も必要。
//$dsnの式の中は、半角スペースもNG。
$dsn='データベース名';//データベース名とホストを指定。
$user='ユーザー名';//ユーザー名を指定
$password='パスワード';//パスワードを指定
$pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
//(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)とは、データベース操作で発生したエラーを警告として表示してくれる設定をするための要素。これはつけておく。

//ここからは入力したデータををupdateによって編集、更新する。
$id=1;//今回は、『id』が『1』であるものを編集する
$name="akane";
$comment="コメント変更";//$nameと$comment(変更する名前とコメント)は自分で決める。
$sql='update tbtest set name=:name,comment=:comment where id=:id';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':name',$name,PDO::PARAM_STR);//bindParamの引数(:nameや:commentなど)は3-2でどのようなカラムを設定したかで変える必要がある。
$stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();


//ここからは入力したデータをselectによって表示する。(編集がちゃんと行われているか確認する)
$sql='SELECT * FROM tbtest';
$stmt=$pdo->query($sql);
$results=$stmt->fetchAll();
foreach($results as $row){
 //$rowの中にはテーブルのカラム(列:データの属性を表す)の名前が入る。
echo $row['id'].',';//$rowの添字([]の中)は3-2でどのような名前のカラムを設定したかで変える必要がある。
echo $row['name'].',';
echo $row['comment'].'<br>';
}


?>

</body>
</html>