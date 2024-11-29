<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Start output buffering to prevent header issues
ob_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data and sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $number = htmlspecialchars($_POST['number']);
    $message = htmlspecialchars($_POST['message']);
    $item = htmlspecialchars($_POST['item']); // Capture the selected menu item

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'franchescamendez178@gmail.com'; // Your Gmail address
        $mail->Password = 'dycp stxq bsdc olto'; // Your Gmail App Password (Use App Passwords for security)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom('franchescamendez178@gmail.com', 'The Daily Grind'); // Sender email
        $mail->addAddress('franchescamendez178@gmail.com'); // Recipient email
        $mail->Subject = "New Booking Order from $name";

        // Email body (HTML)
        $mail->isHTML(true);
        $mail->Body = "
            <h1>Booking Order Details</h1>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Contact Number:</strong> $number</p>
            <p><strong>Ordered Item:</strong> $item</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        // Send email
        $mail->send();

        // Redirect to success
        header('Location: book.php?message=success');
        exit;
    } catch (Exception $e) {
        // Log the error for debugging (optional)
        error_log("Mailer Error: " . $mail->ErrorInfo);

        // Redirect to error
        header('Location: book.php?message=error');
        exit;
    }
}
?>
