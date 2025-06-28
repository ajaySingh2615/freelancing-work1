<?php
// Enable error reporting for development
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $country = isset($_POST['country']) ? sanitizeInput($_POST['country']) : '';
    $state = isset($_POST['state']) ? sanitizeInput($_POST['state']) : '';
    $city = isset($_POST['city']) ? sanitizeInput($_POST['city']) : '';
    $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
    $country_code = isset($_POST['country-code']) ? sanitizeInput($_POST['country-code']) : '+91';
    
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
    
    if (empty($phone)) {
        $errors[] = "Phone number is required";
    }
    
    if (empty($country)) {
        $errors[] = "Country is required";
    }
    
    // If validation passes, process the form
    if (empty($errors)) {
        // Format the phone number with country code
        $fullPhone = $country_code . $phone;
        
        // Prepare email content
        $to = "del@ruseducation.in"; // Change this to your email
        $subject = "New MBBS Inquiry from Website";
        
        $message = "
        <html>
        <head>
            <title>New MBBS Inquiry</title>
        </head>
        <body>
            <h2>New Inquiry Details</h2>
            <table>
                <tr>
                    <td><strong>Name:</strong></td>
                    <td>$name</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>$email</td>
                </tr>
                <tr>
                    <td><strong>Phone:</strong></td>
                    <td>$fullPhone</td>
                </tr>
                <tr>
                    <td><strong>Country:</strong></td>
                    <td>$country</td>
                </tr>";
                
        if (!empty($state)) {
            $message .= "
                <tr>
                    <td><strong>State:</strong></td>
                    <td>$state</td>
                </tr>";
        }
        
        if (!empty($city)) {
            $message .= "
                <tr>
                    <td><strong>City:</strong></td>
                    <td>$city</td>
                </tr>";
        }
        
        $message .= "
                <tr>
                    <td><strong>Date:</strong></td>
                    <td>" . date("Y-m-d H:i:s") . "</td>
                </tr>
            </table>
        </body>
        </html>
        ";
        
        // Set email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Rus Education <noreply@ruseducation.in>' . "\r\n";
        
        // Send email
        $mailSent = mail($to, $subject, $message, $headers);
        
        // Optional: Save to database
        if ($mailSent) {
            // Save to database (example code)
            // $conn = new mysqli("localhost", "username", "password", "database");
            // $stmt = $conn->prepare("INSERT INTO inquiries (name, email, phone, country, state, city) VALUES (?, ?, ?, ?, ?, ?)");
            // $stmt->bind_param("ssssss", $name, $email, $fullPhone, $country, $state, $city);
            // $stmt->execute();
            // $stmt->close();
            // $conn->close();
            
            // Return success response for AJAX
            $response = [
                'status' => 'success',
                'message' => 'Thank you for your inquiry! We will contact you soon.'
            ];
            
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            $response = [
                'status' => 'error',
                'message' => 'There was an error sending your inquiry. Please try again later.'
            ];
            
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    } else {
        // Return error response for AJAX
        $response = [
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $errors
        ];
        
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
} else {
    // If not a POST request, redirect to home page
    header("Location: index.php");
    exit;
}

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?> 