<?php 
include('includes/header.php'); 
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-carousel">
        <!-- Slide 1 -->
        <div class="hero-slide active">
            <img src="assets/images/media/home-page/hero-section/first-banner.jpg" alt="Medical Education Abroad" class="hero-slide-bg">
            <div class="hero-container">
                <div class="hero-content-wrapper">
                    <div class="hero-form-wrapper">
                        <h3 class="hero-form-title">Begin Your Medical Journey</h3>
                        <form class="hero-form" action="process-form.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Full Name*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address*" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone Number*" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="country" required>
                                    <option value="">Select Preferred Country*</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 2 -->
        <div class="hero-slide">
            <img src="assets/images/media/home-page/hero-section/second-banner.jpg" alt="MBBS Admission Guidance" class="hero-slide-bg">
            <div class="hero-container">
                <div class="hero-content-wrapper">
                    <div class="hero-form-wrapper">
                        <h3 class="hero-form-title">Request Free Counselling</h3>
                        <form class="hero-form" action="process-form.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Full Name*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address*" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone Number*" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="country" required>
                                    <option value="">Select Preferred Country*</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 3 -->
        <div class="hero-slide">
            <img src="assets/images/media/home-page/hero-section/third-banner.jpg" alt="Medical Education Consultancy" class="hero-slide-bg">
            <div class="hero-container">
                <div class="hero-content-wrapper">
                    <div class="hero-form-wrapper">
                        <h3 class="hero-form-title">Start Your Application</h3>
                        <form class="hero-form" action="process-form.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Full Name*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address*" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone Number*" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="country" required>
                                    <option value="">Select Preferred Country*</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Carousel Dots -->
        <div class="hero-carousel-dots">
            <span class="hero-dot active" data-slide="0"></span>
            <span class="hero-dot" data-slide="1"></span>
            <span class="hero-dot" data-slide="2"></span>
        </div>
    </div>
</section>

<!-- Feature Tabs -->
<section class="feature-tabs">
    <div class="container">
        <div class="card">
            <div class="card-body p-0">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs feature-nav" id="featureTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="universities-tab" data-toggle="tab" href="#universities" role="tab" aria-controls="universities" aria-selected="true">
                            <img src="assets/images/icons/university.png" alt="Universities">
                            <span>Top Universities</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="countries-tab" data-toggle="tab" href="#countries" role="tab" aria-controls="countries" aria-selected="false">
                            <img src="assets/images/icons/globe.png" alt="Countries">
                            <span>Study Destinations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="admission-tab" data-toggle="tab" href="#admission" role="tab" aria-controls="admission" aria-selected="false">
                            <img src="assets/images/icons/admission.png" alt="Admission">
                            <span>Admission Process</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="scholarship-tab" data-toggle="tab" href="#scholarship" role="tab" aria-controls="scholarship" aria-selected="false">
                            <img src="assets/images/icons/scholarship.png" alt="Scholarship">
                            <span>Scholarships</span>
                        </a>
                    </li>
                </ul>
                
                <!-- Tab Content -->
                <div class="tab-content p-4" id="featureTabsContent">
                    <div class="tab-pane fade show active" id="universities" role="tabpanel" aria-labelledby="universities-tab">
                        <div class="feature-content">
                            <h3>Top Medical Universities</h3>
                            <p>We partner with the best medical universities around the world that offer quality education at affordable fees.</p>
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle"></i> MCI/NMC approved universities</li>
                                <li><i class="fas fa-check-circle"></i> Modern infrastructure and facilities</li>
                                <li><i class="fas fa-check-circle"></i> Experienced faculty and international exposure</li>
                                <li><i class="fas fa-check-circle"></i> Affordable tuition fees with scholarship options</li>
                            </ul>
                            <a href="universities.php" class="btn btn-primary mt-3">View All Universities</a>
                        </div>
                    </div>
                    
                    <!-- Additional tab content would go here -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <span class="subtitle">WHO WE ARE</span>
                <h2>Welcome To MedStudy Global</h2>
                <p>Since 2005, MedStudy Global has been a trusted name in helping aspiring doctors achieve their dream of studying MBBS abroad. With over 10,000 success stories, we are a leading ISO 9001: 2015 accredited educational consultancy specializing in medical education worldwide.</p>
                
                <ul class="feature-list">
                    <li>15+ Years of Experience</li>
                    <li>Serving 3,000+ students currently</li>
                    <li>Partnerships with Top Government Universities</li>
                    <li>Personalized Guidance & Support</li>
                    <li>Transparent Admission Procedures</li>
                    <li>Comprehensive Pre-departure Assistance</li>
                </ul>
                
                <div class="mt-4">
                    <a href="about.php" class="btn btn-primary">Learn More</a>
                    <a href="contact.php" class="btn btn-outline-primary ml-2">Contact Us</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="credentials-box">
                    <figure>
                        <img src="assets/images/15-years.png" alt="15-Years">
                        <figcaption>Dedicated support to fulfill your medical education dreams</figcaption>
                    </figure>
                    
                    <figure>
                        <img src="assets/images/iso.png" alt="ISO 9001">
                        <figcaption>ISO 9001:2015 certified educational consultancy</figcaption>
                    </figure>
                    
                    <figure>
                        <img src="assets/images/award.png" alt="Award Winning">
                        <figcaption>Award-winning consultants for international medical education</figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Universities Section -->
