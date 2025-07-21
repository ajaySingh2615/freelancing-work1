<?php
$page_title = "Universities in %s - Study MBBS Abroad";
$page_description = "Explore top medical universities in %s for MBBS studies. Get detailed information about admission requirements, fees, and programs.";

include 'includes/header.php';
include 'includes/functions.php';

// Get country from URL parameter
$country_slug = $_GET['country'] ?? '';

if (empty($country_slug)) {
    header('Location: destinations.php');
    exit;
}

// Get country details
$country = getCountryBySlug($country_slug);
if (!$country) {
    header('Location: destinations.php');
    exit;
}

// Get universities for this country
$universities = getUniversitiesByCountry($country['id']);

// Update page title and description with country name
$page_title = sprintf($page_title, $country['name']);
$page_description = sprintf($page_description, $country['name']);
?>

<!-- Country Hero Section -->
<section class="university-partners-hero">
    <div class="hero-background-decoration">
        <div class="airplane-icon airplane-1">
            <i class="fas fa-plane"></i>
        </div>
        <div class="airplane-icon airplane-2">
            <i class="fas fa-plane"></i>
        </div>
        <div class="airplane-icon airplane-3">
            <i class="fas fa-plane"></i>
        </div>
    </div>
    <div class="container">
        <div class="hero-content">
            <nav class="hero-breadcrumb">
                <a href="index.php">Home</a>
                <span class="breadcrumb-separator">/</span>
                <a href="destinations.php"><?php echo htmlspecialchars($country['name']); ?></a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-current">Universities</span>
            </nav>
            <div class="hero-main">
                <h1 class="hero-title">Top Universities in <?php echo htmlspecialchars($country['name']); ?></h1>
            </div>
        </div>
    </div>
</section>

<!-- Search and Filter Section -->
<section class="py-4 bg-light border-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-primary"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="universitySearch" 
                           placeholder="Search universities by name or program...">
                </div>
            </div>
            <div class="col-lg-3">
                <select class="form-select" id="sortFilter">
                    <option value="name">Sort by Name</option>
                    <option value="fees">Sort by Fees</option>
                    <option value="popular">Most Popular</option>
                </select>
            </div>
            <div class="col-lg-3">
                <div class="d-flex align-items-center justify-content-end">
                    <span class="text-muted me-2">Found:</span>
                    <span class="badge bg-primary fs-6" id="universityCount"><?php echo count($universities); ?> Universities</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Universities Grid Section -->
