<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

// Check if flight_number is provided in the query parameters
if (!isset($_GET['flight_number'])) {
    header('Location: dashboard.php');
    exit();
}

// Get flight_number from the query parameters
$flightNumber = $_GET['flight_number'];

// Process the search criteria (replace with actual search logic)
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';

// You can fetch flight details from the database based on the flightNumber
// In this example, we use hardcoded data for demonstration purposes
$flightDetails = array(
    'flight_number' => $flightNumber,
    'from' => $from,
    'to' => $to,
    'departure_date' => '2023-12-10',
    'departure_time' => '08:00 AM',
    'fare' => '$200',
);

// Mock payment process
$paymentSuccessful = isset($_POST['payment']) && $_POST['payment'] === 'success';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .flight-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .payment-form {
            margin-top: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back-to-dashboard {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
		
		a[href="dashboard.php"] {
				color: white;
			}
    </style>
    <title>Mock Payment Page</title>
</head>
<body>
    <div class="container">
        <h1>Flight Ticket Payment</h1>

        <?php if ($paymentSuccessful): ?>
            <div class="flight-details">
                <h2>Payment successful! Your flight is booked.</h2>
                <p><strong>Flight Details:</strong></p>
                <p><strong>Flight Number:</strong> <?php echo htmlspecialchars($flightDetails['flight_number']); ?></p>
                <p><strong>From:</strong> <?php echo htmlspecialchars($flightDetails['from']); ?></p>
                <p><strong>To:</strong> <?php echo htmlspecialchars($flightDetails['to']); ?></p>
                <p><strong>Departure Date:</strong> <?php echo htmlspecialchars($flightDetails['departure_date']); ?></p>
                <p><strong>Departure Time:</strong> <?php echo htmlspecialchars($flightDetails['departure_time']); ?></p>
                <p><strong>Fare:</strong> <?php echo htmlspecialchars($flightDetails['fare']); ?></p>
            </div>
        <?php else: ?>
            <div class="flight-details">
                <h2>Payment failed. Please try again.</h2>
                <p><strong>Flight Details:</strong></p>
                <p><strong>Flight Number:</strong> <?php echo htmlspecialchars($flightDetails['flight_number']); ?></p>
                <p><strong>From:</strong> <?php echo htmlspecialchars($flightDetails['from']); ?></p>
                <p><strong>To:</strong> <?php echo htmlspecialchars($flightDetails['to']); ?></p>
                <p><strong>Departure Date:</strong> <?php echo htmlspecialchars($flightDetails['departure_date']); ?></p>
                <p><strong>Departure Time:</strong> <?php echo htmlspecialchars($flightDetails['departure_time']); ?></p>
                <p><strong>Fare:</strong> <?php echo htmlspecialchars($flightDetails['fare']); ?></p>
            </div>

            <form class="payment-form" action="payment.php?flight_number=<?php echo urlencode($flightNumber); ?>&from=<?php echo urlencode($from); ?>&to=<?php echo urlencode($to); ?>" method="post">
                <label for="payment">Payment:</label>
                <select id="payment" name="payment" required>
                    <option value="success">Success</option>
                    <option value="failure">Failure</option>
                </select>
                <input type="submit" value="Submit Payment">
            </form>
        <?php endif; ?>

        <p class="back-to-dashboard"><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
