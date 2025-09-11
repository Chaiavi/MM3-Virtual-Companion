<?php
class MM3Database {
    private $db;
    private $dbPath;
    
    public function __construct() {
        $this->dbPath = __DIR__ . '/../database/mm3_progress.db';
        $this->initDatabase();
    }
    
    private function initDatabase() {
        try {
            // Create database directory if it doesn't exist
            $dbDir = dirname($this->dbPath);
            if (!is_dir($dbDir)) {
                mkdir($dbDir, 0755, true);
            }
            
            // Connect to SQLite database
            $this->db = new PDO('sqlite:' . $this->dbPath);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Read and execute schema
            $schemaPath = __DIR__ . '/../database/init.sql';
            if (file_exists($schemaPath)) {
                $schema = file_get_contents($schemaPath);
                $this->db->exec($schema);
            }
            
        } catch (Exception $e) {
            error_log("Database initialization failed: " . $e->getMessage());
            throw $e;
        }
    }
    
    public function getUserId() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['mm3_user_id'])) {
            // Return null if no user is logged in
            return null;
        }
        
        return $_SESSION['mm3_user_id'];
    }
    
    // Legacy method - now redirects to global auth
    public function loginUser($username) {
        // This method is deprecated - use global MM3Auth instead
        return ['success' => false, 'message' => 'Please use the main login page'];
    }
    
    public function logoutUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['mm3_user_id']);
        unset($_SESSION['mm3_username']);
        return ['success' => true, 'message' => 'Logged out successfully'];
    }
    
    public function getCurrentUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['mm3_user_id']) && isset($_SESSION['mm3_username'])) {
            return [
                'user_id' => $_SESSION['mm3_user_id'],
                'username' => $_SESSION['mm3_username'],
                'logged_in' => true
            ];
        }
        
        return ['logged_in' => false];
    }
    
    private function generateUserId() {
        return 'user_' . uniqid() . '_' . time();
    }
    
    public function saveProgress($userId, $progress) {
        try {
            $this->db->beginTransaction();
            
            // Clear existing progress for user
            $stmt = $this->db->prepare("DELETE FROM progress WHERE user_id = ?");
            $stmt->execute([$userId]);
            
            // Insert new progress
            $stmt = $this->db->prepare("
                INSERT INTO progress (user_id, area_key, location_id, completed) 
                VALUES (?, ?, ?, ?)
            ");
            
            foreach ($progress as $areaKey => $locations) {
                foreach ($locations as $locationId => $completed) {
                    if ($completed) {
                        $stmt->execute([$userId, $areaKey, $locationId, 1]);
                    }
                }
            }
            
            // Update user last active
            $this->updateUserActivity($userId);
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Failed to save progress: " . $e->getMessage());
            return false;
        }
    }
    
    public function loadProgress($userId) {
        try {
            $stmt = $this->db->prepare("
                SELECT area_key, location_id, completed 
                FROM progress 
                WHERE user_id = ? AND completed = 1
            ");
            $stmt->execute([$userId]);
            
            $progress = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (!isset($progress[$row['area_key']])) {
                    $progress[$row['area_key']] = [];
                }
                $progress[$row['area_key']][$row['location_id']] = true;
            }
            
            $this->updateUserActivity($userId);
            return $progress;
            
        } catch (Exception $e) {
            error_log("Failed to load progress: " . $e->getMessage());
            return [];
        }
    }
    
    public function saveSettings($userId, $settings) {
        try {
            $this->db->beginTransaction();
            
            $stmt = $this->db->prepare("
                INSERT OR REPLACE INTO settings (user_id, setting_key, setting_value) 
                VALUES (?, ?, ?)
            ");
            
            foreach ($settings as $key => $value) {
                $stmt->execute([$userId, $key, json_encode($value)]);
            }
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Failed to save settings: " . $e->getMessage());
            return false;
        }
    }
    
    public function loadSettings($userId) {
        try {
            $stmt = $this->db->prepare("
                SELECT setting_key, setting_value 
                FROM settings 
                WHERE user_id = ?
            ");
            $stmt->execute([$userId]);
            
            $settings = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $settings[$row['setting_key']] = json_decode($row['setting_value'], true);
            }
            
            return $settings;
            
        } catch (Exception $e) {
            error_log("Failed to load settings: " . $e->getMessage());
            return [];
        }
    }
    
    private function updateUserActivity($userId) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET last_active = CURRENT_TIMESTAMP WHERE user_id = ?");
            $stmt->execute([$userId]);
        } catch (Exception $e) {
            error_log("Failed to update user activity: " . $e->getMessage());
        }
    }
    
    public function getStats() {
        try {
            $stmt = $this->db->query("
                SELECT 
                    COUNT(DISTINCT user_id) as total_users,
                    COUNT(*) as total_progress_entries,
                    SUM(completed) as total_completed
                FROM progress
            ");
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (Exception $e) {
            error_log("Failed to get stats: " . $e->getMessage());
            return null;
        }
    }
}
?>
