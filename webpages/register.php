<!--
	COSC 213 Final Project
	Taylor Morrow - 300189378
	Mike Dupree - 300182241
-->

<?php
	//Using finalProject database
	if (!(filter_input(INPUT_POST,'firstname')) || 
		!(filter_input(INPUT_POST,'lastname')) || 
		!(filter_input(INPUT_POST,'email')) || 
		!(filter_input(INPUT_POST, 'password')) ||
		!(filter_input(INPUT_POST, 'passwordcheck'))) {
			
			header("Location: ../register.html");
			exit;
	}
	
	$con = mysqli_connect("localhost","tmorrow","letmein","finalProject"); //connect to finalProject

	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$email = strtolower($_POST['email']);
	$passwd = $_POST['password'];
	$passwdchk = $_POST['passwordcheck'];
	
	$taremail= filter_input(INPUT_POST, 'email');

	$select_sql = "SELECT firstname, lastname FROM members WHERE email = '".$taremail."'";

	$select_res = mysqli_query($con, $select_sql) or die(mysqli_error($con));

	if(mysqli_num_rows($select_res) > 0){ //if the email is located in the table
		$display = "<h2>Your email address has already been used!</br>Please use a different email address.</h2>
					<a id='link' href=\"../register.html\">Return to the registration page!</a>";
	}
	else if($_POST['password'] != $_POST['passwordcheck']){
		$display = "<h2>Oops! Your password does not match what you originally put in.</br>Please try again.</h2>
					<a id='link' href=\"../register.html\">Return to the registration page!</a>";
	}
	else{
		mysqli_query($con,"INSERT INTO members (firstname, lastname, email, password)
						   VALUES ('$fname', '$lname', '$email', PASSWORD('$passwd'))");

		mysqli_commit($con);

		$display = "<h2>Thanks, ".$fname." ".$lname.", for signing up with Rebel Cloud Cantina!</h2></br>
				    <a id='link' href=\"../login.html\">Click here to return to the login page</a>";

		mkdir("C:/xampp/htdocs/FinalProject/members/$email", 0733, true); //creates a folder for each unique member
	}

	while ($info = mysqli_fetch_array($select_res)) {
		$f_name = stripslashes($info['firstname']);
		$l_name = stripslashes($info['lastname']);
	}

	mysqli_close($con);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Rebel Cloud Cantina</title>
		<link rel="stylesheet" type="text/css" href="../css/registerphp.css">
	</head>
	<body class = "bg">
		<div class="display">
			<?php echo "$display"; ?>
		</div>
	</body>
</html>