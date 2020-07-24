<?php
require_once('pdo.php');
	if(isset($_GET['id'])){
		$sql = "SELECT username FROM student WHERE student_id = :name";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			':name' => $_GET['id']
		));
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		$name = $rows['username'];
	}
	if(isset($_POST['messages']) && isset($_POST['chat'])){
		$messages = $_POST['messages'];
		$file = 'chat.txt';
		$filenew = fopen('chat.txt','a+');
		fwrite($filenew,$name." : ".$messages." ______".date(DATE_RFC2822).'.');
		fclose($filenew);
		header('Location: 1.php?id='. $_GET['id']);
		return;
		
	}
		$file2 = fopen('chat.txt','r');
		$content = fread($file2,filesize('chat.txt'));
		
	if($content !== ""){
		$main = str_replace('.',"<br/>",$content);
		echo $main;
	}
	if(isset($_POST['Refresh'])){
		header('Location: 1.php?id='. $_GET['id']);
		return;
	}
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<h1>Chat</h1>
	<form method='post' >
		<p>
			<input type="text" name="messages" size='60'>
			<input type='submit' value="chat" name="chat">
			<input type='submit' name='Refresh' value='Refresh'>
		</p>
	</form>
</body>
</html>