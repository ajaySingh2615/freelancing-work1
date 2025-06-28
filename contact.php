<?php 
include('includes/header.php'); 
?>

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
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-info">
                    <h2>Get in Touch</h2>
                    <p class="mb-4">For any queries regarding admission to medical programs abroad or any other information, feel free to contact us using the details below or fill out the form.</p>
                    
                    <div class="info-box">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="content">
                            <h4>Our Address</h4>
                            <p>123 Education Street, Central Plaza, New Delhi - 110001.</p>
                        </div>
                    </div>
                    
                    <div class="info-box">
                        <div class="icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="content">
                            <h4>Call Us</h4>
                            <p><a href="tel:1800-123-4567">1800 123 4567</a> (Toll Free)</p>
                        </div>
                    </div>
                    
                    <div class="info-box">
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="content">
                            <h4>Email Us</h4>
                            <p><a href="mailto:info@medstudy.global">info@medstudy.global</a></p>
                        </div>
                    </div>
                    
                    <div class="info-box">
                        <div class="icon">
                            <i class="far fa-clock"></i>
                        </div>
                        <div class="content">
                            <h4>Working Hours</h4>
                            <p>Monday - Friday: 9:00 AM - 6:00 PM <br> Saturday: 9:00 AM - 3:00 PM</p>
                        </div>
                    </div>
                    
                    <div class="social-links mt-4">
                        <h4>Follow Us</h4>
                        <ul class="social-icons">
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-form-box">
                    <h2>Send us a Message</h2>
                    <p class="mb-4">Fill out the form below and our team will get back to you as soon as possible.</p>
                    
                    <form id="contact-form" action="process-contact.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name *" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email *" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number *" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="subject" name="subject" required>
                                        <option value="">Select Subject</option>
                                        <option value="Admission Inquiry">Admission Inquiry</option>
                                        <option value="University Information">University Information</option>
                                        <option value="Application Process">Application Process</option>
                                        <option value="Fee Structure">Fee Structure</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message *" required></textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="consent" name="consent" required>
                                <label class="form-check-label" for="consent">
                                    I agree to the <a href="privacy-policy.php">privacy policy</a> and consent to being contacted regarding my inquiry.
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
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

<?php 
include('includes/footer.php'); 
?> 