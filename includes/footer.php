</main>
    
    <!-- Footer Area -->
    <footer id="footer" class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget about-widget">
                        <div class="footer-logo">
                            <img src="assets/images/logo-white.png" alt="MedStudy Global" class="img-fluid">
                        </div>
                        <p class="about-text">MedStudy Global is a leading educational consultancy specializing in medical education abroad. We help students achieve their dreams of becoming successful medical professionals.</p>
                        <ul class="social-icons">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="universities.php">Universities</a></li>
                            <li><a href="countries.php">Countries</a></li>
                            <li><a href="resources.php">Resources</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">Our Services</h4>
                        <ul class="footer-links">
                            <li><a href="#">University Selection</a></li>
                            <li><a href="#">Admission Guidance</a></li>
                            <li><a href="#">Visa Assistance</a></li>
                            <li><a href="#">Pre-Departure Briefing</a></li>
                            <li><a href="#">Accommodation Support</a></li>
                            <li><a href="#">Career Counseling</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">Contact Info</h4>
                        <ul class="contact-info">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>123 Main Street, New Delhi, India</span>
                            </li>
                            <li>
                                <i class="fas fa-phone-alt"></i>
                                <a href="tel:1800-123-4567">1800-123-4567</a>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:info@medstudy.global">info@medstudy.global</a>
                            </li>
                        </ul>
                        <div class="newsletter">
                            <h5>Subscribe to Our Newsletter</h5>
                            <form action="#" method="post" class="newsletter-form">
                                <input type="email" name="email" placeholder="Your Email Address" required>
                                <button type="submit"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p>&copy; 2023 MedStudy Global. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>
    
    <!-- WhatsApp Float -->
    <a href="https://api.whatsapp.com/send?phone=123456789" class="whatsapp-float" target="_blank">
        <img src="assets/images/whatsapp-icon.png" alt="WhatsApp">
    </a>
    
    <!-- Apply Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Apply for MBBS Abroad</h5>
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
                                <option value="OTHER">OTHER</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="state" name="state">
                                <option value="">Select Your State</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="city" name="city">
                                <option value="">Select Your City</option>
                            </select>
                        </div>
                        <div class="form-group phone-group">
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" class="form-control country-code" value="+91" readonly>
                                </div>
                                <div class="col-9">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">SUBMIT NOW</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    
    <!-- Additional Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html> 