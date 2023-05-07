<?php
	// Function to generate a random PNR
	function generatePNR() {
		return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
	}

	// Check if the form has been submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// Get the user's information from the form
		$fullname = $_POST["fullname"];
		$age = $_POST["age"];
		$journey_date = $_POST["journey_date"];
		$train_name = $_POST["train_name"];
		$train_number = $_POST["train_number"];
		$pnr = generatePNR();
		
		// Write the user's information to an Excel sheet
		$fp = fopen('bookings.csv', 'a');
		fputcsv($fp, array($fullname, $age, $journey_date, $train_name, $train_number, $pnr));
		fclose($fp);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ticket Booking System - Booking Confirmation</title>
	<script type="text/javascript">
		function printTicket() {
			window.print();
		}
	</script>
</head>
<body>
	<h1>Booking Confirmation</h1>
	<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
		<p>Your ticket has been booked!</p>
		<table>
			<tr>
				<td>Passenger Full Name:</td>
				<td><?php echo $fullname; ?></td>
			</tr>
			<tr>
				<td>Passenger Age:</td>
				<td><?php echo $age; ?></td>
			</tr>
			<tr>
				<td>Date of Journey:</td>
				<td><?php echo $journey_date; ?></td>
			</tr>
			<tr>
				<td>Train Name:</td>
				<td><?php echo $train_name; ?></td>
		</tr>
		<tr>
			<td>Train Number:</td>
			<td><?php echo $train_number; ?></td>
		</tr>
		<tr>
			<td>PNR:</td>
			<td><?php echo $pnr; ?></td>
		</tr>
	</table>
<?php else: ?>
	<p>No booking has been made yet.</p>
<?php endif; ?>
<br><br>
<button onclick="printTicket()">Print Ticket </button>
</body>
</html>
