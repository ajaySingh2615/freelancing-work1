<?php
// Get university slug from URL parameter
$university_slug = $_GET['slug'] ?? '';

if (empty($university_slug)) {
    header("Location: destinations.php");
    exit;
}

// Include required files
include 'includes/header.php';
include 'includes/functions.php';

// Get university details
$university = getUniversityBySlug($university_slug);

if (!$university) {
    header("Location: destinations.php");
    exit;
}

// Get university images
$universityImages = getUniversityImages($university['id']);

// Set page title and description
$page_title = $university['name'] . " - Study MBBS in " . $university['country_name'];
$page_description = "Learn about " . $university['name'] . " in " . $university['country_name'] . ". Get admission details, fees, course duration, and application process for MBBS program.";
?>

<!-- Breadcrumb Section -->
<section class="breadcrumb-section">
    <div class="container">
        <nav class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <a href="destinations.php">Countries</a>
            <span>/</span>
            <a href="university-partners.php?country=<?php echo urlencode(strtolower(str_replace(' ', '-', $university['country_name']))); ?>">
                <?php echo htmlspecialchars($university['country_name']); ?>
            </a>
            <span>/</span>
            <span><?php echo htmlspecialchars($university['name']); ?></span>
        </nav>
    </div>
</section>

<!-- University Detail Container -->
<div class="university-detail-container">
    <div class="container">
        <div class="row">
            
            <!-- Left Content (70%) -->
            <div class="col-lg-8 university-left-content">
                
                <!-- University Header -->
                <div class="university-header">
                    <div class="university-header-info">
                        <?php if ($university['logo_image']): ?>
                        <div class="university-logo-large">
                            <img src="<?php echo htmlspecialchars($university['logo_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($university['name']); ?> logo">
                        </div>
                        <?php endif; ?>
                        
                        <div class="university-title-info">
                            <h1 class="university-title"><?php echo htmlspecialchars($university['name']); ?></h1>
                            <p class="university-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo htmlspecialchars($university['location']); ?>
                            </p>
                            <div class="university-country-info">
                                <span class="flag-icon flag-icon-<?php echo htmlspecialchars($university['flag_code']); ?>"></span>
                                <span><?php echo htmlspecialchars($university['country_name']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- University Image Gallery -->
                <div class="university-gallery">
                    <div class="gallery-main">
                        <?php if ($university['featured_image']): ?>
                            <img src="<?php echo htmlspecialchars($university['featured_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($university['name']); ?>" 
                                 class="gallery-main-image" 
                                 id="mainGalleryImage">
                        <?php else: ?>
                            <div class="gallery-placeholder">
                                <i class="fas fa-university fa-5x"></i>
                                <p>University Image</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (!empty($universityImages) || $university['featured_image']): ?>
                    <div class="gallery-thumbnails">
                        <?php if ($university['featured_image']): ?>
                        <div class="gallery-thumb active" data-image="<?php echo htmlspecialchars($university['featured_image']); ?>">
                            <img src="<?php echo htmlspecialchars($university['featured_image']); ?>" 
                                 alt="Featured image">
                        </div>
                        <?php endif; ?>
                        
                        <?php foreach ($universityImages as $image): ?>
                        <div class="gallery-thumb" data-image="<?php echo htmlspecialchars($image['image_url']); ?>">
                            <img src="<?php echo htmlspecialchars($image['image_url']); ?>" 
                                 alt="University image">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- About The University -->
                <div class="university-section about-section">
                    <h2 class="section-title">About <?php echo htmlspecialchars($university['name']); ?></h2>
                    <div class="section-content">
                        <?php if ($university['about_university']): ?>
                            <div class="university-description">
                                <?php echo nl2br(htmlspecialchars($university['about_university'])); ?>
                            </div>
                        <?php else: ?>
                            <p>Information about this university will be available soon. Please contact us for more details.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- University Information Section -->
                <div class="university-section info-section">
                    <h2 class="section-title">University Information</h2>
                    <div class="section-content">
                        <div class="info-grid">
                            <?php if ($university['course_duration']): ?>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Course Duration</h4>
                                    <p><?php echo htmlspecialchars($university['course_duration']); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($university['language_of_instruction']): ?>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-language"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Language of Instruction</h4>
                                    <p><?php echo htmlspecialchars($university['language_of_instruction']); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($university['annual_fees']): ?>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Annual Fees</h4>
                                    <p class="fee-amount"><?php echo formatCurrency($university['annual_fees']); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Location</h4>
                                    <p><?php echo htmlspecialchars($university['location']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Sidebar (30%) -->
            <div class="col-lg-4 university-right-sidebar">
                
                <!-- University Quick Info Card -->
                <div class="sidebar-card university-quick-info">
                    <div class="quick-info-header">
                        <?php if ($university['logo_image']): ?>
                        <img src="<?php echo htmlspecialchars($university['logo_image']); ?>" 
                             alt="<?php echo htmlspecialchars($university['name']); ?> logo" 
                             class="quick-info-logo">
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($university['name']); ?></h3>
                        <p><?php echo htmlspecialchars($university['location']); ?></p>
                    </div>
                    
                    <div class="quick-info-details">
                        <?php if ($university['course_duration']): ?>
                        <div class="quick-detail">
                            <span class="detail-label">Duration:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($university['course_duration']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($university['language_of_instruction']): ?>
                        <div class="quick-detail">
                            <span class="detail-label">Language:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($university['language_of_instruction']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($university['annual_fees']): ?>
                        <div class="quick-detail">
                            <span class="detail-label">Annual Fees:</span>
                            <span class="detail-value fee-highlight"><?php echo formatCurrency($university['annual_fees']); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Get Free Counselling Form -->
                <div class="sidebar-card counselling-form-card sticky-sidebar">
                    <div class="form-header">
                        <h4><i class="fas fa-user-graduate"></i> Get Free Counselling</h4>
                        <p>Interested in <?php echo htmlspecialchars($university['name']); ?>? Get personalized guidance from our education experts.</p>
                    </div>
                    
                    <form id="universityCounsellingForm" class="counselling-form">
                        <input type="hidden" name="university_name" value="<?php echo htmlspecialchars($university['name']); ?>">
                        <input type="hidden" name="country_name" value="<?php echo htmlspecialchars($university['country_name']); ?>">
                        <input type="hidden" name="source_page" value="university_detail">
                        
                        <div class="form-group">
                            <label for="counsellingName">Full Name *</label>
                            <input type="text" id="counsellingName" name="name" required class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="counsellingEmail">Email Address *</label>
                            <input type="email" id="counsellingEmail" name="email" required class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="counsellingPhone">Phone Number *</label>
                            <input type="tel" id="counsellingPhone" name="phone" required class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="counsellingCountry">Your Country *</label>
                            <select id="counsellingCountry" name="country" required class="form-control">
                                <option value="">Select your country</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="counsellingState">State/Province</label>
                            <select id="counsellingState" name="state" class="form-control">
                                <option value="">Select state</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="counsellingCity">City</label>
                            <select id="counsellingCity" name="city" class="form-control">
                                <option value="">Select city</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="counsellingMessage">Message</label>
                            <textarea id="counsellingMessage" name="message" rows="3" class="form-control" 
                                     placeholder="Tell us about your academic background, preferences, or any specific questions about this university..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-accent btn-block btn-lg">
                            <i class="fas fa-paper-plane"></i>
                            Get Free Counselling
                        </button>
                        
                        <div class="form-result" id="counsellingFormResult" style="display: none;"></div>
                        
                        <div class="form-note">
                            <small><i class="fas fa-shield-alt"></i> Your information is secure and will not be shared with third parties.</small>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Related Universities Section -->
<section class="related-universities-section">
    <div class="container">
        <h2 class="section-title">Other Universities in <?php echo htmlspecialchars($university['country_name']); ?></h2>
        
        <?php
        // Get other universities in the same country
        $relatedUniversities = array_filter(
            getUniversitiesByCountry($university['country_id']), 
            function($u) use ($university) {
                return $u['id'] != $university['id'];
            }
        );
        $relatedUniversities = array_slice($relatedUniversities, 0, 3); // Show only 3
        ?>
        
        <?php if (!empty($relatedUniversities)): ?>
        <div class="related-universities-grid">
            <?php foreach ($relatedUniversities as $relatedUniversity): ?>
            <div class="related-university-card">
                <div class="related-university-image">
                    <?php if ($relatedUniversity['featured_image']): ?>
                        <img src="<?php echo htmlspecialchars($relatedUniversity['featured_image']); ?>" 
                             alt="<?php echo htmlspecialchars($relatedUniversity['name']); ?>">
                    <?php else: ?>
                        <div class="image-placeholder">
                            <i class="fas fa-university fa-2x"></i>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="related-university-content">
                    <h4><?php echo htmlspecialchars($relatedUniversity['name']); ?></h4>
                    <p class="location">
                        <i class="fas fa-map-marker-alt"></i>
                        <?php echo htmlspecialchars($relatedUniversity['location']); ?>
                    </p>
                    
                    <?php if ($relatedUniversity['annual_fees']): ?>
                    <p class="fees">
                        <i class="fas fa-dollar-sign"></i>
                        <?php echo formatCurrency($relatedUniversity['annual_fees']); ?>/year
                    </p>
                    <?php endif; ?>
                    
                    <a href="university-detail.php?slug=<?php echo urlencode($relatedUniversity['slug']); ?>" 
                       class="btn btn-outline-primary btn-sm">
                        View Details
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="view-all-universities">
            <a href="university-partners.php?country=<?php echo urlencode(strtolower(str_replace(' ', '-', $university['country_name']))); ?>" 
               class="btn btn-primary">
                View All Universities in <?php echo htmlspecialchars($university['country_name']); ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Ready to Apply to <?php echo htmlspecialchars($university['name']); ?>?</h2>
            <p class="cta-description">Get step-by-step guidance for your application process and admission requirements.</p>
            <div class="cta-buttons">
                <a href="contact.php?university=<?php echo urlencode($university['slug']); ?>" class="btn btn-warning">
                    Start Application Process
                </a>
                <a href="university-partners.php?country=<?php echo urlencode(strtolower(str_replace(' ', '-', $university['country_name']))); ?>" class="btn btn-outline-light">
                    Compare Universities
                </a>
            </div>
        </div>
    </div>
</section>

<!-- External CSS -->
<link rel="stylesheet" href="assets/css/university-detail.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- JavaScript for Enhanced Functionality -->
<script src="assets/js/university-detail.js"></script>

<?php include 'includes/footer.php'; ?> 