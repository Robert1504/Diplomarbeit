<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<h3>Configuration for your Emergency-Wristband:</h3>
		<h4>Sim Card Details:</h4>
	</head>
	<body>
		<form action="sim_card_check.php">
			<label for="sim_card_detected">Status:</label><br>
			<input type="text" value="enter pin-code" id="sim_card_detected">
			<input type="submit" value="check">
			<br>
		</form>
		<script>
			$(document).ready(function() {
				setInterval(function() {
					$('#connection').load("connection_a_f.php");
				},100);
			});
		</script>
		<div id="connection"></div></br>
	</body>
</html>