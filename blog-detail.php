<?php 
require_once 'config/database.php';

// Database connection
$database = new Database();
$db = $database->connect();

// Get blog slug from URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

if (empty($slug)) {
    header("Location: blog.php");
    exit();
}

// Get blog post
try {
    $post_query = "SELECT b.*, c.name as category_name, c.slug as category_slug, c.color as category_color 
                   FROM blogs b 
                   LEFT JOIN blog_categories c ON b.category_id = c.id 
                   WHERE b.slug = ? AND b.status = 'published'";
    $post_stmt = $db->prepare($post_query);
    $post_stmt->execute([$slug]);
    $post = $post_stmt->fetch();
    
    if (!$post) {
        header("Location: blog.php");
        exit();
    }
    
    // Update view count
    $update_views = "UPDATE blogs SET views = views + 1 WHERE id = ?";
    $update_stmt = $db->prepare($update_views);
    $update_stmt->execute([$post['id']]);
    
} catch (Exception $e) {
    header("Location: blog.php");
    exit();
}

// Get related posts (same category, excluding current post)
try {
    $related_query = "SELECT b.*, c.name as category_name, c.slug as category_slug, c.color as category_color 
                     FROM blogs b 
                     LEFT JOIN blog_categories c ON b.category_id = c.id 
                     WHERE b.category_id = ? AND b.id != ? AND b.status = 'published' 
                     ORDER BY b.published_at DESC 
                     LIMIT 3";
    $related_stmt = $db->prepare($related_query);
    $related_stmt->execute([$post['category_id'], $post['id']]);
    $related_posts = $related_stmt->fetchAll();
} catch (Exception $e) {
    $related_posts = [];
}

// Get previous and next posts
try {
    $prev_query = "SELECT id, title, slug FROM blogs 
                   WHERE published_at < ? AND status = 'published' 
                   ORDER BY published_at DESC LIMIT 1";
    $prev_stmt = $db->prepare($prev_query);
    $prev_stmt->execute([$post['published_at']]);
    $prev_post = $prev_stmt->fetch();
    
    $next_query = "SELECT id, title, slug FROM blogs 
                   WHERE published_at > ? AND status = 'published' 
                   ORDER BY published_at ASC LIMIT 1";
    $next_stmt = $db->prepare($next_query);
    $next_stmt->execute([$post['published_at']]);
    $next_post = $next_stmt->fetch();
} catch (Exception $e) {
    $prev_post = null;
    $next_post = null;
}

// SEO Meta data
$page_title = $post['meta_title'] ?: $post['title'];
$page_description = $post['meta_description'] ?: $post['excerpt'];
$page_keywords = $post['meta_keywords'] ?: '';
$canonical_url = $post['canonical_url'] ?: SITE_URL . 'blog-detail.php?slug=' . $post['slug'];
$og_image = $post['og_image'] ?: $post['featured_image'];
$current_url = SITE_URL . 'blog-detail.php?slug=' . $post['slug'];

