<?php

// Include the necessary SDK for fingerprint scanner
require_once 'path/to/digitalpersona-sdk-php/autoload.php';

use DigitalPersona\OneTouch\Verification\ReaderSelectorFactory;
use DigitalPersona\OneTouch\Verification\VerificationFactory;
use DigitalPersona\OneTouch\Verification\Constants\Priority;
use DigitalPersona\OneTouch\Verification\Constants\SampleFormat;

// Database connection settings
$host = 'localhost';
$username = 'your_username';
$password = 'your_password';
$database = 'fingerprint_db';

// Connect to MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from the fingerprint scanner
$reader = ReaderSelectorFactory::createReaderSelector()->selectFirstReader();
$verification = VerificationFactory::createVerification()
    ->on($reader)
    ->withFormat(SampleFormat::raw())
    ->prioritize(Priority::speed());

echo "Place your finger on the scanner...\n";

// Capture fingerprint sample
$sample = $verification->acquire();

// Get user ID from the fingerprint template (you may need to customize this part)
$user_id = getUserIdFromFingerprintTemplate($sample);

// Store fingerprint details in the database
$sql = "INSERT INTO fingerprint_data (user_id, fingerprint_template) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $sample->getData());
$stmt->execute();

echo "Fingerprint details stored successfully.\n";

// Close database connection
$stmt->close();
$conn->close();

// Function to extract user ID from the fingerprint template (customize based on your needs)
function getUserIdFromFingerprintTemplate($sample)
{
    // Implement your logic to extract user ID from the fingerprint template
    // For example, you may have a database of user fingerprints and match the template to find the user ID
    // Return the user ID
    return 1; // Replace with your actual user ID
}
