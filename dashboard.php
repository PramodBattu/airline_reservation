<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Get user role from the query parameters
$userRole = isset($_GET['role']) ? $_GET['role'] : '';
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
        }

        p {
            color: #666;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
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
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
		
		a[href="logout.php"] {
				color: white;
			}
		
    </style>
    <title>Dashboard - Airline Reservation System</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Airline System Dashboard</h1>
        <p>You are logged in as <?php echo $_SESSION['role']; ?></p>
        <a href="logout.php">Logout</a>
		
		
        <?php if ($_SESSION['role'] === 'Passenger'): ?>
			<h3>Passenger Ticket Booking Portal</h3>
            <!-- Flight Search Form for Passenger -->
            <h2>Flight Search</h2>
            <form action="search_results.php" method="post">
                <label for="from">From:</label>
                <input type="text" id="from" name="from" required>

                <label for="to">To:</label>
                <input type="text" id="to" name="to" required>

                <label for="departure_date">Departure Date:</label>
                <input type="date" id="departure_date" name="departure_date" required>

                <input type="submit" name="search_flights" value="Search Flights">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
