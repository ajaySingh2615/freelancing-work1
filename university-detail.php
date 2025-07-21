<?php
$page_title = "%s - Medical University Details | Study MBBS Abroad";
$page_description = "Get detailed information about %s including admission requirements, fees, programs, and application process for MBBS studies.";

include 'includes/header.php';
include 'includes/functions.php';

// Get university slug from URL
$university_slug = $_GET['slug'] ?? '';

if (empty($university_slug)) {
    header('Location: destinations.php');
    exit;
}

// Get university details
$university = getUniversityBySlug($university_slug);
if (!$university) {
    header('Location: destinations.php');
    exit;
}

// Get country details
$country = getCountryById($university['country_id']);

// Get university images
$university_images = getUniversityImages($university['id']);

// Update page title and description
$page_title = sprintf($page_title, $university['name']);
$page_description = sprintf($page_description, $university['name']);
?>

<!-- University Detail Hero Section -->
<section class="university-detail-hero bg-primary position-relative overflow-hidden py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb bg-white bg-opacity-10 border-0 rounded-pill d-inline-flex px-3 py-2">
                        <li class="breadcrumb-item">
                            <a href="index.php" class="text-white text-decoration-none">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="destinations.php" class="text-white text-decoration-none">Countries</a>
                        </li>
                        <?php if ($country): ?>
                        <li class="breadcrumb-item">
                            <a href="university-partners.php?country=<?php echo urlencode($country['slug']); ?>" class="text-white text-decoration-none">
                                <?php echo htmlspecialchars($country['name']); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            <?php echo htmlspecialchars($university['name']); ?>
                        </li>
                    </ol>
                </nav>
                
                <!-- University Header -->
                <div class="d-flex align-items-start justify-content-between flex-wrap">
                    <div class="d-flex align-items-center mb-2">
                        <?php if (!empty($university['logo_image'])): ?>
                        <div class="university-logo-large me-3">
                            <img src="<?php echo htmlspecialchars($university['logo_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($university['name']); ?> Logo" 
                                 class="rounded shadow-sm">
                        </div>
                        <?php endif; ?>
                        <div>
                            <h1 class="h3 text-white mb-1"><?php echo htmlspecialchars($university['name']); ?></h1>
                            <div class="d-flex flex-wrap gap-2 text-white-75 small">
                                <span><i class="fas fa-map-marker-alt me-1"></i><?php echo htmlspecialchars($university['location']); ?></span>
                                <?php if ($country): ?>
                                <span><i class="fas fa-flag me-1"></i><?php echo htmlspecialchars($country['name']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="d-flex gap-2">
                        <a href="#consultation-form" class="btn btn-warning btn-sm smooth-scroll">
                            <i class="fas fa-phone-alt me-1"></i>Get Info
                        </a>
                        <button class="btn btn-outline-light btn-sm" onclick="window.print()">
                            <i class="fas fa-print me-1"></i>Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="py-4">
    <div class="container">
        <div class="row">
            <!-- Left Column - Main Content (70%) -->
            <div class="col-lg-8">
                <!-- University Image Gallery -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-0">
                        <div class="university-gallery">
                            <!-- Main Image -->
                            <div class="main-image-container position-relative">
                                <?php if (!empty($university['featured_image'])): ?>
                                    <img src="<?php echo htmlspecialchars($university['featured_image']); ?>" 
                                         alt="<?php echo htmlspecialchars($university['name']); ?>" 
                                         class="main-university-image img-fluid w-100" 
                                         id="mainUniversityImage">
                                <?php else: ?>
                                    <div class="placeholder-image d-flex align-items-center justify-content-center">
                                        <i class="fas fa-university fa-4x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Gallery Navigation -->
                                <?php if (count($university_images) > 0): ?>
                                <div class="gallery-nav">
                                    <button class="gallery-nav-btn gallery-prev" onclick="changeGalleryImage(-1)">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="gallery-nav-btn gallery-next" onclick="changeGalleryImage(1)">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <?php endif; ?>
                                
                                <!-- Image Counter -->
                                <?php if (count($university_images) > 0): ?>
                                <div class="image-counter">
                                    <span id="currentImageIndex">1</span> / <span id="totalImages"><?php echo count($university_images) + 1; ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Thumbnail Gallery -->
                            <?php if (!empty($university_images)): ?>
                            <div class="thumbnail-gallery mt-3">
                                <div class="row g-2">
                                    <!-- Featured Image Thumbnail -->
                                    <div class="col-auto">
                                        <img src="<?php echo htmlspecialchars($university['featured_image']); ?>" 
                                             alt="<?php echo htmlspecialchars($university['name']); ?>" 
                                             class="thumbnail-image active" 
                                             onclick="setMainImage('<?php echo htmlspecialchars($university['featured_image']); ?>', 0)">
                                    </div>
                                    
                                    <!-- Additional Images -->
                                    <?php foreach ($university_images as $index => $image): ?>
                                    <div class="col-auto">
                                        <img src="<?php echo htmlspecialchars($image['image_url']); ?>" 
                                             alt="<?php echo htmlspecialchars($university['name']); ?> Image <?php echo $index + 2; ?>" 
                                             class="thumbnail-image" 
                                             onclick="setMainImage('<?php echo htmlspecialchars($image['image_url']); ?>', <?php echo $index + 1; ?>)">
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- About The University -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light border-0 py-3">
                        <h3 class="h5 mb-0 text-primary">
                            <i class="fas fa-university me-2"></i>About The University
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($university['about_university'])): ?>
                            <div class="university-content">
                                <?php echo nl2br(htmlspecialchars($university['about_university'])); ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">University description will be updated soon. Please contact us for more information.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- University Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light border-0 py-3">
                        <h3 class="h5 mb-0 text-primary">
                            <i class="fas fa-info-circle me-2"></i>University Information
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <?php if (!empty($university['course_duration'])): ?>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-clock text-primary"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="info-title">Course Duration</h6>
                                        <p class="info-value"><?php echo htmlspecialchars($university['course_duration']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($university['language_of_instruction'])): ?>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-language text-primary"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="info-title">Language of Instruction</h6>
                                        <p class="info-value"><?php echo htmlspecialchars($university['language_of_instruction']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($university['annual_fees']) && $university['annual_fees'] > 0): ?>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-dollar-sign text-success"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="info-title">Annual Fees</h6>
                                        <p class="info-value text-success fw-bold">$<?php echo number_format($university['annual_fees']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6 class="info-title">Location</h6>
                                        <p class="info-value"><?php echo htmlspecialchars($university['location']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features and Facilities (if available) -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light border-0 py-3">
                        <h3 class="h5 mb-0 text-primary">
                            <i class="fas fa-star me-2"></i>Why Choose This University?
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>WHO & NMC Approved</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>International Recognition</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Modern Infrastructure</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Experienced Faculty</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Student Support Services</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Affordable Fees Structure</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar (30%) -->
            <div class="col-lg-4">
                <div class="sticky-sidebar">
                    <!-- University Quick Info Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white text-center py-3">
                            <h4 class="h6 mb-0">
                                <i class="fas fa-info-circle me-2"></i>Quick Information
                            </h4>
                        </div>
                        <div class="card-body p-3">
                            <?php if (!empty($university['logo_image'])): ?>
                            <div class="text-center mb-3">
                                <img src="<?php echo htmlspecialchars($university['logo_image']); ?>" 
                                     alt="<?php echo htmlspecialchars($university['name']); ?> Logo" 
                                     class="university-sidebar-logo">
                            </div>
                            <?php endif; ?>
                            
                            <h6 class="university-sidebar-name"><?php echo htmlspecialchars($university['name']); ?></h6>
                            
                            <div class="quick-info-list">
                                <div class="quick-info-item">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                    <span><?php echo htmlspecialchars($university['location']); ?></span>
                                </div>
                                
                                <?php if (!empty($university['course_duration'])): ?>
                                <div class="quick-info-item">
                                    <i class="fas fa-clock text-primary"></i>
                                    <span><?php echo htmlspecialchars($university['course_duration']); ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($university['language_of_instruction'])): ?>
                                <div class="quick-info-item">
                                    <i class="fas fa-language text-primary"></i>
                                    <span><?php echo htmlspecialchars($university['language_of_instruction']); ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($university['annual_fees']) && $university['annual_fees'] > 0): ?>
                                <div class="quick-info-item">
                                    <i class="fas fa-dollar-sign text-success"></i>
                                    <span class="fw-bold text-success">$<?php echo number_format($university['annual_fees']); ?>/year</span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Get Free Counselling Form -->
                    <div class="card border-0 shadow-lg" id="consultation-form">
                        <div class="card-header bg-warning text-dark text-center py-3">
                            <h4 class="h6 mb-0">
                                <i class="fas fa-phone-alt me-2"></i>Get Free Counselling
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <form id="universityDetailForm" action="process-university-inquiry.php" method="post">
                                <input type="hidden" name="university_id" value="<?php echo $university['id']; ?>">
                                <input type="hidden" name="university_name" value="<?php echo htmlspecialchars($university['name']); ?>">
                                <input type="hidden" name="country_id" value="<?php echo $university['country_id']; ?>">
                                <?php if ($country): ?>
                                <input type="hidden" name="country_name" value="<?php echo htmlspecialchars($country['name']); ?>">
                                <?php endif; ?>
                                
                                <div class="mb-3">
                                    <label for="student_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="student_name" name="student_name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control form-control-sm" id="phone" name="phone" required>
                                </div>
                                
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-sm" id="country" name="country" required>
                                            <option value="">Select</option>
                                            <option value="IN" selected>India</option>
                                            <option value="US">USA</option>
                                            <option value="GB">UK</option>
                                            <option value="CA">Canada</option>
                                            <option value="AU">Australia</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-sm" id="state" name="state" required>
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm" id="city" name="city" required>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message (Optional)</label>
                                    <textarea class="form-control form-control-sm" id="message" name="message" rows="3" 
                                              placeholder="Tell us about your educational background or any specific questions..."></textarea>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Inquiry
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-light border-0 py-3">
                            <h5 class="h6 mb-0 text-primary">
                                <i class="fas fa-headset me-2"></i>Need Immediate Help?
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="contact-item mb-2">
                                <i class="fas fa-phone text-success me-2"></i>
                                <a href="tel:+919311246058" class="text-decoration-none">+91 9311 246 058</a>
                            </div>
                            <div class="contact-item mb-2">
                                <i class="fab fa-whatsapp text-success me-2"></i>
                                <a href="https://wa.me/919311246058" class="text-decoration-none" target="_blank">WhatsApp Chat</a>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <a href="mailto:info@sunriseglobal.edu" class="text-decoration-none">info@sunriseglobal.edu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced CSS for University Detail -->
