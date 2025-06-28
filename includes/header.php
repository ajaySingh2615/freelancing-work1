<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedStudy Global - Study MBBS Abroad</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS files were split for better organization -->
</head>
<body>

    <!-- Skip to Content Link -->
    <a href="#content" class="skip-link">Skip to content</a>
    
    <!-- Header Area -->
    <header id="header" class="header-area">
        <!-- Top Header (Contact Bar) -->
        <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="top-contact">
                            <ul>
                                <li>
                                    <a href="tel:1800-123-4567">
                                        <i class="fas fa-phone-alt pulse"></i> Student Helpline: 1800-123-4567
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:info@medstudy.global">
                                        <i class="fas fa-envelope pulse"></i> E-mail: info@medstudy.global
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="top-right">
                            <ul class="social-icons">
                                <li><a href="#" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Header (Navigation Bar) -->
        <div class="main-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3">
                        <div class="logo">
                            <a href="index.php" class="logo-link">
                                <img src="assets/images/logo.png" alt="MedStudy Global">
                                <span class="tagline">Study Abroad Consultants</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <nav class="main-nav">
                            <ul>
                                <li><a href="index.php" class="active">Home</a></li>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="universities.php">Universities</a></li>
                                <li><a href="countries.php">Countries</a></li>
                                <li><a href="resources.php">Resources</a></li>
                                <li><a href="gallery.php">Gallery</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="header-actions">
                            <ul>
                                <li>
                                    <button class="hamburger-btn" id="mobile-menu-toggle" aria-label="Open mobile menu">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                </li>
                                <li>
                                    <a href="apply-online.php" class="apply-btn-small">
                                        APPLY NOW
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <div class="menu-overlay"></div>
        <div class="menu-content">
            <div class="menu-header">
                <a href="index.php">
                    <img src="assets/images/logo.png" alt="MedStudy Global" class="img-fluid">
                </a>
                <button class="close-menu" aria-label="Close mobile menu"><i class="fas fa-times"></i></button>
            </div>
            <div class="menu-body">
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="universities.php">Universities</a></li>
                    <li><a href="countries.php">Countries</a></li>
                    <li><a href="resources.php">Resources</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
                <div class="menu-contact">
                    <h4>Contact Info</h4>
                    <ul>
                        <li><a href="tel:1800-123-4567"><i class="fas fa-phone-alt"></i> 1800-123-4567</a></li>
                        <li><a href="mailto:info@medstudy.global"><i class="fas fa-envelope"></i> info@medstudy.global</a></li>
                    </ul>
                </div>
                <div class="menu-social">
                    <h4>Follow Us</h4>
                    <ul class="social-icons">
                        <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Book Consultation Button -->
    <button class="consultation-btn" data-toggle="modal" data-target="#applyModal">
        Book Free Consultation Now
    </button>
    
    <!-- WhatsApp Button -->
    <a href="https://api.whatsapp.com/send?phone=123456789" class="whatsapp-btn" target="_blank">
        <img src="assets/images/whatsapp-icon.png" alt="WhatsApp">
    </a>
    
    <!-- Main Content Area -->
    <main id="content" class="main-content"> 