<?php
//これらはPHP領域に記載する。このミッションで行う、データベースへの接続はmission3-2以降も必要。
//$dsnの式の中は、半角スペースもNG。
$dsn='データベース名';//データベース名とホストを指定。
$user='ユーザー名';//ユーザー名を指定
$password='パスワード';//パスワードを指定
$pdo= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
//(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)とは、データベース操作で発生したエラーを警告として表示してくれる設定をするための要素。これはつけておく。


//ここからは、作成したテーブル一覧を表示する。
$sql='SHOW TABLES';//mission3-2で『tbtest』というテーブルを作成したので、ブラウザに『tbtest』と表示される
$result=$pdo->query($sql);
foreach($result as $row){
echo $row[0];
echo '<br>';
}
echo "<hr>";//<hr>で区切りの見栄えのために水平線を引く。
?>