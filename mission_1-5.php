<html>
<head>	
<meta charset="UTF-8">
</head>
<body>
<form method="POST" action="mission_1-5.php">
<input type="text"name="comment"value="">　　　　<!-『name=""』の中身は、『$_POST['']』の中身と同じになればいいので、特に指定は無い。->
<input type="submit"value="送信">
</form>

<?php
//何度も使う値は、はじめに変数を決めておき、代入する。
$comment=$_POST['comment'];
$date=date(Y年m月d日H時i分);
$filename='mission_1-5_(Kano).txt';   //変数$filename='ファイル名.txt'とする。

if($comment=="完成！"){    //『if()』で、「もし()ならば」の意味。『if(!)』で、「もし()でないのなら」の意味。
         //↑「等しい(=)」の意味を差すには、『==(イコールマークが二つ)』必要。
 $fp=fopen($filename,'w'); //$fp=fopen(ファイル名の変数｛今回は$filename｝,'w')でテキストファイルを開く。'w'は書き込みモードを指す
 fwrite($fp,$comment);     //開いたテキストファイル($fp)に$commentと書き込む。//変数は、''や""で囲まない。
 fclose($fp);
 echo "おめでとう！";
}elseif(!empty($_POST['comment'])){  //『elseif()』で、前述の『if()』の条件に当てはまらなかった場合の条件を提示。
        //↑『empty(変数)』で、その変数に値がちゃんと代入されているか調べる。そして、『if(empty(変数))』は変数に値が代入されていない場合の対応を表記。
 $fp=fopen($filename,'w');    //今回は、『!empty(変数)』なので、その後は変数に値が代入されている場合の対応を表記。
 fwrite($fp,$comment);  //変数は、''や""で囲まない。
 fclose($fp);
 echo "ご入力ありがとうございます。<br>";
 echo $date. "に".$comment."を受け付けました。";        //受け取った値を表示する
}
?>
</body>
</html>


