<?php
$filename='mission_1-2(Kano).txt';   //変数$filename='ファイル名.txt'とする。
$fp=fopen($filename,'w');   //$fp=fopen(ファイル名の変数｛今回は$filename｝,'w')でテキストファイルを開く。'w'は書き込みモードを指す。
fwrite($fp,'test');  //開いたテキストファイル($fp)にtestと書き込む。
fclose($fp);  //テキストファイルを閉じる。
?>