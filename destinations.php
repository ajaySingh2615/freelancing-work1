<?php
$page_title = "MBBS Destinations - Best Countries to Study Abroad";
$page_description = "Explore the best countries for MBBS studies abroad. Compare destinations, universities, and opportunities for medical education.";
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="destinations-hero">
    <div class="container">
        <div class="hero-content">
            <nav class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Countries</span>
            </nav>
            <h1 class="hero-title">Best Countries to Study Abroad</h1>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="search-section">
    <div class="container">
        <div class="search-wrapper">
            <div class="search-header">
                <p class="search-subtitle">Search through top MBBS destinations and find the perfect country for your medical education journey</p>
            </div>
            
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="countrySearch" placeholder="Search countries, universities, or student info..." class="search-input">
                    <div class="search-actions">
                        <button class="search-clear" id="searchClear">
                            <i class="fas fa-times"></i>
                        </button>
                        <button class="search-btn">
                            <i class="fas fa-search"></i>
                            Search
                        </button>
                    </div>
                </div>
                
                <div class="search-suggestions" id="searchSuggestions">
                    <!-- Suggestions will be populated by JavaScript -->
                </div>
            </div>
            
            <div class="search-stats">
                <span class="search-result-count" id="resultCount">12 Countries</span>
                <span>•</span>
                <span>Popular destinations for Indian students</span>
            </div>
            
            <div class="search-filters">
                <div class="filter-tag" data-filter="all">
                    <i class="fas fa-globe"></i>
                    All Countries
                </div>
                <div class="filter-tag" data-filter="europe">
                    <i class="fas fa-map-marker-alt"></i>
                    Europe
                </div>
                <div class="filter-tag" data-filter="asia">
                    <i class="fas fa-map-marker-alt"></i>
                    Asia
                </div>
                <div class="filter-tag" data-filter="popular">
                    <i class="fas fa-fire"></i>
                    Most Popular
                </div>
                <div class="filter-tag" data-filter="budget">
                    <i class="fas fa-dollar-sign"></i>
                    Budget Friendly
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Countries Grid Section -->
<section class="countries-section">
    <div class="container">
        <div class="countries-grid">
            
            <!-- Russia -->
            <div class="country-card" data-country="russia" data-region="asia" data-category="popular,budget">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-ru"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Russia</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            18039 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        Indians have been going to Russia to study Medicine since last 25 years. However, there are few top universities worth going due to English taught programs as per Indian government website.
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Georgia -->
            <div class="country-card" data-country="georgia" data-region="asia" data-category="popular,budget">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-ge"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Georgia</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            14000 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        Most of the universities in Georgia are privately run small scale colleges. However, Indian agents promote to earn money out of the students career. Be very careful before you select this country.
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Kazakhstan -->
            <div class="country-card" data-country="kazakhstan" data-region="asia" data-category="popular,budget">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-kz"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Kazakhstan</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            3555 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        Since 2017 onward, Kazakh has been increasingly popular among Indian students and the students are shifting their choice from Kyrgyzstan to Kazakh due to better quality of infra & education. It also offers 5 years of Medicine.
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Egypt -->
            <div class="country-card" data-country="egypt" data-region="africa" data-category="budget">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-eg"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Egypt</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            400 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        The ancient Egyptians practiced medicine with highly professional methods. They had advanced knowledge of anatomy and surgery. Universities in Egypt are Govt, rich history of teaching and Budget friendly.
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Nepal -->
            <div class="country-card" data-country="nepal" data-region="asia" data-category="popular,budget">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-np"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Nepal</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            2400 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        Nepal's Medical Education system is very similar to India's. The country offers NMC Seats of 6000 and 16 Private Medical colleges affiliated with Kathmandu & Tribhuvan University. As per NMC Nepal, 540 Seats are offered.
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- China -->
            <div class="country-card" data-country="china" data-region="asia" data-category="popular">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-cn"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">China</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            6346 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        China was the most popular destination till 2019 among Indian due to its superb infrastructure, allowing Students to do their 1 Year Internship in India after 5 Years of MBBS in China, and Affordable Tuition Fees. Post COVID.
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Uzbekistan -->
            <div class="country-card" data-country="uzbekistan" data-region="asia" data-category="budget">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-uz"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Uzbekistan</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            250 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        Uzbekistan, a former part of the USSR is located in central Asia. There are 8 Medical Colleges in Uzbekistan offering Medicine programs of 6 Years to the students. All 8 Medical Colleges are branches of these 8 Medical Colleges. T...
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Germany -->
            <div class="country-card" data-country="germany" data-region="europe" data-category="popular">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-de"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Germany</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            54864 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        Germany is 5th Largest Economy and Hub of Automobile Engineering companies of the world. Germany is a popular destination in Europe due to it's many excellent universities, its dynamic student life and good funding...
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Italy -->
            <div class="country-card" data-country="italy" data-region="europe" data-category="popular">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-it"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Italy</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            5897 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        Italy is a top rated destination among Indian Students. Italy Public Universities are offering more than 500 English taught programs to International Students. Government of Italy offers more than 6000 scholarships every year.
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Poland -->
            <div class="country-card" data-country="poland" data-region="europe" data-category="popular">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-pl"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Poland</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            5000 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        There are more than 1.2 million students studying in Poland, at almost 380 universities. Polish university education system has a history of 650 years of educating high profile professionals. Living in Poland as a student is relative...
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Belarus -->
            <div class="country-card" data-country="belarus" data-region="europe" data-category="budget">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-by"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Belarus</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            793 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        There are only 4 medical Universities in Belarus and all 4 are FQME accredited. Belarus has a very good student life and good infrastructure. Universities in Belarus are affordable and offer good quality education.
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
                    </div>
                </div>
            </div>

            <!-- Latvia -->
            <div class="country-card" data-country="latvia" data-region="europe" data-category="budget">
                <div class="country-header">
                    <div class="country-flag">
                        <span class="flag-icon flag-icon-lv"></span>
                    </div>
                    <div class="country-info">
                        <h3 class="country-name">Latvia</h3>
                        <p class="students-count">
                            <i class="fas fa-users"></i>
                            1000 Indian Students
                        </p>
                    </div>
                </div>
                <div class="country-content">
                    <p class="country-description">
                        Latvia member of EU and NATO lies on the eastern shore of the Baltic Sea. The capital, Riga is a beautiful city with rich history and culture. Universities in Latvia offer excellent education with modern facilities.
                    </p>
                    <div class="country-actions">
                        <a href="#" class="btn btn-secondary">Explore Universities</a>
                        <a href="#" class="btn btn-accent">Talk to Counselor</a>
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
            <h2 class="cta-title">Ready to Start Your Medical Journey?</h2>
            <p class="cta-description">Get personalized guidance from our expert counselors and find the perfect destination for your MBBS studies.</p>
            <div class="cta-buttons">
                <a href="contact.php" class="btn btn-primary">Get Free Consultation</a>
            </div>
        </div>
    </div>
</section>

<!-- External CSS -->
<link rel="stylesheet" href="assets/css/destinations.css">

<!-- Flag Icons CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- JavaScript for Enhanced Functionality -->
<script src="assets/js/destinations.js"></script>
<script>
// Add tracking attributes to buttons
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.country-actions .btn');
    buttons.forEach(button => {
        const text = button.textContent.trim().toLowerCase();
        if (text.includes('explore universities')) {
            button.setAttribute('data-track', 'explore_universities');
        } else if (text.includes('talk to counselor')) {
            button.setAttribute('data-track', 'talk_to_counselor');
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?> 