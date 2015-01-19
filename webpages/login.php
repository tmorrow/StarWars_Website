<!--
	COSC 213 Final Project
	Taylor Morrow - 300189378
	Mike Dupree - 300182241
-->

<?php
	if (!(filter_input(INPUT_POST,'email')) || 
		!(filter_input(INPUT_POST, 'password'))) { //check if both fields have text

		header("Location: ../login.html");
		exit;
	}
	
	$con = mysqli_connect("localhost", "tmorrow", "letmein", "finalproject"); //connect to finalProject

	$taremail = filter_input(INPUT_POST, 'email');
	$tarpasswd = filter_input(INPUT_POST, 'password');

	$sql = "SELECT email, password FROM members WHERE email = '".$taremail."'
			AND password = PASSWORD('$tarpasswd')";

	$result = mysqli_query($con, $sql) or die(mysqli_error($con));
	
	if(mysqli_num_rows($result) == 1){

		setcookie("auth", "1", time()+60*30, "/", "", 0); //create cookie for the logged in user	
		header("Location: main.php");

	} else {
		$display = "<div id='form'>
						<h2>This account is not registered!</br>Please make sure to register before trying to log in.</h2>
						<a id='link' href=\"../register.html\">Register here!</a>
						<a id='link' href=\"../login.html\">Login page</a>
					</div>";				
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rebel Cloud Cantina</title>
		<link rel="stylesheet" type="text/css" href="../css/loginphp.css">
	</head>
	<body class="bg">
		<div class="display">
			<?php echo "$display"; ?>
		</div>	
	</body>
</html>
