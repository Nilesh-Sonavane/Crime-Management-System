<?php
// Include Razorpay PHP Library
require('./razorpay/Razorpay.php');

// Initialize Razorpay with your API keys
$keyId = 'rzp_test_TKsUUrpIbgmKdJ';
$keySecret = 'SY72s1O849qrW61InNhlnNRq';
$api = new Razorpay\Api\Api($keyId, $keySecret);

// Get the payment amount from the form
$amount = $_POST['amount'] * 100; // Convert amount to paisa

// Create a Razorpay order
$order = $api->order->create(array(
    'amount' => $amount,
    'currency' => 'INR',
));

// Get the order ID
$orderId = $order['id'];

// Pass the order ID to the front end for payment initiation
echo json_encode(array('orderId' => $orderId, 'amount' => $amount));
?>