<style>
/* University Detail Custom Styles */
.university-detail-hero {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
}

.university-logo-large img {
    width: 80px;
    height: 80px;
    object-fit: contain;
    background: white;
    padding: 8px;
    border-radius: 12px;
}

/* Gallery Styles */
.main-image-container {
    height: 400px;
    overflow: hidden;
    border-radius: var(--medium-radius);
}

.main-university-image {
    height: 100%;
    object-fit: cover;
    border-radius: var(--medium-radius);
}

.placeholder-image {
    height: 400px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: var(--medium-radius);
}

.gallery-nav {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    pointer-events: none;
}

.gallery-nav-btn {
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    pointer-events: all;
}

.gallery-nav-btn:hover {
    background: rgba(0, 0, 0, 0.8);
    transform: scale(1.1);
}

.image-counter {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
}

.thumbnail-image {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    opacity: 0.7;
}

.thumbnail-image:hover,
.thumbnail-image.active {
    opacity: 1;
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Info Items */
.info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.info-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}

.info-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 2px;
}

.info-value {
    font-size: 0.9rem;
    color: var(--light-text);
    margin: 0;
}

/* Feature Items */
.feature-item {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    margin-bottom: 8px;
}

/* Sidebar Styles */
.sticky-sidebar {
    position: sticky;
    top: 20px;
}

