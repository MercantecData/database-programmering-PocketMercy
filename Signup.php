<?php
session_start();
?>
<html>
	<head>
	</head>
	<body>
		<form method="post">
			<?php if(isset($error)){ echo "<p style='color: red;'>Error: ".$error."</p><br>";}?>
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
	
	$sql = "SELECT * FROM accounts WHERE brugernavn=".$brugernavn."";
	$result = $conn->query($sql);

	if ($result->num_rows = 0)
	{
		if($kode = $check_kode)
		{
			if($stmt->prepare("INSERT INTO accounts (brugernavn, kode) VALUES(?,?)"))
			{
				$stmt->bind_param("ss", $brugernavn, $kode);
				
				if($stmt->execute())
				{
					header("login.php");
				}
				$stmt->close();
			}
			else{
				$error = "Could not prepare sql statement";
			}
		}
		else{
			$error = "Kode og Gentag Kode er ikke ens";
		}
	}
	else{
		$error = "Brugernavn er alerede taget";
	}
}
?>