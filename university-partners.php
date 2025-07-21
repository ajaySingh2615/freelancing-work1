<?php
// Get country from URL parameter
$country_slug = $_GET['country'] ?? '';

if (empty($country_slug)) {
    header("Location: destinations.php");
    exit;
}

// Include required files
include 'includes/header.php';
include 'includes/functions.php';

// Get country details
$country = getCountryBySlug($country_slug);

if (!$country) {
    header("Location: destinations.php");
    exit;
}

// Get universities for this country
$universities = getUniversitiesByCountry($country['id']);
$universitiesCount = count($universities);

// Set page title and description
$page_title = "Medical Universities in " . $country['name'] . " - Study MBBS Abroad";
$page_description = "Explore top medical universities in " . $country['name'] . ". Find the best MBBS programs, fees, admission requirements and application process.";
?>

<!-- Breadcrumb Section -->
<section class="breadcrumb-section">
    <div class="container">
        <nav class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <a href="destinations.php">Countries</a>
            <span>/</span>
            <span><?php echo htmlspecialchars($country['name']); ?></span>
        </nav>
    </div>
</section>

<!-- Country Header Section -->
<section class="country-header-section">
    <div class="container">
        <div class="country-header-content">
            <div class="country-flag-large">
                <span class="flag-icon flag-icon-<?php echo htmlspecialchars($country['flag_code']); ?>"></span>
            </div>
            <div class="country-header-info">
                <h1 class="country-title">Medical Universities in <?php echo htmlspecialchars($country['name']); ?></h1>
                <div class="country-stats">
                    <div class="stat-item">
                        <i class="fas fa-university"></i>
                        <span class="stat-number"><?php echo $universitiesCount; ?></span>
                        <span class="stat-label"><?php echo $universitiesCount === 1 ? 'University' : 'Universities'; ?></span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-users"></i>
                        <span class="stat-number"><?php echo number_format($country['student_count']); ?></span>
                        <span class="stat-label">Students</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-globe-americas"></i>
                        <span class="stat-number"><?php echo ucfirst($country['region']); ?></span>
                        <span class="stat-label">Region</span>
                    </div>
                </div>
                
                <?php if (!empty($country['categories'])): ?>
                <div class="country-categories">
                    <?php foreach ($country['categories'] as $category): ?>
                        <span class="category-badge category-<?php echo htmlspecialchars($category); ?>">
                            <?php echo ucfirst($category); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="country-description">
            <p><?php echo nl2br(htmlspecialchars($country['description'])); ?></p>
        </div>
    </div>
</section>

<!-- Universities Grid Section -->
<section class="universities-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Universities in <?php echo htmlspecialchars($country['name']); ?></h2>
            <p class="section-subtitle">
                Choose from <?php echo $universitiesCount; ?> medical <?php echo $universitiesCount === 1 ? 'university' : 'universities'; ?> 
                offering world-class medical education
            </p>
        </div>

        <?php if (!empty($universities)): ?>
        <div class="universities-grid">
            <?php foreach ($universities as $university): ?>
            <div class="university-card" data-university="<?php echo htmlspecialchars($university['slug']); ?>">
                <div class="university-image">
                    <?php if ($university['featured_image']): ?>
                        <img src="<?php echo htmlspecialchars($university['featured_image']); ?>" 
                             alt="<?php echo htmlspecialchars($university['name']); ?>" 
                             class="university-featured-img">
                    <?php else: ?>
                        <div class="university-placeholder">
                            <i class="fas fa-university fa-3x"></i>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($university['logo_image']): ?>
                        <div class="university-logo">
                            <img src="<?php echo htmlspecialchars($university['logo_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($university['name']); ?> logo" 
                                 class="university-logo-img">
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="university-content">
                    <h3 class="university-name"><?php echo htmlspecialchars($university['name']); ?></h3>
                    <p class="university-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <?php echo htmlspecialchars($university['location']); ?>
                    </p>
                    
                    <div class="university-details">
                        <?php if ($university['course_duration']): ?>
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span><?php echo htmlspecialchars($university['course_duration']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($university['language_of_instruction']): ?>
                        <div class="detail-item">
                            <i class="fas fa-language"></i>
                            <span><?php echo htmlspecialchars($university['language_of_instruction']); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($university['annual_fees']): ?>
                        <div class="detail-item fee-item">
                            <i class="fas fa-dollar-sign"></i>
                            <span class="fee-amount"><?php echo formatCurrency($university['annual_fees']); ?>/year</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="university-description">
                        <p><?php echo htmlspecialchars(substr($university['about_university'], 0, 150)); ?>
                        <?php if (strlen($university['about_university']) > 150) echo '...'; ?></p>
                    </div>
                    
                    <div class="university-actions">
                        <a href="university-detail.php?slug=<?php echo urlencode($university['slug']); ?>" 
                           class="btn btn-primary university-learn-more"
                           data-track="view_university_detail"
                           data-university="<?php echo htmlspecialchars($university['name']); ?>">
                            Learn More
                        </a>
                        <button class="btn btn-secondary university-inquiry-btn" 
                                data-university="<?php echo htmlspecialchars($university['name']); ?>"
                                data-country="<?php echo htmlspecialchars($country['name']); ?>"
                                data-track="quick_inquiry">
                            Quick Inquiry
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php else: ?>
        <div class="no-universities">
            <div class="no-universities-content">
                <i class="fas fa-university fa-3x"></i>
                <h3>No Universities Available</h3>
                <p>We're currently updating our university listings for <?php echo htmlspecialchars($country['name']); ?>. Please check back soon!</p>
                <a href="contact.php?country=<?php echo urlencode($country['slug']); ?>" class="btn btn-primary">
                    Contact Us for More Information
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Country Information Sidebar -->
<section class="country-info-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="country-info-card">
                    <h3>Why Study Medicine in <?php echo htmlspecialchars($country['name']); ?>?</h3>
                    <div class="info-content">
                        <p><?php echo nl2br(htmlspecialchars($country['description'])); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Ready to Apply for Medical Studies in <?php echo htmlspecialchars($country['name']); ?>?</h2>
            <p class="cta-description">Get expert guidance on university selection, application process, and admission requirements.</p>
            <div class="cta-buttons">
                <a href="contact.php?country=<?php echo urlencode($country['slug']); ?>" class="btn btn-warning">
                    Schedule Free Consultation
                </a>
                <a href="destinations.php" class="btn btn-outline-light">
                    Explore Other Countries
                </a>
            </div>
        </div>
    </div>
</section>

<!-- External CSS -->
<link rel="stylesheet" href="assets/css/university-partners.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- JavaScript for Enhanced Functionality -->
<script src="assets/js/university-partners.js"></script>

<?php include 'includes/footer.php'; ?> 