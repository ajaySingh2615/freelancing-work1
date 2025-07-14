<?php
// Enable error reporting for development
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    
    // Validate form data
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // If validation passes, process the form
    if (empty($errors)) {
        // Prepare email content
        $to = "del@ruseducation.in"; // Change this to your email
        $subject = "New Newsletter Subscription";
        
        $message = "
        <html>
        <head>
            <title>New Newsletter Subscription</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #003585; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background: #f9f9f9; }
                .footer { background: #333; color: white; padding: 15px; text-align: center; font-size: 12px; }
                .highlight { background: #FEBA02; padding: 2px 8px; border-radius: 4px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>New Newsletter Subscription</h2>
                </div>
                <div class='content'>
                    <h3>Subscriber Details:</h3>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Subscription Date:</strong> " . date('Y-m-d H:i:s') . "</p>
                    <p><strong>Source:</strong> Blog Page Newsletter</p>
                </div>
                <div class='footer'>
                    <p>This email was sent from the MedStudy Global blog newsletter subscription form.</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        // Email headers
        $headers = array(
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            'From: MedStudy Global <noreply@medstudy.global>',
            'Reply-To: MedStudy Global <info@medstudy.global>',
            'X-Mailer: PHP/' . phpversion()
        );
        
        // Send email
        $mailSent = mail($to, $subject, $message, implode("\r\n", $headers));
        
        if ($mailSent) {
            // Success response
            $response = [
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter! You will receive regular updates about medical education opportunities.',
                'data' => [
                    'name' => $name,
                    'email' => $email,
                    'timestamp' => date('Y-m-d H:i:s')
                ]
            ];
        } else {
            // Email sending failed
            $response = [
                'success' => false,
                'message' => 'Sorry, there was an error processing your subscription. Please try again later or contact us directly.',
                'errors' => ['Email sending failed']
            ];
        }
    } else {
        // Validation failed
        $response = [
            'success' => false,
            'message' => 'Please correct the following errors:',
            'errors' => $errors
        ];
    }
    
    // Return JSON response for AJAX requests
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    
    // For regular form submissions, redirect back to blog page with message
    if ($response['success']) {
        header("Location: blog.php?subscription=success");
    } else {
        header("Location: blog.php?subscription=error&message=" . urlencode($response['message']));
    }
    exit;
} else {
    // Invalid request method
    header("Location: blog.php");
    exit;
}

// Sanitize input function
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?> 