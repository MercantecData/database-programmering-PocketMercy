<?php
session_start();
?>
<html>
	<head>
	</head>
	<body>
		<div class="header">
			<p>Velkommen</p>
		</div>
		
		<div class="logedin">
			<?php
				include("connect_mysql.php");
				if (isset($_SESSION["logedin_id"]))
				{
					$stmt = $mysqli->prepare("SELECT brugernavn FROM accounts WHERE id=? LIMIT 1");
					$stmt->bind_param("i", $_SESSION["logedin_id"]);
					$stmt->execute();
					$stmt->bind_result($bruger);
					$stmt->fetch();
					$stmt->close();
					
					echo "<p>Loged in as ".$bruger."</p>";
				}
				else
				{
					echo "<a href='login.php'>Login</a>";
				}
			?>
		</div>
	</body>
</html>