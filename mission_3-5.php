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


//ここからは作成したテーブルにinsertを行いデータを入力、挿入する(ブラウザに表示されない)
$sql = $pdo -> prepare("INSERT INTO tbtest (id,name, comment) VALUES ('4',:name, :comment)");
$sql->bindParam(':name',$name,PDO::PARAM_STR);//bindParamの引数(:nameや:commentなど)は3-2でどのようなカラム(列:データの属性を表す)を設定したかで変える必要がある。
$sql->bindParam(':comment',$comment,PDO::PARAM_STR);
$name='kano-chang';
$comment='コメント追加③';//$nameと$comment(名前とコメント)は自分で決める
$sql->execute();

?>

</body>
</html>