<section class="py-5 universities-grid-section">
    <div class="container">
        <?php if (!empty($universities)): ?>
            <div class="row g-4 gx-lg-5" id="universitiesGrid">
                <?php foreach ($universities as $university): ?>
                    <div class="col-12 col-md-6 col-lg-4 university-card-wrapper">
                        <div class="card h-100 border-0 shadow-sm hover-lift-university">
                            <!-- University Image -->
                            <div class="university-image-container position-relative">
                                <?php if (!empty($university['featured_image'])): ?>
                                    <img src="<?php echo htmlspecialchars($university['featured_image']); ?>" 
                                         class="card-img-top university-featured-img" 
                                         alt="<?php echo htmlspecialchars($university['name']); ?>">
                                <?php else: ?>
                                    <div class="university-placeholder-img d-flex align-items-center justify-content-center">
                                        <i class="fas fa-university fa-3x text-muted"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- University Logo Overlay -->
                                <?php if (!empty($university['logo_image'])): ?>
                                    <div class="university-logo-overlay">
                                        <img src="<?php echo htmlspecialchars($university['logo_image']); ?>" 
                                             class="university-logo" 
                                             alt="<?php echo htmlspecialchars($university['name']); ?> Logo">
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- University Content -->
                            <div class="card-body p-4">
                                <h5 class="card-title h6 mb-2 university-name">
                                    <?php echo htmlspecialchars($university['name']); ?>
                                </h5>
                                
                                <div class="university-meta mb-3">
                                    <div class="d-flex align-items-center mb-1 text-muted small">
                                        <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                        <span><?php echo htmlspecialchars($university['location']); ?></span>
                                    </div>
                                    <?php if (!empty($university['language_of_instruction'])): ?>
                                    <div class="d-flex align-items-center mb-1 text-muted small">
                                        <i class="fas fa-language text-primary me-1"></i>
                                        <span><?php echo htmlspecialchars($university['language_of_instruction']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($university['course_duration'])): ?>
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="fas fa-clock text-primary me-1"></i>
                                        <span><?php echo htmlspecialchars($university['course_duration']); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- University Description -->
                                <p class="card-text text-muted small mb-3">
                                    <?php 
                                    $description = strip_tags($university['about_university']);
                                    echo htmlspecialchars(substr($description, 0, 150)); 
                                    if (strlen($description) > 150) echo '...';
                                    ?>
                                </p>
                                

                            </div>
                            
                            <!-- University Actions -->
                            <div class="card-footer bg-white border-0 p-4 pt-0">
                                <div class="d-grid">
                                    <a href="university-detail.php?slug=<?php echo urlencode($university['slug']); ?>" 
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
        <?php else: ?>
            <!-- No Universities Found -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-university fa-4x text-muted"></i>
                </div>
                <h3 class="h4 text-muted mb-3">No Universities Available</h3>
                <p class="text-muted mb-4">We're currently updating our university listings for <?php echo htmlspecialchars($country['name']); ?>. Please check back soon or contact us for more information.</p>
                <a href="contact.php?country=<?php echo urlencode($country['slug']); ?>" class="btn btn-primary">
                    <i class="fas fa-phone-alt me-2"></i>Contact Us for Information
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>



<!-- Enhanced CSS for University Partners -->
<style>
/* Hero Section - Clean Design with Background Decoration */
.university-partners-hero {
    background: linear-gradient(135deg, #fef8e7 0%, #f0f9ff 100%);
    padding: 3rem 0;
    position: relative;
    overflow: hidden;
    min-height: 250px;
    border-bottom: 1px solid #e5e7eb;
}

.hero-background-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    z-index: 1;
}

.airplane-icon {
    position: absolute;
    font-size: 2.5rem;
    transform: rotate(45deg);
    opacity: 0.1;
}

.airplane-1 {
    top: 20%;
    right: 15%;
    font-size: 3rem;
    color: #003585;
    opacity: 0.08;
}

.airplane-2 {
    top: 60%;
    right: 25%;
    font-size: 2rem;
    color: #FEBA02;
    opacity: 0.12;
}

.airplane-3 {
    top: 40%;
    right: 5%;
    font-size: 2.5rem;
    color: #149DE1;
    opacity: 0.1;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 100%;
}

.hero-breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    font-size: 0.9rem;
    font-weight: 500;
}

.hero-breadcrumb a {
    color: #6b7280;
    text-decoration: none;
    transition: color 0.3s ease;
}

.hero-breadcrumb a:hover {
    color: #003585;
}

.breadcrumb-separator {
    color: #9ca3af;
    margin: 0 0.25rem;
}

.breadcrumb-current {
    color: #374151;
    font-weight: 600;
}

.hero-main {
    max-width: 800px;
}

.hero-title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 700;
    color: #111827 !important;
    margin: 0;
    line-height: 1.2;
    letter-spacing: -0.02em;
}

/* Universities Grid Section */
.universities-grid-section {
    background: #fafbfc;
    min-height: 60vh;
}

/* University Cards Grid */
#universitiesGrid {
    margin-top: 2rem;
}

