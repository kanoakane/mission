<?php
//変数＝mission1－2で作ったテキストファイル（.txt）を関数で読み込む
$contents=file_get_contents("mission_1-2.txt");
//変数をブラウザで表示する
echo $contents;
?>