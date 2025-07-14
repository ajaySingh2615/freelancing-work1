<?php
/**
 * Cloudinary Helper Functions
 * MedStudy Global - Blog System
 */

require_once '../config/database.php';

/**
 * Upload image to Cloudinary
 */
function uploadToCloudinary($file, $folder = 'blog-images') {
    $cloudName = CLOUDINARY_CLOUD_NAME;
    $apiKey = CLOUDINARY_API_KEY;
    $apiSecret = CLOUDINARY_API_SECRET;
    
    // Validate file
    if (!isset($file['tmp_name']) || !file_exists($file['tmp_name'])) {
        return ['error' => 'No file provided'];
    }
    
    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        return ['error' => 'Invalid file type. Only JPEG, PNG, GIF, and WebP are allowed.'];
    }
    
    // Check file size (max 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        return ['error' => 'File too large. Maximum size is 5MB.'];
    }
    
    try {
        $timestamp = time();
        $publicId = $folder . '/' . uniqid() . '_' . $timestamp;
        
        // Generate signature
        $params = [
            'public_id' => $publicId,
            'timestamp' => $timestamp,
            'folder' => $folder
        ];
        
        ksort($params);
        $stringToSign = '';
        foreach ($params as $key => $value) {
            $stringToSign .= $key . '=' . $value . '&';
        }
        $stringToSign = rtrim($stringToSign, '&') . $apiSecret;
        
        $signature = sha1($stringToSign);
        
        // Prepare upload data
        $uploadData = [
            'file' => new CURLFile($file['tmp_name'], $file['type'], $file['name']),
            'public_id' => $publicId,
            'timestamp' => $timestamp,
            'api_key' => $apiKey,
            'signature' => $signature,
            'folder' => $folder
        ];
        
        // Upload to Cloudinary
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $uploadData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_error($ch)) {
            return ['error' => 'Upload failed: ' . curl_error($ch)];
        }
        
        curl_close($ch);
        
        $result = json_decode($response, true);
        
        // Debug logging
        if ($httpCode !== 200) {
            error_log("Cloudinary upload failed - HTTP Code: $httpCode, Response: " . $response);
        }
        
        if ($httpCode === 200 && isset($result['secure_url'])) {
            return [
                'success' => true,
                'url' => $result['secure_url'],
                'public_id' => $result['public_id'],
                'width' => $result['width'],
                'height' => $result['height'],
                'format' => $result['format'],
                'bytes' => $result['bytes']
            ];
        } else {
            $errorMessage = 'Upload failed';
            if (isset($result['error']['message'])) {
                $errorMessage = $result['error']['message'];
            } elseif (isset($result['error'])) {
                $errorMessage = is_array($result['error']) ? json_encode($result['error']) : $result['error'];
            }
            return ['error' => $errorMessage];
        }
        
    } catch (Exception $e) {
        return ['error' => 'Upload error: ' . $e->getMessage()];
    }
}

/**
 * Delete image from Cloudinary
 */
function deleteFromCloudinary($publicId) {
    $cloudName = CLOUDINARY_CLOUD_NAME;
    $apiKey = CLOUDINARY_API_KEY;
    $apiSecret = CLOUDINARY_API_SECRET;
    
    try {
        $timestamp = time();
        
        // Generate signature
        $params = [
            'public_id' => $publicId,
            'timestamp' => $timestamp
        ];
        
        ksort($params);
        $stringToSign = '';
        foreach ($params as $key => $value) {
            $stringToSign .= $key . '=' . $value . '&';
        }
        $stringToSign = rtrim($stringToSign, '&') . $apiSecret;
        
        $signature = sha1($stringToSign);
        
        // Prepare delete data
        $deleteData = [
            'public_id' => $publicId,
            'timestamp' => $timestamp,
            'api_key' => $apiKey,
            'signature' => $signature
        ];
        
        // Delete from Cloudinary
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.cloudinary.com/v1_1/{$cloudName}/image/destroy");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $deleteData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        $result = json_decode($response, true);
        
        if ($httpCode === 200 && $result['result'] === 'ok') {
            return ['success' => true];
        } else {
            return ['error' => 'Delete failed'];
        }
        
    } catch (Exception $e) {
        return ['error' => 'Delete error: ' . $e->getMessage()];
    }
}

/**
 * Get optimized image URL with transformations
 */
function getOptimizedImageUrl($url, $width = null, $height = null, $quality = 'auto') {
    if (empty($url)) return '';
    
    // Check if it's a Cloudinary URL
    if (strpos($url, 'cloudinary.com') === false) {
        return $url;
    }
    
    $transformations = [];
    
    if ($width) {
        $transformations[] = "w_{$width}";
    }
    
    if ($height) {
        $transformations[] = "h_{$height}";
    }
    
    if ($quality) {
        $transformations[] = "q_{$quality}";
    }
    
    // Add default optimizations
    $transformations[] = "f_auto";
    $transformations[] = "c_fill";
    $transformations[] = "g_auto";
    
    if (!empty($transformations)) {
        $transformString = implode(',', $transformations);
        return str_replace('/upload/', "/upload/{$transformString}/", $url);
    }
    
    return $url;
}

/**
 * Generate responsive image URLs
 */
function getResponsiveImageUrls($url) {
    if (empty($url)) return [];
    
    return [
        'thumbnail' => getOptimizedImageUrl($url, 150, 150),
        'small' => getOptimizedImageUrl($url, 300, 200),
        'medium' => getOptimizedImageUrl($url, 600, 400),
        'large' => getOptimizedImageUrl($url, 1200, 800),
        'hero' => getOptimizedImageUrl($url, 1600, 900)
    ];
}

/**
 * Validate image file
 */
function validateImageFile($file) {
    $errors = [];
    
    // Check if file was uploaded
    if (!isset($file['tmp_name']) || !file_exists($file['tmp_name'])) {
        $errors[] = 'No file uploaded';
        return $errors;
    }
    
    // Check file size
    if ($file['size'] > 5 * 1024 * 1024) {
        $errors[] = 'File too large. Maximum size is 5MB';
    }
    
    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        $errors[] = 'Invalid file type. Only JPEG, PNG, GIF, and WebP are allowed';
    }
    
    // Check image dimensions
    $imageInfo = getimagesize($file['tmp_name']);
    if ($imageInfo === false) {
        $errors[] = 'Invalid image file';
    } else {
        $width = $imageInfo[0];
        $height = $imageInfo[1];
        
        if ($width < 300 || $height < 200) {
            $errors[] = 'Image too small. Minimum size is 300x200 pixels';
        }
        
        if ($width > 5000 || $height > 5000) {
            $errors[] = 'Image too large. Maximum size is 5000x5000 pixels';
        }
    }
    
    return $errors;
}

/**
 * Generate image alt text based on filename and context
 */
function generateImageAltText($filename, $context = '') {
    $filename = pathinfo($filename, PATHINFO_FILENAME);
    $filename = str_replace(['-', '_'], ' ', $filename);
    $filename = ucwords($filename);
    
    if ($context) {
        return $context . ' - ' . $filename;
    }
    
    return $filename;
}
?> 