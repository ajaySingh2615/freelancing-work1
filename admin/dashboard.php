<?php
session_start();
require_once '../config/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Get statistics
try {
    $statsQuery = $db->prepare("
        SELECT 
            COUNT(CASE WHEN status = 'published' THEN 1 END) as published_blogs,
            COUNT(CASE WHEN status = 'draft' THEN 1 END) as draft_blogs,
            COUNT(CASE WHEN status = 'archived' THEN 1 END) as archived_blogs,
            SUM(views) as total_views,
            COUNT(*) as total_blogs
        FROM blogs
    ");
    $statsQuery->execute();
    $stats = $statsQuery->fetch();
    
    // Get recent blogs
    $recentBlogs = $db->prepare("
        SELECT b.*, c.name as category_name, c.color as category_color
        FROM blogs b
        LEFT JOIN blog_categories c ON b.category_id = c.id
        ORDER BY b.created_at DESC
        LIMIT 10
    ");
    $recentBlogs->execute();
    $recent = $recentBlogs->fetchAll();
    
    // Get categories
    $categoriesQuery = $db->prepare("SELECT * FROM blog_categories ORDER BY name");
    $categoriesQuery->execute();
    $categories = $categoriesQuery->fetchAll();
    
} catch (Exception $e) {
    $error = "Error loading dashboard data: " . $e->getMessage();
}

// Handle quick actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'toggle_status':
                $blogId = intval($_POST['blog_id']);
                $newStatus = sanitizeInput($_POST['new_status']);
                
                try {
                    $updateQuery = $db->prepare("UPDATE blogs SET status = ? WHERE id = ?");
                    $updateQuery->execute([$newStatus, $blogId]);
                    $success = "Blog status updated successfully!";
                } catch (Exception $e) {
                    $error = "Error updating blog status.";
                }
                break;
                
            case 'delete_blog':
                $blogId = intval($_POST['blog_id']);
                
                try {
                    $deleteQuery = $db->prepare("DELETE FROM blogs WHERE id = ?");
                    $deleteQuery->execute([$blogId]);
                    $success = "Blog deleted successfully!";
                } catch (Exception $e) {
                    $error = "Error deleting blog.";
                }
                break;
        }
        
        // Refresh the page to show updated data
        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MedStudy Global</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Admin CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        
        .admin-header {
            background: linear-gradient(135deg, #003585 0%, #002a6a 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .admin-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .admin-nav {
            background: white;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .nav-pills .nav-link {
            color: #666;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .nav-pills .nav-link:hover {
            background: #f8f9fa;
            color: #003585;
        }
        
        .nav-pills .nav-link.active {
            background: #003585;
            color: white;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #003585;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card.published {
            border-left-color: #28a745;
        }
        
        .stat-card.draft {
            border-left-color: #ffc107;
        }
        
        .stat-card.archived {
            border-left-color: #6c757d;
        }
        
        .stat-card.views {
            border-left-color: #17a2b8;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #003585;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-icon {
            float: right;
            font-size: 2rem;
            opacity: 0.3;
        }
        
        .content-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #003585;
        }
        
        .blog-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .blog-table th,
        .blog-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .blog-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }
        
        .blog-table tr:hover {
            background: #f8f9fa;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
        }
        
        .status-published {
            background: #d4edda;
            color: #155724;
        }
        
        .status-draft {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-archived {
            background: #f8d7da;
            color: #721c24;
        }
        
        .category-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            color: white;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }
        
        .btn-primary {
            background: #003585;
            border-color: #003585;
        }
        
        .btn-primary:hover {
            background: #002a6a;
            border-color: #002a6a;
        }
        
        .btn-success {
            background: #28a745;
            border-color: #28a745;
        }
        
        .btn-warning {
            background: #ffc107;
            border-color: #ffc107;
            color: #333;
        }
        
        .btn-danger {
            background: #dc3545;
            border-color: #dc3545;
        }
        
        .quick-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .quick-action-btn {
            padding: 1rem 2rem;
            background: #003585;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .quick-action-btn:hover {
            background: #002a6a;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }
        
        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: #c82333;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .blog-table {
                font-size: 0.9rem;
            }
            
            .blog-table th,
            .blog-table td {
                padding: 0.75rem;
            }
            
            .quick-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <div class="admin-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
                </div>
                <div class="col-md-6 text-right">
                    <span class="mr-3">Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</span>
                    <a href="logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Admin Navigation -->
    <div class="admin-nav">
        <div class="container">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add-blog.php">
                        <i class="fas fa-plus"></i> Add Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-categories.php">
                        <i class="fas fa-tags"></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../blog.php" target="_blank">
                        <i class="fas fa-external-link-alt"></i> View Blog
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="container mt-4">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card published">
                <div class="stat-number"><?php echo $stats['published_blogs']; ?></div>
                <div class="stat-label">Published Blogs</div>
                <i class="fas fa-check-circle stat-icon"></i>
            </div>
            
            <div class="stat-card draft">
                <div class="stat-number"><?php echo $stats['draft_blogs']; ?></div>
                <div class="stat-label">Draft Blogs</div>
                <i class="fas fa-edit stat-icon"></i>
            </div>
            
            <div class="stat-card archived">
                <div class="stat-number"><?php echo $stats['archived_blogs']; ?></div>
                <div class="stat-label">Archived Blogs</div>
                <i class="fas fa-archive stat-icon"></i>
            </div>
            
            <div class="stat-card views">
                <div class="stat-number"><?php echo number_format($stats['total_views']); ?></div>
                <div class="stat-label">Total Views</div>
                <i class="fas fa-eye stat-icon"></i>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="add-blog.php" class="quick-action-btn">
                <i class="fas fa-plus"></i> Add New Blog
            </a>
            <a href="manage-categories.php" class="quick-action-btn">
                <i class="fas fa-tags"></i> Manage Categories
            </a>
        </div>
        
        <!-- Recent Blogs -->
        <div class="content-section">
            <h2 class="section-title">Recent Blogs</h2>
            
            <?php if (empty($recent)): ?>
                <div class="empty-state">
                    <i class="fas fa-blog"></i>
                    <h3>No blogs yet</h3>
                    <p>Start by creating your first blog post!</p>
                    <a href="add-blog.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create First Blog
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="blog-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent as $blog): ?>
                                <tr>
                                    <td>
                                        <strong><?php echo htmlspecialchars($blog['title']); ?></strong>
                                        <?php if ($blog['is_featured']): ?>
                                            <span class="badge badge-warning ml-1">Featured</span>
                                        <?php endif; ?>
                                        <?php if ($blog['is_editors_pick']): ?>
                                            <span class="badge badge-info ml-1">Editor's Pick</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($blog['category_name']): ?>
                                            <span class="category-badge" style="background-color: <?php echo $blog['category_color']; ?>">
                                                <?php echo htmlspecialchars($blog['category_name']); ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">No Category</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="status-badge status-<?php echo $blog['status']; ?>">
                                            <?php echo ucfirst($blog['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo number_format($blog['views']); ?></td>
                                    <td><?php echo timeAgo($blog['created_at']); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="edit-blog.php?id=<?php echo $blog['id']; ?>" 
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <?php if ($blog['status'] === 'published'): ?>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="toggle_status">
                                                    <input type="hidden" name="blog_id" value="<?php echo $blog['id']; ?>">
                                                    <input type="hidden" name="new_status" value="draft">
                                                    <button type="submit" class="btn btn-sm btn-warning" title="Unpublish">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="toggle_status">
                                                    <input type="hidden" name="blog_id" value="<?php echo $blog['id']; ?>">
                                                    <input type="hidden" name="new_status" value="published">
                                                    <button type="submit" class="btn btn-sm btn-success" title="Publish">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            
                                            <form method="POST" style="display: inline;" 
                                                  onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                                <input type="hidden" name="action" value="delete_blog">
                                                <input type="hidden" name="blog_id" value="<?php echo $blog['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-refresh stats every 30 seconds
        setInterval(function() {
            // You can implement AJAX refresh here if needed
        }, 30000);
        
        // Confirm delete actions
        document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this blog?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html> 