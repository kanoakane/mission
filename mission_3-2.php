<?php
//これらはPHP領域に記載する。このミッションで行う、データベースへの接続はmission3-2以降も必要。
//$dsnの式の中は、半角スペースもNG。
$dsn='データベース名';//データベース名とホストを指定。
$user='ユーザー名';//ユーザー名を指定
$password='パスワード';//パスワードを指定
$pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
//(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)とは、データベース操作で発生したエラーを警告として表示してくれる設定をするための要素。これはつけておく。


//ここからはテーブル作成をする。この際には『createコマンド』を使う。
$sql="CREATE TABLE IF NOT EXISTS tbtest"
."("
."id INT,"
."name char(32),"
."comment TEXT"
.");";
$stmt=$pdo->query($sql);
//『IF NOT EXISTS』を入れないと2回目以降にこのプログラムを呼び出した際に、すでに存在するテーブルを作成しようとしたときに発生するエラーが出る。
?>