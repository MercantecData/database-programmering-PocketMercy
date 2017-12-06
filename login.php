<?php
session_start();
?>
<html>
	<head>
	</head>
	<body>
		<form method="post">
			  Brugernavn:<br>
			  <input type="text" name="brugernavn"><br>
			  Kode:<br>
			  <input type="text" name="kode"><br>
			  <input type="submit" name="submit" value="Login">
		</form>
		<button><a href="Signup.php">Signup</a></button>
	</body>
</html>
<?php
	include("connect_mysql.php");
	
	if (isset($_POST["submit"]))
	{
		$brugernavn = htmlentities($_POST["brugernavn"]);
		$kode = htmlentities($_POST["kode"]);
		
		if ($stmt = $mysqli->prepare("SELECT id FROM accounts WHERE brugernavn=?, kode=? LIMIT 1"))
		{
			$stmt->bind_param("ss", $brugernavn, $kode);
			$stmt->execute();
			$stmt->bind_result($_SESSION["login_id"]);
			$stmt->fetch();
			$stmt->close();
			
			header("Velkommen.php");
		}
	}
?>