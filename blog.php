<?php include 'includes/header.php'; ?>

<!-- Include Blog Page Specific CSS -->
<link rel="stylesheet" href="assets/css/blog-page.css">

<div class="blog-page">
    <!-- Blog Hero Section -->
    <section class="blog-hero-section section-padding">
        <div class="container">
            <div class="blog-hero-content">
                <!-- Left: Latest Post -->
                <div class="latest-post">
                    <div class="latest-post-card">
                        <div class="post-category">
                            <span class="category-tag">Medical Education</span>
                        </div>
                        <h1 class="latest-post-title">Complete Guide to MBBS Admission Abroad: Everything You Need to Know</h1>
                        <div class="post-meta">
                            <div class="author-info">
                                <div class="author-avatar">
                                    <img src="assets/images/media/about-page/our-team/mohd irshad.webp" alt="Dr. Sarah Johnson">
                                </div>
                                <div class="author-details">
                                    <span class="author-name">Dr. Sarah Johnson</span>
                                    <span class="post-date">Updated 2 days ago</span>
                                </div>
                            </div>
                        </div>
                        <div class="latest-post-image">
                            <img src="assets/images/media/home-page/hero-section/one.webp" alt="MBBS Admission Guide">
                        </div>
                        <p class="latest-post-excerpt">
                            Discover the complete roadmap to securing your MBBS admission in top international universities. From application requirements to visa processes, we cover everything you need to start your medical journey abroad.
                        </p>
                        <a href="#" class="read-more-btn">Read Full Article</a>
                    </div>
                </div>

                <!-- Right: Editor's Picks -->
                <div class="editors-picks">
                    <h2 class="section-title">Editor's Picks</h2>
                    <div class="picks-list">
                        <article class="pick-card">
                            <div class="pick-image">
                                <img src="assets/images/media/home-page/blogs-section/1.jpg" alt="Medical Universities">
                            </div>
                            <div class="pick-content">
                                <span class="pick-category">University Guide</span>
                                <h3 class="pick-title">Top 10 Medical Universities in Europe for International Students</h3>
                                <div class="pick-meta">
                                    <span class="pick-author">Prof. Michael Chen</span>
                                    <span class="pick-date">5 days ago</span>
                                </div>
                            </div>
                        </article>

                        <article class="pick-card">
                            <div class="pick-image">
                                <img src="assets/images/media/home-page/blogs-section/2.jpg" alt="Visa Process">
                            </div>
                            <div class="pick-content">
                                <span class="pick-category">Visa Guide</span>
                                <h3 class="pick-title">Student Visa Application Process: A Step-by-Step Guide</h3>
                                <div class="pick-meta">
                                    <span class="pick-author">Emma Rodriguez</span>
                                    <span class="pick-date">1 week ago</span>
                                </div>
                            </div>
                        </article>

                        <article class="pick-card">
                            <div class="pick-image">
                                <img src="assets/images/media/home-page/blogs-section/3.jpg" alt="Scholarship Guide">
                            </div>
                            <div class="pick-content">
                                <span class="pick-category">Scholarships</span>
                                <h3 class="pick-title">Merit-Based Scholarships for Medical Students: Complete List</h3>
                                <div class="pick-meta">
                                    <span class="pick-author">Dr. Priya Sharma</span>
                                    <span class="pick-date">2 weeks ago</span>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Grid Section -->
    <section class="blog-grid-section section-padding">
        <div class="container">
            <!-- Filter Bar -->
            <div class="filter-bar">
                <div class="filter-left">
                    <div class="category-filter">
                        <select id="categoryFilter" class="filter-select">
                            <option value="">All Categories</option>
                            <option value="medical-education">Medical Education</option>
                            <option value="university-guide">University Guide</option>
                            <option value="visa-guide">Visa Guide</option>
                            <option value="scholarships">Scholarships</option>
                            <option value="student-life">Student Life</option>
                            <option value="career-guidance">Career Guidance</option>
                        </select>
                    </div>
                </div>
                <div class="filter-right">
                    <div class="search-filter">
                        <input type="text" id="searchInput" placeholder="Search articles..." class="search-input">
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Blog Grid -->
            <div class="blog-grid">
                <!-- Blog Post Card 1 -->
                <article class="blog-card">
                    <div class="blog-card-image">
                        <img src="assets/images/media/home-page/blogs-section/1.jpg" alt="Medical University Rankings">
                    </div>
                    <div class="blog-card-content">
                        <span class="blog-category">University Guide</span>
                        <h3 class="blog-card-title">
                            <a href="#">How to Choose the Right Medical University for Your Career Goals</a>
                        </h3>
                        <div class="blog-card-meta">
                            <span class="blog-author">Dr. James Wilson</span>
                            <span class="blog-date">March 15, 2024</span>
                        </div>
                        <p class="blog-excerpt">Learn the key factors to consider when selecting a medical university that aligns with your career aspirations and personal preferences.</p>
                    </div>
                </article>

                <!-- Blog Post Card 2 -->
                <article class="blog-card">
                    <div class="blog-card-image">
                        <img src="assets/images/media/home-page/blogs-section/2.jpg" alt="NEET Preparation">
                    </div>
                    <div class="blog-card-content">
                        <span class="blog-category">Medical Education</span>
                        <h3 class="blog-card-title">
                            <a href="#">NEET Preparation Tips: Strategies for Success</a>
                        </h3>
                        <div class="blog-card-meta">
                            <span class="blog-author">Dr. Anjali Patel</span>
                            <span class="blog-date">March 12, 2024</span>
                        </div>
                        <p class="blog-excerpt">Comprehensive guide to preparing for NEET exam with proven strategies, study schedules, and expert tips for medical aspirants.</p>
                    </div>
                </article>

                <!-- Blog Post Card 3 -->
                <article class="blog-card">
                    <div class="blog-card-image">
                        <img src="assets/images/media/home-page/blogs-section/3.jpg" alt="Student Life Abroad">
                    </div>
                    <div class="blog-card-content">
                        <span class="blog-category">Student Life</span>
                        <h3 class="blog-card-title">
                            <a href="#">Adapting to Life as an International Medical Student</a>
                        </h3>
                        <div class="blog-card-meta">
                            <span class="blog-author">Maria Rodriguez</span>
                            <span class="blog-date">March 10, 2024</span>
                        </div>
                        <p class="blog-excerpt">Essential tips for international students to successfully adapt to new cultures, academic systems, and social environments.</p>
                    </div>
                </article>

                <!-- Blog Post Card 4 -->
                <article class="blog-card">
                    <div class="blog-card-image">
                        <img src="assets/images/media/home-page/about section/about-image.webp" alt="Scholarship Applications">
                    </div>
                    <div class="blog-card-content">
                        <span class="blog-category">Scholarships</span>
                        <h3 class="blog-card-title">
                            <a href="#">Writing Winning Scholarship Applications: A Complete Guide</a>
                        </h3>
                        <div class="blog-card-meta">
                            <span class="blog-author">Prof. David Kim</span>
                            <span class="blog-date">March 8, 2024</span>
                        </div>
                        <p class="blog-excerpt">Master the art of scholarship application writing with our comprehensive guide covering essays, recommendations, and interview tips.</p>
                    </div>
                </article>

                <!-- Blog Post Card 5 -->
                <article class="blog-card">
                    <div class="blog-card-image">
                        <img src="assets/images/media/home-page/hero-section/two.webp" alt="Career Guidance">
                    </div>
                    <div class="blog-card-content">
                        <span class="blog-category">Career Guidance</span>
                        <h3 class="blog-card-title">
                            <a href="#">Medical Specializations: Finding Your Perfect Match</a>
                        </h3>
                        <div class="blog-card-meta">
                            <span class="blog-author">Dr. Rachel Green</span>
                            <span class="blog-date">March 5, 2024</span>
                        </div>
                        <p class="blog-excerpt">Explore different medical specializations and discover which field aligns best with your interests, skills, and career goals.</p>
                    </div>
                </article>

                <!-- Blog Post Card 6 -->
                <article class="blog-card">
                    <div class="blog-card-image">
                        <img src="assets/images/media/home-page/hero-section/three.webp" alt="Study Abroad Tips">
                    </div>
                    <div class="blog-card-content">
                        <span class="blog-category">Visa Guide</span>
                        <h3 class="blog-card-title">
                            <a href="#">Common Visa Interview Questions and How to Answer Them</a>
                        </h3>
                        <div class="blog-card-meta">
                            <span class="blog-author">Immigration Expert</span>
                            <span class="blog-date">March 3, 2024</span>
                        </div>
                        <p class="blog-excerpt">Prepare for your student visa interview with our comprehensive list of common questions and expert-recommended responses.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Lead Magnet Section -->
    <section class="lead-magnet-section section-padding">
        <div class="container">
            <div class="lead-magnet-content">
                <div class="lead-magnet-text">
                    <h2 class="lead-magnet-title">Stay Updated with Medical Education Insights!</h2>
                    <p class="lead-magnet-description">Get the latest updates on medical university admissions, scholarship opportunities, and career guidance delivered straight to your inbox.</p>
                    
                    <?php if (isset($_GET['subscription'])): ?>
                        <div class="subscription-message <?php echo $_GET['subscription'] === 'success' ? 'success' : 'error'; ?>">
                            <?php if ($_GET['subscription'] === 'success'): ?>
                                <i class="fas fa-check-circle"></i>
                                <span>Thank you for subscribing! You'll receive updates about medical education opportunities.</span>
                            <?php else: ?>
                                <i class="fas fa-exclamation-triangle"></i>
                                <span><?php echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'An error occurred. Please try again.'; ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form class="newsletter-form" action="process-newsletter.php" method="POST">
                        <div class="form-row">
                            <input type="text" name="name" placeholder="Your Name" required class="form-input">
                            <input type="email" name="email" placeholder="Your Email" required class="form-input">
                        </div>
                        <button type="submit" class="subscribe-btn">Sign Me Up</button>
                    </form>
                    
                    <p class="privacy-note">By subscribing, you agree to our privacy policy and terms of service.</p>
                </div>
                
                <div class="lead-magnet-image">
                    <img src="assets/images/media/home-page/contact-us-section/contact-image.webp" alt="Stay Updated">
                </div>
            </div>
        </div>
    </section>

    <!-- Extended Blog Grid -->
    <section class="extended-blog-section section-padding">
        <div class="container">
            <div class="blog-grid">
                <!-- Additional Blog Cards -->
                <article class="blog-card">
                    <div class="blog-card-image">
                        <img src="assets/images/media/home-page/hero-section/four.webp" alt="Medical Education">
                    </div>
                    <div class="blog-card-content">
                        <span class="blog-category">Medical Education</span>
                        <h3 class="blog-card-title">
                            <a href="#">Understanding Medical Curriculum: What to Expect</a>
                        </h3>
                        <div class="blog-card-meta">
                            <span class="blog-author">Dr. Lisa Chen</span>
                            <span class="blog-date">February 28, 2024</span>
                        </div>
                        <p class="blog-excerpt">A comprehensive overview of medical school curriculum structure, coursework, and clinical training expectations.</p>
                    </div>
                </article>

                <article class="blog-card">
                    <div class="blog-card-image">
                        <img src="assets/images/media/home-page/student-testimonial-section/image-1.webp" alt="Student Success">
                    </div>
                    <div class="blog-card-content">
                        <span class="blog-category">Student Life</span>
                        <h3 class="blog-card-title">
                            <a href="#">Success Stories: From Dreams to Medical Practice</a>
                        </h3>
                        <div class="blog-card-meta">
                            <span class="blog-author">Alumni Network</span>
                            <span class="blog-date">February 25, 2024</span>
                        </div>
                        <p class="blog-excerpt">Inspiring stories of students who successfully completed their medical education abroad and built successful careers.</p>
                    </div>
                </article>

                <article class="blog-card">
                    <div class="blog-card-image">
                        <img src="assets/images/media/home-page/why-choose-us/image-1.webp" alt="Why Choose Us">
                    </div>
                    <div class="blog-card-content">
                        <span class="blog-category">Career Guidance</span>
                        <h3 class="blog-card-title">
                            <a href="#">Building a Strong Medical Career: Essential Skills</a>
                        </h3>
                        <div class="blog-card-meta">
                            <span class="blog-author">Career Counselor</span>
                            <span class="blog-date">February 22, 2024</span>
                        </div>
                        <p class="blog-excerpt">Learn about the essential skills and qualities needed to build a successful and fulfilling medical career.</p>
                    </div>
                </article>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                <nav class="blog-pagination">
                    <a href="#" class="pagination-btn prev-btn">
                        <i class="fas fa-chevron-left"></i>
                        Previous
                    </a>
                    
                    <div class="pagination-numbers">
                        <a href="#" class="pagination-number active">1</a>
                        <a href="#" class="pagination-number">2</a>
                        <a href="#" class="pagination-number">3</a>
                        <span class="pagination-dots">...</span>
                        <a href="#" class="pagination-number">8</a>
                    </div>
                    
                    <a href="#" class="pagination-btn next-btn">
                        Next
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?> 