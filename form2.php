<?php
session_start();

if(empty($_SESSION['active']))
{
	header('location: index.php');

}

if($_SESSION['rol'] == 'Administrator')
	header('location: form3.php');

?>

<html>
	<head>
		<meta charset="UTF-8"/>
		<title> Welcome to Icca </title>
		<link rel="shortcut icon" href="img/usa.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style_formu.css">
	</head>
	<body>

		<header>
			<div class="header">

			<h1>ICCA</h1>
			<div class="optionsBar">
				<p><?php echo $_SESSION['user']; ?></p>
				<span class="b">|</span>
				<span class="user">exit</span>
				<a href="exit.php"><img class="exit" src="img/salir.png" alt="exit" title="Exit"></a>
			</div>
		</div>

		</header>
		<section id="container">

			<form method="post" action="form2.php">
				<h3>Enter the hostname</h3>
				<input type="text" name="hostname" placeholder="Hostname" required><br><br>
				<table>
					<tr>
						<th>Hostname</th>
						<th>User</th>
						<th>Password</th>
					</tr>
					<?php
					include "conexion.php";
					if ($_SERVER["REQUEST_METHOD"]=="POST") {

						$hostname = $_POST["hostname"];
						$query = mysqli_query($conn, "SELECT * FROM workstations WHERE Hostname LIKE '%{$hostname}%' LIMIT 6");
						$result = mysqli_num_rows($query);
						if($result == 6){
						 $alert= 'Displaying the first items of the table, please enter the entire hostname';
						}
						session_start();
						while( $row = mysqli_fetch_array($query)) {

					?>

						<tr>
							<td><?php echo $row[0] ?> </td>
							<td><?php echo $row[1] ?> </td>
							<td><?php echo $row[2] ?> </td>
						</tr>
					<?php
						}
						$conn->close();
					}
					?>

				</table>
				<br />
				<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
				<input type="submit" value="Get Password">
				<img class="Ria" src="img/usa.png" alt="Ria" >
			</form>
		</section>

</body>

</html>

