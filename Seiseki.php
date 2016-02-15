<?php

echo "【成績管理業務】"
	
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset = "utf-8">
<title>Check seiseki</title>
</head>
<body>
<form action="" method="get">
<input name="seiseki" type="radio" value="1">一覧表示<br>
<input name="seiseki" type="radio" value="2">成績データ登録<br>
<input name="seiseki" type="radio" value="3">成績データ修正<br>
<input name="seiseki" type="radio" value="4">成績データ削除<br>
<input name="seiseki" type="radio" value="5">成績データソート<br>
<input type="submit" value="選択"><br>
</form>
</body>
</html>
<?php
	if(empty($_GET["seiseki"])){
   	  echo "処理区分を選択してください。<br>";
	}else{
   	  $choice = $_GET["seiseki"];
      switch($choice){
     	case 1:
     	    view();
     		echo "<br>成績一覧です。<br>";
     		break;
     	case 2:
     		view();
     		echo "<br>追加する成績を入力して追加を押してください。<br>";
     		addsets();
     		break;
     	case 3:
     		view();
     		echo "<br>どの学番を修正するか入力して修正ボタンを押してください。<br>";
     		editsets();
     		break;
     	case 4:
     		view();
     		echo "<br>どの学番を削除するか入力して削除ボタンを押してください。<br>";
     		removesets();
     		break;
     	case 5:
     		view();
     		echo "<br>何順にソートするか選択してソートボタンを押してください。<br>";
     		sortsets();
     		break;
     	default:
     		echo "何かがおかしいようです。";
     		break;
 	    }
	}
     function view(){
     	$lines = file('seiseki.csv');
     	foreach($lines as $line){
     		$datas = split(',',$line);//splitした配列
     		for($i=0;$i<count($datas);$i++){
     			if(strlen($datas[$i]) == mb_strlen($datas[$i])){ //半角文字の時
     				for($j=strlen($datas[$i]);$j<10;$j++){
     					$datas[$i] = $datas[$i]."&nbsp";
     				}
     				echo "$datas[$i]";
     			}else{								   //マルチバイトの時
     				for($j=strlen($datas[$i]);$j<10;$j++){
     					$datas[$i] = $datas[$i]."&nbsp";
     				}
     				echo "$datas[$i]";
     			}
     		}
     		echo "<br>";
     	}
     }
     
     function removesets(){
			echo '<form action="" method="POST">';
     		echo '<input type = "text" name = "removeno" placeholder="削除する学番"><br>';
    		echo '<input type="submit" value="追加"><br>';
    		echo '</form>';
     }
     function editsets(){
			echo '<form action="" method="POST">';
     		echo '<input type = "text" name = "editno" placeholder="編集する学番"><br>';
     		echo '<input type="submit" value="追加"><br>';
    		echo '</form>';
     }
     function addsets(){
     		echo '<form action="" method="POST">';
     		echo '<input type = "text" name = "gakuban" placeholder="学番"><br>';
			echo '<input type = "text" name = "shimei" placeholder="氏名"><br>';
			echo '<input type = "text" name = "kokugo" placeholder="国語"><br>';
			echo '<input type = "text" name = "sansu" placeholder="算数"><br>';
			echo '<input type = "text" name = "rika" placeholder="理科"><br>';
			echo '<input type = "text" name = "shakai" placeholder="社会"><br>';
			echo '<input type = "text" name = "eigo" placeholder="英語"><br>';
    		echo '<input type="submit" value="追加"><br>';
    		echo '</form>';
     }
     
     function sortsets(){
		echo '<form action="" method="get">';
		echo '<input name="sort" type="radio" value="1">学番<br>';
		echo '<input name="sort" type="radio" value="2">国語<br>';
		echo '<input name="sort" type="radio" value="3">算数<br>';
		echo '<input name="sort" type="radio" value="4">理科<br>';
		echo '<input name="sort" type="radio" value="5">社会<br>';
		echo '<input name="sort" type="radio" value="6">英語<br>';
        echo '<input name="sort" type="radio" value="7">合計<br>';
        echo '<input type="submit" value="ソート"><br>';
        echo '</form>';
     }
	
	//removeの処理
	//番号存在するかチェック→確認ボタンを表示
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$removeno = $_POST['removeno'];
		
	}
	
	//editの処理
	//番号存在するかチェック→編集項目を表示
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$editno = $_POST['editno'];
		
		
	}
	
	//addの処理
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		//テキストボックスの内容を取得
		$gakuban = $_POST['gakuban'];
		$shimei = $_POST['shimei'];
		$kokugo = $_POST['kokugo'];
		$sansu = $_POST['sansu'];
		$rika = $_POST['rika'];
		$shakai = $_POST['shakai'];
		$eigo = $_POST['eigo'];
		$numchk = true;
		
		$lines = file('seiseki.csv');
		foreach($lines as $line){
     		$datas = split(',',$line);//splitした配列
			if($gakuban == $datas[0]){
				$numchk = false;
				echo "同じ学番が存在します。";
			}
     	}	
		
		if($gakuban>100 || $gakuban<0){
			$numchk = false;
			echo "学番は000~100の範囲の数字でなければいけません。<br>";
		}
		if(strlen($gakuban)!=3){
			$numchk = false;
			echo "学番は3ケタの数字でなければいけません。<br>";
		}
		if(ctype_digit($gakuban)==false){
			$numchk = false;
			echo "学番には数字を入力してください。<br>";
		}
		if($kokugo>100 || $kokugo<0){
			$numchk = false;
			echo "国語の成績は0~100の範囲の数字でなければいけません。<br>";
		}
		if(ctype_digit($kokugo)==false){
			$numchk = false;
			echo "国語の成績には数字を入力してください。<br>";
		}
		if($sansu>100 || $sansu<0){
			$numchk = false;
			echo "算数の成績は0~100の範囲の数字でなければいけません。<br>";
		}
		if(ctype_digit($sansu)==false){
			$numchk = false;
			echo "算数の成績には数字を入力してください。<br>";
		}
		if($rika>100 || $rika<0){
			$numchk = false;
			echo "理科の成績は0~100の範囲の数字でなければいけません。<br>";
		}
		if(ctype_digit($rika)==false){
			$numchk = false;
			echo "理科の成績には数字を入力してください。<br>";
		}
		if($shakai>100 || $shakai<0){
			$numchk = false;
			echo "社会の成績は0~100の範囲の数字でなければいけません。<br>";
		}
		if(ctype_digit($shakai)==false){
			$numchk = false;
			echo "社会の成績には数字を入力してください。<br>";
		}
		if($eigo>100 || $eigo<0){
			$numchk = false;
			echo "英語の成績は0~100の範囲の数字でなければいけません。<br>";
		}
		if(ctype_digit($eigo)==false){
			$numchk = false;
			echo "英語の成績には数字を入力してください。<br>";
		}
		if($numchk){
			$file = "seiseki.csv";
			$adddata = "\n$gakuban,$shimei,$kokugo,$sansu,$rika,$shakai,$eigo";
			file_put_contents($file,$adddata,FILE_APPEND);
		}else{
			echo "追加に失敗しました。<br>";
		}
	}
?>