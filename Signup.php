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
			Gentag Kode:<br>
			<input type="text" name="check_kode"><br>
			<input type="submit" name="submit" value="Signup">
		</form>
	</body>
</html>
<?php
include("connect_mysql.php");
if(isset($_POST["submit"]))
{
	$brugernavn = htmlentities($_POST["brugernavn"]);
	$kode = htmlentities($_POST["kode"]);
	$check_kode = htmlentities($_POST["check_kode"]);
	
	unset($_POST["brugernavn"]);
	unset($_POST["kode"]);
	unset($_POST["check_kode"]);
	unset($_POST["submit"]);
	
	$sql = "SELECT brugernavn FROM accounts WHERE brugernavn='".$brugernavn."'";
	$result = $conn->query($sql);
	
	if ($result->num_rows == 0)
	{
		if($kode == $check_kode)
		{
			if($stmt = $conn->prepare("INSERT INTO accounts (brugernavn, kode) VALUES (?, ?)"))
			{
				$stmt->bind_param("ss", $brugernavn, $kode);
				$stmt->execute();
				$stmt->close();
				header("login.php");
			}
			else{
				echo "Could not prepare sql statement";
			}
		}
		else{
			echo "Kode og Gentag Kode er ikke ens";
		}
	}
	else{
		echo "Brugernavn er alerede taget";
	}
}
?>