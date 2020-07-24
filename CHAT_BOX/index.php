<?php
$error = false;
$msg = false;
require_once('pdo.php');
	if( isset($_POST['User']) || isset($_POST['DoB'])){
		if(strlen($_POST['User'])>1 || strlen($_POST['DoB'])>1){
				$sql = "INSERT INTO student (username, dob)
						VALUES (:name, :Dob)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(
					':name' => htmlentities($_POST['User']),
					':Dob' => $_POST['DoB']
				));
				$sql2 = 'SELECT student_id FROM student WHERE username = :name';
				$stmt2 = $pdo->prepare($sql2);
				$stmt2->execute(array(
					':name' => $_POST['User']
				));
				$rows = $stmt2->fetch(PDO::FETCH_ASSOC);
				header('Location: 1.php?id='.$rows[student_id]);
					
				}
				else{
				$error = "All Feilds Are Required";
				}
		}
		
		
?>

<html>
<head>
	<title>Login Page</title>
	<style>
		*{
			box-sizing:border-box;
		}
		body{
			font-family:arial;
			font-size:24px;
		}
		label{
			display:inline-block;
			width:15%;
		}
		span{
			color:red;
		}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Welcome To The Login Portal</h1>
<?php
	if($error!==false){
		echo "<span>".$error."</span>";
	}
?>
	<form method="post">	
		<label for="email">User_name : </label>
		<input type="text" name="User" id="email"><br/><br/>
		<label for="dob">DOB : </label>
		<input type="date" name="DoB" id="dob"><br/><br/>
		<input type="submit"  id="submit">
	</form>
	<?php
		if($msg!==false){
			echo $msg;
		}
	?>
</body>
</html>