<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

// Debug statement
// var_dump($_SESSION);

if (isset($_POST['search_flights'])) {
    // Process the search criteria
    $from = isset($_POST['from']) ? $_POST['from'] : '';
    $to = isset($_POST['to']) ? $_POST['to'] : '';
    $departure_date = isset($_POST['departure_date']) ? $_POST['departure_date'] : '';

    // Hardcoded example flight data (replace with actual database query)
    $flights = array(
        array('flight_number' => 'FL001', 'from' => $from, 'to' => $to, 'departure_date' => '2023-12-10', 'departure_time' => '08:00 AM', 'fare' => '$200'),
        array('flight_number' => 'FL002', 'from' => $to, 'to' => $from, 'departure_date' => '2023-12-11', 'departure_time' => '09:30 AM', 'fare' => '$250'),
        array('flight_number' => 'FL003', 'from' => $from, 'to' => $to, 'departure_date' => '2023-12-12', 'departure_time' => '11:00 AM', 'fare' => '$180'),
    );
}
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

        p {
            color: #666;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #2980b9;
        }
    </style>
    <title>Flight Search Results</title>
</head>
<body>
    <div class="container">
        <h1>Flight Search Results</h1>
        <p>Showing flights from <?php echo htmlspecialchars($from); ?> to <?php echo htmlspecialchars($to); ?> on <?php echo htmlspecialchars($departure_date); ?>:</p>

        <?php if (!empty($flights)): ?>
            <table border="1">
                <tr>
                    <th>Flight Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Date</th>
                    <th>Departure Time</th>
                    <th>Fare</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($flights as $flight): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($flight['flight_number']); ?></td>
                        <td><?php echo htmlspecialchars($flight['from']); ?></td>
                        <td><?php echo htmlspecialchars($flight['to']); ?></td>
                        <td><?php echo htmlspecialchars($flight['departure_date']); ?></td>
                        <td><?php echo htmlspecialchars($flight['departure_time']); ?></td>
                        <td><?php echo htmlspecialchars($flight['fare']); ?></td>
                        <td><a href="payment.php?flight_number=<?php echo urlencode($flight['flight_number']); ?>&from=<?php echo urlencode($from); ?>&to=<?php echo urlencode($to); ?>">Book</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No flights found for the given criteria.</p>
        <?php endif; ?>

        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