.university-card-wrapper {
    margin-bottom: 2rem;
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

/* University Card Styling */
.hover-lift-university {
    position: relative;
    overflow: hidden;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* Combined hover effects - matching blog cards */
.hover-lift-university:hover {
    transform: translateY(-5px);
    border: 1px solid rgba(254, 186, 2, 0.3);
    animation: pulsingGlow 3s ease-in-out infinite;
}

/* Shine effect - matching blog cards */
.hover-lift-university::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(254, 186, 2, 0.2),
        transparent
    );
    transform: skewX(-25deg);
    transition: 0.75s;
    z-index: 1;
}

.hover-lift-university:hover::before {
    animation: shine 3s ease-in-out infinite;
}

/* Animations - matching blog cards */
@keyframes shine {
    0% {
        left: -100%;
    }
    20% {
        left: 100%;
    }
    100% {
        left: 100%;
    }
}

@keyframes pulsingGlow {
    0% {
        box-shadow: 
            0 0.25rem 0.75rem rgba(0, 0, 0, 0.15),
            0 0 1.5rem rgba(254, 186, 2, 0.2);
    }
    50% {
        box-shadow: 
            0 0.25rem 0.75rem rgba(0, 0, 0, 0.15),
            0 0 2rem rgba(254, 186, 2, 0.4),
            0 0 3rem rgba(254, 186, 2, 0.2);
    }
    100% {
        box-shadow: 
            0 0.25rem 0.75rem rgba(0, 0, 0, 0.15),
            0 0 1.5rem rgba(254, 186, 2, 0.2);
    }
}

.university-image-container {
    height: 220px;
    overflow: hidden;
    position: relative;
    flex-shrink: 0;
}

.university-featured-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.university-placeholder-img {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.university-logo-overlay {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: white;
    border-radius: 8px;
    padding: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border: 1px solid rgba(0,0,0,0.05);
    z-index: 3;
}

.university-logo {
    width: 36px;
    height: 36px;
    object-fit: contain;
}

.hover-lift-university:hover .university-featured-img {
    transform: scale(1.03);
}

/* Card Content */
.hover-lift-university .card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 1.5rem;
    position: relative;
    z-index: 2;
}

.university-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #212529;
    line-height: 1.4;
    margin-bottom: 1rem;
    transition: color 0.3s ease;
}

.hover-lift-university:hover .university-name {
    color: #003585;
}

.university-meta {
    margin-bottom: 1rem;
}

.university-meta .d-flex {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.university-meta i {
    width: 16px;
    font-size: 0.8rem;
}

.card-text {
    flex: 1;
    font-size: 0.9rem;
    line-height: 1.5;
    color: #6c757d;
    margin-bottom: 1rem;
}

/* Card Footer */
.hover-lift-university .card-footer {
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
    padding: 1.25rem 1.5rem;
    margin-top: auto;
    position: relative;
    z-index: 2;
}



.card-footer .btn {
    font-size: 0.9rem;
    font-weight: 500;
    padding: 0.625rem 1rem;
    border-radius: 6px;
    transition: all 0.3s ease;
}

/* Staggered Animation Delays */
.university-card-wrapper:nth-child(1) { animation-delay: 0.1s; }
.university-card-wrapper:nth-child(2) { animation-delay: 0.2s; }
.university-card-wrapper:nth-child(3) { animation-delay: 0.3s; }
.university-card-wrapper:nth-child(4) { animation-delay: 0.4s; }
.university-card-wrapper:nth-child(5) { animation-delay: 0.5s; }
.university-card-wrapper:nth-child(6) { animation-delay: 0.6s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.smooth-scroll {
    scroll-behavior: smooth;
}

/* Search and Filter Section */
.search-section .input-group-text {
    background: white;
    border: 1px solid #ced4da;
}

.search-section .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(0, 53, 133, 0.25);
}

/* Form Styling */
.form-label {
    font-weight: 500;
    color: var(--text-color);
    margin-bottom: 0.5rem;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(0, 53, 133, 0.25);
}

.text-danger {
    color: #dc3545 !important;
}

/* Consultation Card Styling */
.consultation-card {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
    border: none;
    border-radius: 12px;
    overflow: hidden;
}

/* Alert Styling */
.alert {
    border: none;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
}

.alert-success {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
    color: #721c24;
    border-left: 4px solid #dc3545;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .university-card-wrapper {
        margin-bottom: 1.5rem;
    }
    
    .university-image-container {
        height: 200px;
    }
}

