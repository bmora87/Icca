<?php

$alert = '';

session_start();

if(!empty($_SESSION['active']))
{
	header('location: form2.php');

}else{

	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert = 'Enter your user name and password';
		}else{
			
			require_once "conexion.php";
		
			if ($_SERVER["REQUEST_METHOD"]=="POST") {
	
				
	
				$user = $_POST["usuario"];
				$pass = $_POST["clave"];
		                 
				$query = mysqli_query($conn, "SELECT * FROM users WHERE Account = '$user'");
				$result = mysqli_num_rows($query);

				if( $result > 0) {
					$row = mysqli_fetch_array($query);
					session_start();
					$_SESSION['active'] = true;
					$_SESSION['user'] = $row['Account'];
					$_SESSION['rol'] = $row['Rol'];
					$_SESSION['pass'] = $row['Pass'];
					
					header('location: form2.php');
				}else{
					$alert = "The user name does not have permission";
					session_destroy();
				}
			}
				
			
			$conn->close();
		} //del else
		
	} //del if
}
?>

<html>
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="css/style_Index.css">
		<title> Welcome to Icca </title>
		<link rel="shortcut icon" href="img/usa.png" type="image/x-icon">
	</head>
	<body>
		<section id="container">
		
			<form action="" method="post">
			
				<h3>Login</h3>
				<img src="img/usa.png" alt="Login">
				
				<input type="text" name="usuario" placeholder="User">
				<input type="password" name="clave" placeholder="Password">
				<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
				<input type="submit" value="Submit">
			
			</form>
		
		</section>
	</body>

</html>
