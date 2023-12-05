<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

// Check if the form is submitted
if (isset($_POST['submit_card_details'])) {
    // Retrieve card details from the form
    $cardNumber = isset($_POST['card_number']) ? $_POST['card_number'] : '';
    $expirationDate = isset($_POST['expiration_date']) ? $_POST['expiration_date'] : '';
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';
    $flightNumber = isset($_POST['flight_number']) ? $_POST['flight_number'] : '';

    // In a real-world scenario, you would validate and securely process the payment here
    // For the purpose of this example, we're just storing the card details in the session
    $_SESSION['card_details'] = array(
        'card_number' => $cardNumber,
        'expiration_date' => $expirationDate,
        'cvv' => $cvv,
        'flight_number' => $flightNumber,
    );

    // Redirect to the payment page with the updated payment status
    header("Location: payment.php?flight_number=" . urlencode($flightNumber));
    exit();
} else {
    // If the form is not submitted, redirect to the dashboard
    header('Location: dashboard.php');
    exit();
}
?>
