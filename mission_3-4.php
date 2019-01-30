<?php
//これらはPHP領域に記載する。このミッションで行う、データベースへの接続はmission3-2以降も必要。
//$dsnの式の中は、半角スペースもNG。
$dsn='データベース名';//データベース名とホストを指定。
$user='ユーザー名';//ユーザー名を指定
$password='パスワード';//パスワードを指定
$pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
//(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)とは、データベース操作で発生したエラーを警告として表示してくれる設定をするための要素。これはつけておく。


//ここからは、意図した内容のテーブルが作成されているか確認する(作成したテーブルの詳細確認)。
$sql='SHOW CREATE TABLE tbtest';
$result=$pdo->query($sql);
foreach($result as $row){
echo $row[1];
}
echo "<hr>";

?>