<?php
session_start();
require_once '../config/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->connect();

$errors = [];
$success = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $name = sanitizeInput($_POST['name']);
                $description = sanitizeInput($_POST['description']);
                $color = sanitizeInput($_POST['color']);
                $status = sanitizeInput($_POST['status']);
                
                if (empty($name)) {
                    $errors[] = "Category name is required";
                } else {
                    $slug = generateSlug($name);
                    
                    // Check if slug already exists
                    $check_query = "SELECT id FROM blog_categories WHERE slug = ?";
                    $check_stmt = $db->prepare($check_query);
                    $check_stmt->execute([$slug]);
                    
                    if ($check_stmt->fetch()) {
                        $errors[] = "A category with this name already exists";
                    } else {
                        try {
                            $insert_query = "INSERT INTO blog_categories (name, slug, description, color, status) VALUES (?, ?, ?, ?, ?)";
                            $insert_stmt = $db->prepare($insert_query);
                            $insert_stmt->execute([$name, $slug, $description, $color, $status]);
                            $success = "Category added successfully!";
                        } catch (Exception $e) {
                            $errors[] = "Error adding category: " . $e->getMessage();
                        }
                    }
                }
                break;
                
            case 'edit':
                $id = intval($_POST['id']);
                $name = sanitizeInput($_POST['name']);
                $description = sanitizeInput($_POST['description']);
                $color = sanitizeInput($_POST['color']);
                $status = sanitizeInput($_POST['status']);
                
                if (empty($name)) {
                    $errors[] = "Category name is required";
                } else {
                    $slug = generateSlug($name);
                    
                    // Check if slug already exists for other categories
                    $check_query = "SELECT id FROM blog_categories WHERE slug = ? AND id != ?";
                    $check_stmt = $db->prepare($check_query);
                    $check_stmt->execute([$slug, $id]);
                    
                    if ($check_stmt->fetch()) {
                        $errors[] = "A category with this name already exists";
                    } else {
                        try {
                            $update_query = "UPDATE blog_categories SET name = ?, slug = ?, description = ?, color = ?, status = ? WHERE id = ?";
                            $update_stmt = $db->prepare($update_query);
                            $update_stmt->execute([$name, $slug, $description, $color, $status, $id]);
                            $success = "Category updated successfully!";
                        } catch (Exception $e) {
                            $errors[] = "Error updating category: " . $e->getMessage();
                        }
                    }
                }
                break;
                
            case 'delete':
                $id = intval($_POST['id']);
                
                try {
                    // Check if category is being used by any blogs
                    $usage_query = "SELECT COUNT(*) as count FROM blogs WHERE category_id = ?";
                    $usage_stmt = $db->prepare($usage_query);
                    $usage_stmt->execute([$id]);
                    $usage_count = $usage_stmt->fetch()['count'];
                    
                    if ($usage_count > 0) {
                        $errors[] = "Cannot delete category. It is being used by $usage_count blog post(s).";
                    } else {
                        $delete_query = "DELETE FROM blog_categories WHERE id = ?";
                        $delete_stmt = $db->prepare($delete_query);
                        $delete_stmt->execute([$id]);
                        $success = "Category deleted successfully!";
                    }
                } catch (Exception $e) {
                    $errors[] = "Error deleting category: " . $e->getMessage();
                }
                break;
                
            case 'toggle_status':
                $id = intval($_POST['id']);
                $status = sanitizeInput($_POST['status']);
                
                try {
                    $update_query = "UPDATE blog_categories SET status = ? WHERE id = ?";
                    $update_stmt = $db->prepare($update_query);
                    $update_stmt->execute([$status, $id]);
                    $success = "Category status updated successfully!";
                } catch (Exception $e) {
                    $errors[] = "Error updating category status: " . $e->getMessage();
                }
                break;
        }
    }
}