<section class="universities-section section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="subtitle">TOP DESTINATIONS FOR MEDICAL EDUCATION</span>
                <h2>Leading Medical Universities Worldwide</h2>
                <p>We partner with prestigious medical universities across the globe that offer quality education at affordable tuition fees. These institutions provide excellent clinical exposure and research opportunities in the field of medicine. Here are our top 3 recommended universities for international students!</p>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="university-card">
                    <img src="assets/images/universities/university1.jpg" alt="Medical University">
                    <h3><a href="university-detail.php">Central Medical University</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="university-card">
                    <img src="assets/images/universities/university2.jpg" alt="Medical University">
                    <h3><a href="university-detail.php">Northern State Medical University</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="university-card">
                    <img src="assets/images/universities/university3.jpg" alt="Medical University">
                    <h3><a href="university-detail.php">Eastern Medical Academy</a></h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="subtitle">HOW WE ASSIST YOU</span>
                <h2>Our Services</h2>
                <p>At MedStudy Global, we ensure your international medical education journey is smooth and successful. We provide comprehensive support from application to graduation, helping you make the most of your time and learning abroad.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <img src="assets/images/services.jpg" alt="Our Services" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="testimonial-section section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Student Testimonials</h2>
                <p>We take pride in guiding students toward successful medical careers. Hear from our students about their experiences with us!</p>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="stats-box text-center">
                    <h3 class="counter">20+</h3>
                    <p>Partner Universities</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stats-box text-center">
                    <h3 class="counter">3000+</h3>
                    <p>Current Students</p>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="#" class="video-link">
                    <i class="fas fa-play-circle"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="subtitle">LATEST UPDATES</span>
                <h2>Recent News & Insights</h2>
                <p>Stay informed about the latest developments in medical education and healthcare around the world</p>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="blog-card">
                    <a href="blog-detail.php">
                        <div class="blog-img"></div>
                    </a>
                    <div class="blog-content">
                        <ul class="blog-meta">
                            <li>April 15, 2024</li>
                        </ul>
                        <h3><a href="blog-detail.php">The Advantages of Pursuing Medical Education at Eastern Medical Academy</a></h3>
                        <p>Thousands of international students choose Eastern Medical Academy for their medical education, and for good reasons...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-card">
                    <a href="blog-detail.php">
                        <div class="blog-img"></div>
                    </a>
                    <div class="blog-content">
                        <ul class="blog-meta">
                            <li>April 10, 2024</li>
                        </ul>
                        <h3><a href="blog-detail.php">Medical Entrance Exam Challenges? Consider These International Options</a></h3>
                        <p>Many aspiring doctors find entrance exams to be a significant hurdle. Fortunately, there are excellent alternatives...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-card">
                    <a href="blog-detail.php">
                        <div class="blog-img"></div>
                    </a>
                    <div class="blog-content">
                        <ul class="blog-meta">
                            <li>April 5, 2024</li>
                        </ul>
                        <h3><a href="blog-detail.php">Why Studying Medicine Abroad Might Be Your Best Career Move in 2024</a></h3>
                        <p>International medical education has gained popularity among students worldwide due to affordable tuition fees...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section section-padding bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2>Ready to Start Your Medical Journey?</h2>
                <p>Take the first step towards your medical career. Our expert counselors are ready to guide you through the entire process.</p>
            </div>
            <div class="col-lg-4 text-lg-right">
                <a href="contact.php" class="btn btn-light">Contact Us Today</a>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="news-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="subtitle">Do Not Miss Any Update!</span>
                <h2>Know What's Latest</h2>
                <p>Latest updates on NEET UG, NEET PG, MBBS in Russia, MBBS abroad and all the recent happenings at Rus Education, catch them all at a single place.</p>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-4">
                <article class="news-card">
                    <a href="news-detail.php">
                        <div class="news-img"></div>
                    </a>
                    <div class="news-content">
                        <span class="news-date">June 3, 2025</span>
                        <h3><a href="news-detail.php">NEET UG 2025 Answer Key Released: Last Chance to Raise Objections Today</a></h3>
                        <p>The provisional answer key for the National Eligibility-cum Entrance Test Undergraduate (NEET UG) was released on June 3, 2025, by…</p>
                        <a href="news-detail.php" class="read-more">Read More</a>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="news-card">
                    <a href="news-detail.php">
                        <div class="news-img"></div>
                    </a>
                    <div class="news-content">
                        <span class="news-date">May 31, 2025</span>
                        <h3><a href="news-detail.php">Rector of Mari State University Highlights India's Role in World War II During Inspiring Lecture…</a></h3>
                        <p>Yoshkar-Ola, Russia — May 28, 2025: Mari State University (MarSU) proudly hosted an enlightening lecture recently by its Rector, Prof.…</p>
                        <a href="news-detail.php" class="read-more">Read More</a>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="news-card">
                    <a href="news-detail.php">
                        <div class="news-img"></div>
                    </a>
                    <div class="news-content">
                        <span class="news-date">May 28, 2025</span>
                        <h3><a href="news-detail.php">The 26th Russian Education Fair 2025 Kicks Off Its First Edition in Kolkata</a></h3>
                        <p>The Russian Education Fair 2025 commenced today at the Russian House in Kolkata, offering Indian students a unique platform to…</p>
                        <a href="news-detail.php" class="read-more">Read More</a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<!-- Media Partners -->
