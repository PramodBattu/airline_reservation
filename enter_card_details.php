<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['search_flights'])) {
    // Process the search criteria
    $from = isset($_POST['from']) ? $_POST['from'] : '';
    $to = isset($_POST['to']) ? $_POST['to'] : '';
    $departure_date = isset($_POST['departure_date']) ? $_POST['departure_date'] : '';

    // Hardcoded example flight data (replace with actual database query)
    $flights = array(
        array('flight_number' => 'FL001', 'from' => 'City A', 'to' => 'City B', 'departure_date' => '2023-12-10', 'departure_time' => '08:00 AM', 'fare' => '$200'),
        array('flight_number' => 'FL002', 'from' => 'City B', 'to' => 'City C', 'departure_date' => '2023-12-11', 'departure_time' => '09:30 AM', 'fare' => '$250'),
        array('flight_number' => 'FL003', 'from' => 'City A', 'to' => 'City C', 'departure_date' => '2023-12-12', 'departure_time' => '11:00 AM', 'fare' => '$180'),
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
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
                        <td>
                            <?php if ($_SESSION['role'] === 'Passenger'): ?>
                                <?php if (!isset($_SESSION['card_details']) || !is_array($_SESSION['card_details'])): ?>
                                    <a href="enter_card_details.php?flight_number=<?php echo urlencode($flight['flight_number']); ?>">Book</a>
                                <?php else: ?>
                                    <a href="payment.php?flight_number=<?php echo urlencode($flight['flight_number']); ?>">Book</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No flights found for the given criteria.</p>
        <?php endif; ?>

        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>