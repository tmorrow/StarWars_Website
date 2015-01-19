<!--
	COSC 213 Final Project
	Taylor Morrow - 300189378
	Mike Dupree - 300182241
-->

<?php 
	if (filter_input (INPUT_COOKIE, 'auth') == "1") {
		$display = "<h2>Sorry! This webpage is currently under construction...</h2>";
	} else {
		header("Location: ../login.html");
		exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Rebel Cloud Cantina</title>
	</head>
	<body>
		<?php echo "$display"; ?>
		<a href="main.php">Return to the main page</a></p>
	</body>
</html>
