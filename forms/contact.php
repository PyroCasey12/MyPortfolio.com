<?php
// CHANGE this to your actual email address
$receiving_email_address = '20227544@s.ubaguio.edu';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate and sanitize input
  $name    = htmlspecialchars(strip_tags(trim($_POST["name"])));
  $email   = htmlspecialchars(strip_tags(trim($_POST["email"])));
  $subject = htmlspecialchars(strip_tags(trim($_POST["subject"])));
  $message = htmlspecialchars(strip_tags(trim($_POST["message"])));

  // Check if fields are empty
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo "All fields are required.";
    exit;
  }

  // Compose email
  $email_message = "From: $name\n";
  $email_message .= "Email: $email\n\n";
  $email_message .= "Subject: $subject\n\n";
  $email_message .= "Message:\n$message\n";

  $headers = "From: $email\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Send email
  if (mail($receiving_email_address, $subject, $email_message, $headers)) {
    echo "OK";
  } else {
    http_response_code(500);
    echo "Failed to send email. Please try again.";
  }
} else {
  http_response_code(403);
  echo "Invalid request.";
}
?>
