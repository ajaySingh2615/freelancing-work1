<?php 
include('includes/header.php'); 
?>

<div class="contact-page">
<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-title">Contact Us</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<section class="contact-page-section section-padding">
    <div class="container">
        <div class="contact-split-container">
            <!-- Left Side: Contact Information -->
            <div class="contact-info-section">
                <div class="contact-info-content">
                    <!-- Decorative Shapes -->
                    <div class="decorative-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                    </div>
                    
                    <div class="contact-info-text">
                        <h2>Contact Information</h2>
                        <p>Fill up the form and our team will get back to you within 24 hours.</p>
                        
                        <div class="contact-details">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <span>+0123 4567 8910</span>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <span>hello@flowbase.com</span>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <span>102 Street 2714 Don</span>
                            </div>
                        </div>
                        
                        <div class="social-media">
                            <div class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side: Contact Form -->
            <div class="contact-form-section">
                <div class="contact-form-content">
                    <form id="contact-form" action="process-contact.php" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first-name">First Name</label>
                                <input type="text" class="form-control" id="first-name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name</label>
                                <input type="text" class="form-control" id="last-name" name="last_name" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>What type of website do you need?</label>
                            <div class="radio-group">
                                <div class="radio-item">
                                    <input type="radio" id="web-design" name="service_type" value="Web Design">
                                    <label for="web-design">Web Design</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="web-development" name="service_type" value="Web Development" checked>
                                    <label for="web-development">Web Development</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="logo-design" name="service_type" value="Logo Design">
                                    <label for="logo-design">Logo Design</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="other" name="service_type" value="Other">
                                    <label for="other">Other</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message..." required></textarea>
                        </div>
                        
                        <button type="submit" class="btn-submit">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Map -->
<div class="google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.5051345023036!2d77.21761731508341!3d28.64272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x52c2b7494e204dce!2sNew%20Delhi%2C%20Delhi%2C%20India!5e0!3m2!1sen!2sus!4v1679743456789!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<!-- Office Locations Section -->
<section class="office-section section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Our Branch Offices</h2>
                <p class="mb-5">Visit our branch offices across the country for in-person consultation.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="office-box">
                    <h3>New Delhi (Head Office)</h3>
                    <p>123 Education Street, Central Plaza,<br> New Delhi - 110001.</p>
                    <ul class="office-contact">
                        <li><i class="fas fa-phone-alt"></i> <a href="tel:1800-123-4567">1800 123 4567</a></li>
                        <li><i class="fas fa-envelope"></i> <a href="mailto:delhi@medstudy.global">delhi@medstudy.global</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="office-box">
                    <h3>Mumbai Office</h3>
                    <p>305, 3rd Floor, Business Center,<br> Andheri East, Mumbai - 400069.</p>
                    <ul class="office-contact">
                        <li><i class="fas fa-phone-alt"></i> <a href="tel:022-28123456">022-28123456</a></li>
                        <li><i class="fas fa-envelope"></i> <a href="mailto:mumbai@medstudy.global">mumbai@medstudy.global</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="office-box">
                    <h3>Bangalore Office</h3>
                    <p>201, 2nd Floor, Tech Park,<br> MG Road, Bangalore - 560001.</p>
                    <ul class="office-contact">
                        <li><i class="fas fa-phone-alt"></i> <a href="tel:080-42123456">080-42123456</a></li>
                        <li><i class="fas fa-envelope"></i> <a href="mailto:bangalore@medstudy.global">bangalore@medstudy.global</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Frequently Asked Questions</h2>
                <p class="mb-5">Find answers to some of the most commonly asked questions about studying medicine abroad.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="accordion" id="contactFaq">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How can I apply for MBBS abroad through MedStudy Global?
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#contactFaq">
                            <div class="card-body">
                                You can apply for MBBS abroad through MedStudy Global by filling the online application form on our website or by visiting any of our offices. Our expert counselors will guide you through the entire process from application to admission.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What are the eligibility requirements for MBBS abroad?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#contactFaq">
                            <div class="card-body">
                                The basic eligibility requirements include: Completion of 10+2 with Physics, Chemistry, and Biology as mandatory subjects, minimum 50% aggregate in PCB (requirements may vary by country), qualifying entrance exam scores where applicable, and age of 17 years or above by December 31st of the admission year.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What is the fee structure for MBBS abroad?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#contactFaq">
                            <div class="card-body">
                                The fee structure for MBBS abroad varies depending on the country and university. Generally, it ranges from $3,000 to $15,000 per year. This includes tuition fees, hostel accommodation, and administrative charges. For detailed information about fees for specific universities and countries, please contact our counselors.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
<!-- End contact-page wrapper -->

<?php 
include('includes/footer.php'); 
?> 