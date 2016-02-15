<?php

 echo "2001<br>";
 echo "平<br>";
 echo "2.72838<br>";
 echo "false<br>";
 
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
	//テキストボックスusernameの内容を取得
	$username = $_POST['username'];
	$err = false;
	if(strlen($username)>8){
		$err = true;
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset = "utf-8">
	<title>Check username</title>
</head>
<body>
<form action="" method="POST">
	<input type = "text" name = "username" placeholder="user name" 
	value="<?php echo htmlspecialchars($username,ENT_QUOTES,'UTF-8');?>">
	<input type="submit" value="check!">
	<?php 
		if($err){
			echo "しょうがないにゃあ";
		}
	 ?>
</form>
</body>
</html>