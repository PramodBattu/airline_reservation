<?php
session_start();

if (isset($_POST['submit_card_details'])) {
    // Process and validate card details (for demonstration purposes, no actual validation is performed)
    $cardNumber = isset($_POST['card_number']) ? $_POST['card_number'] : '';
    $expirationDate = isset($_POST['expiration_date']) ? $_POST['expiration_date'] : '';
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';

    // Store card details in session (for demonstration purposes, you should securely handle card details)
    $_SESSION['card_details'] = array(
        'card_number' => $cardNumber,
        'expiration_date' => $expirationDate,
        'cvv' => $cvv,
    );

    header('Location: enter_card_details.php?flight_number=' . urlencode($_POST['flight_number']));
    exit();
} else {
    header('Location: dashboard.php');
    exit();
}
?>