// Fetch tags for this blog post
$tags = [];
try {
    $tag_query = "SELECT t.name, t.slug FROM blog_tags t INNER JOIN blog_tag_relations r ON t.id = r.tag_id WHERE r.blog_id = ? ORDER BY t.name";
    $tag_stmt = $db->prepare($tag_query);
    $tag_stmt->execute([$post['id']]);
    $tags = $tag_stmt->fetchAll();
} catch (Exception $e) {
    $tags = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?php echo htmlspecialchars($page_title); ?> | MedStudy Global</title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <?php if (!empty($page_keywords)): ?>
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    <?php endif; ?>
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($post['og_title'] ?: $post['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($post['og_description'] ?: $page_description); ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo htmlspecialchars($current_url); ?>">
    <?php if ($og_image): ?>
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <meta property="og:image:alt" content="<?php echo htmlspecialchars($post['title']); ?>">
    <?php endif; ?>
    <meta property="article:author" content="<?php echo htmlspecialchars($post['author_name']); ?>">
    <meta property="article:published_time" content="<?php echo date('c', strtotime($post['published_at'])); ?>">
    <meta property="article:modified_time" content="<?php echo date('c', strtotime($post['updated_at'])); ?>">
    <?php if ($post['category_name']): ?>
    <meta property="article:section" content="<?php echo htmlspecialchars($post['category_name']); ?>">
    <?php endif; ?>
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($post['twitter_title'] ?: $post['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($post['twitter_description'] ?: $page_description); ?>">
    <?php if ($post['twitter_image'] ?: $og_image): ?>
    <meta name="twitter:image" content="<?php echo htmlspecialchars($post['twitter_image'] ?: $og_image); ?>">
    <?php endif; ?>
    
    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    <?php
    $schema = [
        "@context" => "https://schema.org",
        "@type" => $post['schema_type'] ?: "Article",
        "headline" => $post['title'],
        "description" => $page_description,
        "image" => $og_image ?: "",
        "author" => [
            "@type" => "Person",
            "name" => $post['author_name']
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => "MedStudy Global",
            "logo" => [
                "@type" => "ImageObject",
                "url" => SITE_URL . "assets/images/media/logo/sunrise-logo.webp"
            ]
        ],
        "datePublished" => date('c', strtotime($post['published_at'])),
        "dateModified" => date('c', strtotime($post['updated_at'])),
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $current_url
        ]
    ];
    
    if ($post['schema_data']) {
        $custom_schema = json_decode($post['schema_data'], true);
        if ($custom_schema) {
            $schema = array_merge($schema, $custom_schema);
        }
    }
    
    echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    ?>
    </script>
    
    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/blog-detail.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="blog-detail-page">
        <div class="container">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-white p-3 rounded shadow-sm">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="blog.php">Blog</a></li>
                    <?php if ($post['category_name']): ?>
                    <li class="breadcrumb-item"><a href="blog.php?category=<?php echo urlencode($post['category_slug']); ?>"><?php echo htmlspecialchars($post['category_name']); ?></a></li>
                    <?php endif; ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($post['title']); ?></li>
                </ol>
            </nav>
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8 order-2 order-lg-1">
                    <!-- Blog Header -->
                    <article class="blog-header">
                        <?php if ($post['featured_image']): ?>
                        <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
                             alt="<?php echo htmlspecialchars($post['title']); ?>" 
                             class="blog-featured-image">
                        <?php endif; ?>
                        
                        <div class="blog-header-content">
                            <?php if ($post['category_name']): ?>
                            <span class="blog-category" style="background-color: <?php echo htmlspecialchars($post['category_color'] ?? '#007bff'); ?>;">
                                <?php echo htmlspecialchars($post['category_name']); ?>
                            </span>
                            <?php endif; ?>
                            
                            <h1 class="blog-title"><?php echo htmlspecialchars($post['title']); ?></h1>
                            
                            <div class="blog-meta">
                                <div class="author-info">
                                    <div class="author-avatar">
                                        <img src="<?php echo $post['author_avatar'] ?: 'assets/images/media/about-page/our-team/mohd irshad.webp'; ?>" 
                                             alt="<?php echo htmlspecialchars($post['author_name']); ?>">
                                    </div>
                                    <div class="author-details">
                                        <h6><?php echo htmlspecialchars($post['author_name']); ?></h6>
                                        <span><?php echo formatDate($post['published_at']); ?></span>
                                    </div>
                                </div>
                                
                                <div class="blog-stats">
                                    <span><i class="far fa-eye"></i> <?php echo number_format($post['views']); ?> views</span>
                                    <span><i class="far fa-clock"></i> <?php echo ceil(str_word_count(strip_tags($post['content'])) / 200); ?> min read</span>
                                </div>
                            </div>
                            
                            <?php if ($post['excerpt']): ?>
                            <p class="blog-excerpt text-muted"><?php echo htmlspecialchars($post['excerpt']); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                    <!-- Blog Content -->
                    <div class="blog-content">
                        <?php echo $post['content']; ?>
                    </div>
                    <!-- Tags Section -->
                    <?php if (!empty($tags)): ?>
                    <div class="mb-4">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <span class="fw-bold text-secondary me-2">Tags:</span>
                            <?php foreach ($tags as $tag): ?>
                                <a href="blog.php?tag=<?php echo urlencode($tag['slug']); ?>" class="badge bg-light text-primary border border-primary fw-normal px-3 py-2 text-decoration-none">
                                    #<?php echo htmlspecialchars($tag['name']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- Author Box -->
                    <div class="author-box bg-white rounded shadow-sm p-4 mb-4 d-flex align-items-center gap-4">
                        <div class="author-avatar flex-shrink-0" style="width: 80px; height: 80px;">
                            <img src="<?php echo $post['author_avatar'] ?: 'assets/images/media/about-page/our-team/mohd irshad.webp'; ?>" alt="<?php echo htmlspecialchars($post['author_name']); ?>" class="rounded-circle w-100 h-100 object-fit-cover">
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-primary"><?php echo htmlspecialchars($post['author_name']); ?></h5>
                            <div class="mb-2 text-muted" style="font-size: 0.95rem;">MedStudy Global Contributor</div>
                            <div class="mb-2" style="max-width: 500px;">
                                <!-- Hardcoded bio, can be made dynamic later -->
                                <span>Passionate about medical education, student success, and global opportunities. Sharing insights to help students achieve their dreams.</span>
                            </div>
                            <div class="author-social d-flex gap-2">
                                <a href="#" class="text-primary" title="LinkedIn" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
                                <a href="#" class="text-info" title="Twitter" target="_blank"><i class="fab fa-twitter fa-lg"></i></a>
                                <a href="#" class="text-danger" title="Email"><i class="far fa-envelope fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Social Share -->
                    <div class="social-share">
                        <h5><i class="fas fa-share-alt"></i> Share this article</h5>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($current_url); ?>" 
                               target="_blank" class="share-btn facebook">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($current_url); ?>&text=<?php echo urlencode($post['title']); ?>" 
                               target="_blank" class="share-btn twitter">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($current_url); ?>" 
                               target="_blank" class="share-btn linkedin">
                                <i class="fab fa-linkedin-in"></i> LinkedIn
                            </a>
                            <a href="https://wa.me/?text=<?php echo urlencode($post['title'] . ' - ' . $current_url); ?>" 
                               target="_blank" class="share-btn whatsapp">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="mailto:?subject=<?php echo urlencode($post['title']); ?>&body=<?php echo urlencode('Check out this article: ' . $current_url); ?>" 
                               class="share-btn email">
                                <i class="far fa-envelope"></i> Email
                            </a>
                        </div>
                    </div>
                    <!-- Blog Navigation -->
                    <?php if ($prev_post || $next_post): ?>
                    <div class="blog-navigation">
                        <div class="nav-posts">
                            <?php if ($prev_post): ?>
                            <a href="blog-detail.php?slug=<?php echo urlencode($prev_post['slug']); ?>" class="nav-post prev">
                                <div class="nav-label"><i class="fas fa-chevron-left"></i> Previous Article</div>
                                <h6 class="nav-title"><?php echo htmlspecialchars($prev_post['title']); ?></h6>
                            </a>
                            <?php else: ?>
                            <div></div>
                            <?php endif; ?>
                            <?php if ($next_post): ?>
                            <a href="blog-detail.php?slug=<?php echo urlencode($next_post['slug']); ?>" class="nav-post next">
                                <div class="nav-label">Next Article <i class="fas fa-chevron-right"></i></div>
                                <h6 class="nav-title"><?php echo htmlspecialchars($next_post['title']); ?></h6>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- Back to Blog -->
                    <div class="text-center mt-4">
                        <a href="blog.php" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to All Articles
                        </a>
                    </div>
                </div>
                <!-- Sidebar -->
                <aside class="col-lg-4 order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="blog-sidebar sticky-sidebar">
                        <!-- Table of Contents -->
                        <div id="toc" class="mb-4"></div>
                        <!-- Related Posts -->
                        <?php if (!empty($related_posts)): ?>
                        <div class="related-posts">
                            <h4><i class="fas fa-newspaper"></i> Related Articles</h4>
                            <div class="related-grid">
                                <?php foreach ($related_posts as $related): ?>
                                <a href="blog-detail.php?slug=<?php echo urlencode($related['slug']); ?>" class="related-card">
                                    <?php if ($related['featured_image']): ?>
                                    <img src="<?php echo htmlspecialchars($related['featured_image']); ?>" 
                                         alt="<?php echo htmlspecialchars($related['title']); ?>" 
                                         class="related-image">
                                    <?php endif; ?>
                                    <div class="related-content">
                                        <?php if ($related['category_name']): ?>
                                        <div class="related-category" style="color: <?php echo htmlspecialchars($related['category_color'] ?? '#007bff'); ?>;">
                                            <?php echo htmlspecialchars($related['category_name']); ?>
                                        </div>
                                        <?php endif; ?>
                                        <h6 class="related-title"><?php echo htmlspecialchars($related['title']); ?></h6>
                                        <div class="related-meta">
                                            <?php echo htmlspecialchars($related['author_name']); ?> • 
                                            <?php echo timeAgo($related['published_at']); ?>
                                        </div>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html> 