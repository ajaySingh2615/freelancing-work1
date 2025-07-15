<?php
/**
 * Database Configuration
 * MedStudy Global - Blog System
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'medstudy_blog');
define('DB_USER', 'root');
define('DB_PASS', '');

// Cloudinary Configuration
define('CLOUDINARY_CLOUD_NAME', 'dswzvbhix');
define('CLOUDINARY_API_KEY', '443489439765691');
define('CLOUDINARY_API_SECRET', 'QQqfhuPJ_mv5L3u3ikvvA_DsZy4');

// Site Configuration
define('SITE_URL', 'http://localhost/Project-1/');
define('ADMIN_URL', SITE_URL . 'admin/');

// Database Connection Class
class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $conn;

    public function connect() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
                )
            );
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
        
        return $this->conn;
    }
    
    public function disconnect() {
        $this->conn = null;
    }
}

// Global Database Instance
$database = new Database();
$db = $database->connect();

// Check if tables exist, create if not
function createTables($db) {
    try {
        // Admin Users Table
        $db->exec("CREATE TABLE IF NOT EXISTS admin_users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            full_name VARCHAR(100) NOT NULL,
            role VARCHAR(20) DEFAULT 'admin',
            status ENUM('active', 'inactive') DEFAULT 'active',
            last_login TIMESTAMP NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        
        // Blog Categories Table
        $db->exec("CREATE TABLE IF NOT EXISTS blog_categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            slug VARCHAR(100) NOT NULL UNIQUE,
            description TEXT,
            color VARCHAR(7) DEFAULT '#003585',
            status ENUM('active', 'inactive') DEFAULT 'active',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        
        // Blogs Table
        $db->exec("CREATE TABLE IF NOT EXISTS blogs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL UNIQUE,
            excerpt TEXT,
            content LONGTEXT NOT NULL,
            featured_image VARCHAR(500),
            category_id INT,
            author_id INT,
            author_name VARCHAR(100),
            author_avatar VARCHAR(500),
            status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
            is_featured BOOLEAN DEFAULT FALSE,
            is_editors_pick BOOLEAN DEFAULT FALSE,
            views INT DEFAULT 0,
            
            -- SEO Fields
            meta_title VARCHAR(255),
            meta_description TEXT,
            meta_keywords VARCHAR(500),
            canonical_url VARCHAR(500),
            og_title VARCHAR(255),
            og_description TEXT,
            og_image VARCHAR(500),
            twitter_title VARCHAR(255),
            twitter_description TEXT,
            twitter_image VARCHAR(500),
            
            -- Schema.org structured data
            schema_type VARCHAR(50) DEFAULT 'Article',
            schema_data JSON,
            
            -- Timestamps
            published_at TIMESTAMP NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            
            -- Foreign Keys
            FOREIGN KEY (category_id) REFERENCES blog_categories(id) ON DELETE SET NULL,
            FOREIGN KEY (author_id) REFERENCES admin_users(id) ON DELETE SET NULL,
            
            -- Indexes
            INDEX idx_slug (slug),
            INDEX idx_status (status),
            INDEX idx_category (category_id),
            INDEX idx_featured (is_featured),
            INDEX idx_published (published_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        
        // Blog Tags Table (Many-to-Many relationship)
        $db->exec("CREATE TABLE IF NOT EXISTS blog_tags (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL UNIQUE,
            slug VARCHAR(50) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        
        $db->exec("CREATE TABLE IF NOT EXISTS blog_tag_relations (
            blog_id INT,
            tag_id INT,
            PRIMARY KEY (blog_id, tag_id),
            FOREIGN KEY (blog_id) REFERENCES blogs(id) ON DELETE CASCADE,
            FOREIGN KEY (tag_id) REFERENCES blog_tags(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        
        // Insert default admin user (password: admin123)
        $defaultAdmin = $db->prepare("INSERT IGNORE INTO admin_users (username, email, password, full_name) VALUES (?, ?, ?, ?)");
        $defaultAdmin->execute([
            'admin',
            'admin@medstudy.global',
            password_hash('admin123', PASSWORD_DEFAULT),
            'System Administrator'
        ]);
        
        // Insert default categories
        $categories = [
            ['Medical Education', 'medical-education', 'Articles about medical education and career guidance'],
            ['University Guide', 'university-guide', 'Information about medical universities worldwide'],
            ['Visa Guide', 'visa-guide', 'Student visa processes and requirements'],
            ['Scholarships', 'scholarships', 'Scholarship opportunities and application guides'],
            ['Student Life', 'student-life', 'Life as a medical student abroad'],
            ['Career Guidance', 'career-guidance', 'Medical career advice and specialization guides']
        ];
        
        $categoryStmt = $db->prepare("INSERT IGNORE INTO blog_categories (name, slug, description) VALUES (?, ?, ?)");
        foreach ($categories as $category) {
            $categoryStmt->execute($category);
        }
        
        return true;
        
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
}

// Create tables on first run
createTables($db);

// Helper Functions
function generateSlug($text) {
    // Convert to lowercase
    $text = strtolower($text);
    
    // Remove special characters except hyphens and spaces
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    
    // Replace spaces with hyphens
    $text = preg_replace('/\s+/', '-', $text);
    
    // Remove multiple consecutive hyphens
    $text = preg_replace('/-+/', '-', $text);
    
    // Remove leading/trailing hyphens
    $text = trim($text, '-');
    
    return $text;
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function formatDate($date) {
    return date('F j, Y', strtotime($date));
}

function timeAgo($datetime) {
    $time = time() - strtotime($datetime);
    
    if ($time < 60) return 'just now';
    if ($time < 3600) return floor($time/60) . ' minutes ago';
    if ($time < 86400) return floor($time/3600) . ' hours ago';
    if ($time < 2592000) return floor($time/86400) . ' days ago';
    if ($time < 31104000) return floor($time/2592000) . ' months ago';
    
    return floor($time/31104000) . ' years ago';
}
?> 