.university-sidebar-logo {
    width: 60px;
    height: 60px;
    object-fit: contain;
    border-radius: 8px;
}

.university-sidebar-name {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 12px;
    text-align: center;
}

.quick-info-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.quick-info-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    padding: 4px 0;
}

/* Contact Items */
.contact-item {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

/* Form Enhancements */
.form-control-sm,
.form-select-sm {
    font-size: 0.875rem;
}

/* Responsive Design */
@media (max-width: 992px) {
    .sticky-sidebar {
        position: static;
        margin-top: 2rem;
    }
    
    .main-image-container {
        height: 300px;
    }
    
    .university-logo-large img {
        width: 60px;
        height: 60px;
    }
}

@media (max-width: 768px) {
    .university-detail-hero .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .university-detail-hero .d-flex > div:last-child {
        margin-top: 1rem;
        align-self: flex-end;
    }
    
    .main-image-container {
        height: 250px;
    }
    
    .thumbnail-image {
        width: 60px;
        height: 45px;
    }
}

@media (max-width: 576px) {
    .main-image-container {
        height: 200px;
    }
    
    .gallery-nav {
        padding: 0 10px;
    }
    
    .gallery-nav-btn {
        width: 35px;
        height: 35px;
    }
    
    .thumbnail-image {
        width: 50px;
        height: 37px;
    }
    
    .info-item {
        flex-direction: column;
        gap: 4px;
    }
    
    .info-icon {
        align-self: flex-start;
    }
}
</style>

<!-- External CSS -->
<link rel="stylesheet" href="assets/css/university-detail.css">

<!-- JavaScript -->
<script src="assets/js/university-detail.js"></script>
<script>
// University Detail Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Gallery functionality
    const galleryImages = [
        <?php if (!empty($university['featured_image'])): ?>
        '<?php echo addslashes($university['featured_image']); ?>',
        <?php endif; ?>
        <?php foreach ($university_images as $image): ?>
        '<?php echo addslashes($image['image_url']); ?>',
        <?php endforeach; ?>
    ];
    
    let currentImageIndex = 0;
    
    window.changeGalleryImage = function(direction) {
        currentImageIndex += direction;
        
        if (currentImageIndex < 0) {
            currentImageIndex = galleryImages.length - 1;
        } else if (currentImageIndex >= galleryImages.length) {
            currentImageIndex = 0;
        }
        
        setMainImage(galleryImages[currentImageIndex], currentImageIndex);
    };
    
    window.setMainImage = function(imageSrc, index) {
        const mainImage = document.getElementById('mainUniversityImage');
        const currentIndexElement = document.getElementById('currentImageIndex');
        
        if (mainImage) {
            mainImage.src = imageSrc;
        }
        
        if (currentIndexElement) {
            currentIndexElement.textContent = index + 1;
        }
        
        // Update thumbnail active state
        document.querySelectorAll('.thumbnail-image').forEach((thumb, i) => {
            thumb.classList.toggle('active', i === index);
        });
        
        currentImageIndex = index;
    };
    
    // Form handling - same as university-partners page
    const form = document.getElementById('universityDetailForm');
    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');
    
    // Location dropdowns
    if (countrySelect) {
        countrySelect.addEventListener('change', function() {
            const countryCode = this.value;
            
            stateSelect.innerHTML = '<option value="">Select</option>';
            citySelect.innerHTML = '<option value="">Select City</option>';
            
            if (countryCode) {
                fetch(`api/get-locations.php?type=states&country=${countryCode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            data.states.forEach(state => {
                                const option = document.createElement('option');
                                option.value = state.code;
                                option.textContent = state.name;
                                stateSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    }
    
    if (stateSelect) {
        stateSelect.addEventListener('change', function() {
            const stateCode = this.value;
            const countryCode = countrySelect.value;
            
            citySelect.innerHTML = '<option value="">Select City</option>';
            
            if (stateCode && countryCode) {
                fetch(`api/get-locations.php?type=cities&country=${countryCode}&state=${stateCode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            data.cities.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.name;
                                option.textContent = city.name;
                                citySelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    }
    
    // Form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
            submitBtn.disabled = true;
            
            fetch('process-university-inquiry.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    form.parentNode.insertBefore(alertDiv, form);
                    form.reset();
                } else {
                    throw new Error(data.message || 'Something went wrong');
                }
            })
            .catch(error => {
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger alert-dismissible fade show';
                alertDiv.innerHTML = `
                    <i class="fas fa-exclamation-circle me-2"></i>
                    ${error.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                form.parentNode.insertBefore(alertDiv, form);
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // Smooth scrolling
    document.querySelectorAll('.smooth-scroll').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?> 