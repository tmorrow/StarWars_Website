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

	$con = mysqli_connect("localhost", "tmorrow", "letmein", "finalproject");

	$sql = "SELECT * FROM contact";
	$result = mysqli_query($con, $sql) or die(mysqli_error($con));

	$display = "<table border = \"1\" class='table'>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Message</th>
					</tr>";

	while($row = mysqli_fetch_array($result)){
		$id = $row['id'];
		$name = $row['username'];
		$email = $row['email'];
		$message = $row['message'];

		$display .= "<tr>
						<td>".$id."</td>
						<td>".$name."</td>
						<td>".$email."</td>
						<td>".$message."</td>
					</tr>";
	}

	$display .= "</table>";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Rebel Cloud Cantina</title>
		<link rel="stylesheet" type="text/css" href="../css/forms.css">
	</head>
	<body class="bg">
		<div id="form">
			<div class="display">
				<h1>Submitted Forms</h1>
				<?php echo "$display"; ?>
				<a id="link" href="main.php">Return to the main page</a></p>
			</div>
		</div>
	</body>
</html>
