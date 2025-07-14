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
    
    <style>
        .blog-detail-page {
            padding: 2rem 0 4rem 0;
            background: #f8f9fa;
        }
        
        .blog-header {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .blog-featured-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        
        .blog-header-content {
            padding: 2rem;
        }
        
        .blog-category {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            margin-bottom: 1rem;
        }
        
        .blog-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        
        .blog-meta {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        
        .author-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
        }
        
        .author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .author-details h6 {
            margin: 0;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .author-details span {
            font-size: 0.875rem;
            color: #6c757d;
        }
        
        .blog-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.875rem;
            color: #6c757d;
        }
        
        .blog-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            line-height: 1.8;
        }
        
        .blog-content h1, .blog-content h2, .blog-content h3, 
        .blog-content h4, .blog-content h5, .blog-content h6 {
            color: #2c3e50;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        
        .blog-content p {
            margin-bottom: 1.5rem;
            color: #495057;
        }
        
        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1rem 0;
        }
        
        .social-share {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .social-share h5 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        
        .share-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        
        .share-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .share-btn.facebook { background: #1877f2; }
        .share-btn.twitter { background: #1da1f2; }
        .share-btn.linkedin { background: #0077b5; }
        .share-btn.whatsapp { background: #25d366; }
        .share-btn.email { background: #6c757d; }
        
        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            color: white;
        }
        
        .blog-navigation {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .nav-posts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .nav-post {
            text-decoration: none;
            padding: 1rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .nav-post:hover {
            border-color: #007bff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .nav-post.prev {
            text-align: left;
        }
        
        .nav-post.next {
            text-align: right;
        }
        
        .nav-label {
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        
        .nav-title {
            color: #2c3e50;
            font-weight: 600;
            margin: 0;
        }
        
        .related-posts {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .related-posts h4 {
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }
        
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .related-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .related-card:hover {
            border-color: #007bff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-decoration: none;
        }
        
        .related-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        
        .related-content {
            padding: 1rem;
        }
        
        .related-category {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        
        .related-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }
        
        .related-meta {
            font-size: 0.75rem;
            color: #6c757d;
        }
        
        @media (max-width: 768px) {
            .blog-title {
                font-size: 2rem;
            }
            
            .blog-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .nav-posts {
                grid-template-columns: 1fr;
            }
            
            .share-buttons {
                justify-content: center;
            }
            
            .related-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="blog-detail-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- Blog Header -->
                    <article class="blog-header">
                        <?php if ($post['featured_image']): ?>
                        <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
                             alt="<?php echo htmlspecialchars($post['title']); ?>" 
                             class="blog-featured-image">
                        <?php endif; ?>
                        
                        <div class="blog-header-content">
                            <?php if ($post['category_name']): ?>
                            <span class="blog-category" style="background-color: <?php echo htmlspecialchars($post['category_color'] ?? '#007bff'); ?>">
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
                                    <div class="related-category" style="color: <?php echo htmlspecialchars($related['category_color'] ?? '#007bff'); ?>">
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
                    
                    <!-- Back to Blog -->
                    <div class="text-center mt-4">
                        <a href="blog.php" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to All Articles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html> 