<section class="media-section section-padding bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Media Highlights</h2>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-4">
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/ani.png" alt="ANI" class="img-fluid"></a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/dailyhunt.png" alt="dailyhunt" class="img-fluid"></a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/theprint.png" alt="theprint" class="img-fluid"></a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/zee5.png" alt="ZEE5" class="img-fluid"></a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/latestly.png" alt="latestly" class="img-fluid"></a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/lokmat.png" alt="Lokmat" class="img-fluid"></a>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-4">
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/bs.png" alt="BS" class="img-fluid"></a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/ht.png" alt="hindustan times" class="img-fluid"></a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/wnn.png" alt="World News Network" class="img-fluid"></a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/inn.png" alt="indian news network" class="img-fluid"></a>
            </div>
            <div class="col-md-2 col-sm-4 col-6">
                <a href="#"><img src="assets/images/media/tribune.png" alt="The Tribune" class="img-fluid"></a>
            </div>
        </div>
    </div>
</section>

<!-- Popup Form -->
<div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyModalLabel">Apply for MBBS in Abroad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="application-form" action="process-form.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name *" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail *" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="country" name="country" required>
                            <option value="">Select Your Country</option>
                            <option value="INDIA">INDIA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="state" name="state" required>
                            <option value="">Select Your State</option>
                            <!-- States will be populated via JavaScript -->
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="city" name="city" required>
                            <option value="">Select Your City</option>
                            <!-- Cities will be populated via JavaScript -->
                        </select>
                    </div>
                    <div class="form-group phone-group">
                        <input type="text" class="form-control country-code" id="country-code" name="country-code" value="+91" readonly>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">SUBMIT NOW</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- WhatsApp Float Button -->
<a href="https://api.whatsapp.com/send?phone=919311246058" class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Back to Top Button -->
<a href="#" class="back-to-top">
    <i class="fas fa-arrow-up"></i>
</a>

<?php 
include('includes/footer.php'); 
?> 