@media (max-width: 992px) {
    #universitiesGrid {
        margin-top: 1.5rem;
    }
    
    .university-card-wrapper {
        margin-bottom: 1.5rem;
    }
    
    .university-image-container {
        height: 190px;
    }
    
    .hover-lift-university .card-body {
        padding: 1.25rem;
    }
    
    .hover-lift-university .card-footer {
        padding: 1rem 1.25rem;
    }
}

@media (max-width: 768px) {
    .university-partners-hero {
        padding: var(--xl) 0;
        min-height: 200px;
    }
    
    .hero-breadcrumb {
        margin-bottom: var(--lg);
        font-size: 0.8rem;
    }
    
    .airplane-1 {
        font-size: 2.5rem;
        top: 15%;
        right: 10%;
    }
    
    .airplane-2 {
        font-size: 1.5rem;
        top: 70%;
        right: 20%;
    }
    
    .airplane-3 {
        font-size: 2rem;
        top: 45%;
        right: 2%;
    }
    
    /* Card adjustments for tablet */
    .university-card-wrapper {
        margin-bottom: 1.5rem;
    }
    
    .university-image-container {
        height: 180px;
    }
    
    .university-name {
        font-size: 1rem;
    }
    
    .card-text {
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .university-partners-hero {
        padding: var(--lg) 0;
        min-height: 180px;
    }
    
    .hero-breadcrumb {
        margin-bottom: var(--md);
        font-size: 0.75rem;
        flex-wrap: wrap;
        gap: var(--xs);
    }
    
    .breadcrumb-separator {
        margin: 0 0.25rem;
    }
    
    .airplane-1 {
        font-size: 2rem;
        top: 10%;
        right: 5%;
    }
    
    .airplane-2 {
        font-size: 1.2rem;
        top: 75%;
        right: 15%;
    }
    
    .airplane-3 {
        display: none; /* Hide third airplane on mobile for cleaner look */
    }
    
    /* Mobile card adjustments */
    .university-card-wrapper {
        margin-bottom: 1.25rem;
    }
    
    .university-image-container {
        height: 160px;
    }
    
    .hover-lift-university .card-body {
        padding: 1rem;
    }
    
    .hover-lift-university .card-footer {
        padding: 1rem;
    }
    
    .university-name {
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
    }
    
    .university-meta {
        margin-bottom: 0.75rem;
    }
    
    .card-text {
        font-size: 0.8rem;
        margin-bottom: 0.75rem;
    }
    
    .card-footer .btn {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }
}

/* Accessibility and Motion Preferences */
.btn:focus,
.form-control:focus,
.form-select:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
    
    .hover-lift-university:hover {
        transform: none;
    }
    
    .university-featured-img {
        transition: none;
    }
}
</style>

<!-- External CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

<!-- JavaScript -->
<script src="assets/js/university-partners.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // University search and filter functionality
    const searchInput = document.getElementById('universitySearch');
    const sortFilter = document.getElementById('sortFilter');
    const universityCards = document.querySelectorAll('.university-card-wrapper');
    const universityCount = document.getElementById('universityCount');
    
    // Search functionality
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            let visibleCount = 0;
            
            universityCards.forEach(card => {
                const universityName = card.querySelector('.university-name').textContent.toLowerCase();
                const cardText = card.querySelector('.card-text').textContent.toLowerCase();
                
                if (universityName.includes(query) || cardText.includes(query) || query === '') {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            universityCount.textContent = `${visibleCount} Universities`;
        });
    }

});
</script>

<?php include 'includes/footer.php'; ?> 