// Get all categories with blog count
try {
    $categories_query = "SELECT c.*, COUNT(b.id) as blog_count 
                        FROM blog_categories c 
                        LEFT JOIN blogs b ON c.id = b.category_id 
                        GROUP BY c.id 
                        ORDER BY c.created_at DESC";
    $categories_stmt = $db->prepare($categories_query);
    $categories_stmt->execute();
    $categories = $categories_stmt->fetchAll();
} catch (Exception $e) {
    $errors[] = "Error loading categories: " . $e->getMessage();
    $categories = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Admin Panel</title>
    
    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin-styles.css">
    
    <style>
        .category-color {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid #ddd;
            display: inline-block;
            margin-right: 0.5rem;
        }
        
        .category-card {
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }
        
        .category-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        
        .color-picker {
            width: 50px;
            height: 40px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .stats-card .stats-number {
            font-size: 2rem;
            font-weight: bold;
        }
        
        .action-buttons .btn {
            margin-right: 0.25rem;
            margin-bottom: 0.25rem;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <nav class="admin-sidebar">
            <div class="sidebar-header">
                <h4><i class="fas fa-graduation-cap"></i> MedStudy Admin</h4>
            </div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="add-blog.php"><i class="fas fa-plus"></i> Add Blog</a></li>
                <li class="active"><a href="manage-categories.php"><i class="fas fa-tags"></i> Categories</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1><i class="fas fa-tags"></i> Manage Blog Categories</h1>
                <p>Create, edit, and manage blog categories for better content organization</p>
            </div>

            <div class="admin-content">
                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="stats-number"><?php echo count($categories); ?></div>
                            <div>Total Categories</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="stats-number"><?php echo count(array_filter($categories, function($c) { return $c['status'] === 'active'; })); ?></div>
                            <div>Active Categories</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="stats-number"><?php echo array_sum(array_column($categories, 'blog_count')); ?></div>
                            <div>Total Blog Posts</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addCategoryModal">
                                <i class="fas fa-plus"></i> Add New Category
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <!-- Categories Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-list"></i> All Categories</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if (!empty($categories)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Color</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Blog Posts</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                    <tr>
                                        <td>
                                            <div class="category-color" style="background-color: <?php echo htmlspecialchars($category['color']); ?>"></div>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($category['name']); ?></strong>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($category['description'] ?: 'No description'); ?>
                                        </td>
                                        <td>
                                            <code><?php echo htmlspecialchars($category['slug']); ?></code>
                                        </td>
                                        <td>
                                            <span class="badge status-badge <?php echo $category['status'] === 'active' ? 'badge-success' : 'badge-secondary'; ?>">
                                                <?php echo ucfirst($category['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info"><?php echo $category['blog_count']; ?> posts</span>
                                        </td>
                                        <td>
                                            <small class="text-muted"><?php echo formatDate($category['created_at']); ?></small>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                                        onclick="editCategory(<?php echo htmlspecialchars(json_encode($category)); ?>)">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                
                                                <form method="POST" style="display: inline-block;">
                                                    <input type="hidden" name="action" value="toggle_status">
                                                    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                                    <input type="hidden" name="status" value="<?php echo $category['status'] === 'active' ? 'inactive' : 'active'; ?>">
                                                    <button type="submit" class="btn btn-sm <?php echo $category['status'] === 'active' ? 'btn-outline-warning' : 'btn-outline-success'; ?>">
                                                        <i class="fas <?php echo $category['status'] === 'active' ? 'fa-pause' : 'fa-play'; ?>"></i> 
                                                        <?php echo $category['status'] === 'active' ? 'Deactivate' : 'Activate'; ?>
                                                    </button>
                                                </form>
                                                
                                                <?php if ($category['blog_count'] == 0): ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                        onclick="deleteCategory(<?php echo $category['id']; ?>, '<?php echo htmlspecialchars($category['name']); ?>')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                            <h5>No categories found</h5>
                            <p class="text-muted">Create your first category to get started</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                                <i class="fas fa-plus"></i> Add Category
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus"></i> Add New Category</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        
                        <div class="form-group">
                            <label for="add_name">Category Name *</label>
                            <input type="text" class="form-control" id="add_name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="add_description">Description</label>
                            <textarea class="form-control" id="add_description" name="description" rows="3"></textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="add_color">Category Color</label>
                                <input type="color" class="form-control color-picker" id="add_color" name="color" value="#007bff">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="add_status">Status</label>
                                <select class="form-control" id="add_status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Category</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" id="edit_id">
                        
                        <div class="form-group">
                            <label for="edit_name">Category Name *</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="edit_description">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="edit_color">Category Color</label>
                                <input type="color" class="form-control color-picker" id="edit_color" name="color">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_status">Status</label>
                                <select class="form-control" id="edit_status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-trash"></i> Delete Category</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the category "<strong id="delete_category_name"></strong>"?</p>
                    <p class="text-danger"><small><i class="fas fa-exclamation-triangle"></i> This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" id="delete_category_id">
                        <button type="submit" class="btn btn-danger">Delete Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function editCategory(category) {
            $('#edit_id').val(category.id);
            $('#edit_name').val(category.name);
            $('#edit_description').val(category.description || '');
            $('#edit_color').val(category.color);
            $('#edit_status').val(category.status);
            $('#editCategoryModal').modal('show');
        }
        
        function deleteCategory(id, name) {
            $('#delete_category_id').val(id);
            $('#delete_category_name').text(name);
            $('#deleteModal').modal('show');
        }
        
        // Auto-dismiss alerts
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    </script>
</body>
</html> 