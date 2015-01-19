<!--
	COSC 213 Final Project
	Taylor Morrow - 300189378
	Mike Dupree - 300182241
-->

<?php 
	if (!(filter_input (INPUT_COOKIE, 'auth') == "1")) {
		header("Location: ../login.html");
		exit;
	}
	if (!(filter_input(INPUT_POST, 'username')) ||
		!(filter_input(INPUT_POST, 'email')) ||
		!(filter_input(INPUT_POST, 'message'))){

			header("location: ../contact.html");
			exit;
	}

	$type = $_POST['type'];
	$name = $_POST['username'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$con = mysqli_connect("localhost", "tmorrow", "letmein", "finalproject");

	mysqli_query($con, "INSERT INTO contact (id, username, email, message) VALUES (NULL,'$name','$email','$message')");
	mysqli_commit($con);

	$display = "";

	if($type == "Feedback"){
		$display .="<h2 id='h2'>Thank you for the feedback!</br>This is what your message looks like:</h1>
					<div id='main'>
						<div id='form'>
							<label class=\"f1\">Name: ".$name."</label></br>
							<label class=\"f2\">Email: ".$email."</label></br>
						 	<label class=\"f3\">Message: ".$message."</label></br>
						</div>
					</div>";
	}

	elseif($type == "Complaint"){
		$display .= "<h2 id='h2'>Your complaint has been registered.</br>Thank you for letting us know how you feel.</h1>
					 <div id='main'>
					 	<div id='form'>
							<label class=\"f1\">Name: ".$name."</label></br>
							<label class=\"f2\">Email: ".$email."</label></br>
						 	<label class=\"f3\"><b>Message:</b> ".$message."</label></br>
						</div>
					</div>";
	}

	mysqli_close($con);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $type ?> Submission</title>
		<link rel="stylesheet" type="text/css" href="../css/contactphp.css">
	</head>
	<body id="bg">
		<div>
			<div>
				<?php echo "$display" ?>
			</div>
		</div>
		<a id="link" href="main.php">Return to the main page</a>
	</body>
</html>