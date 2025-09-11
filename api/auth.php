<?php
// api/auth.php - Complete Authentication System
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class MM3Auth {
    private $db;
    private $dbPath;
    
    public function __construct() {
        $this->dbPath = __DIR__ . '/../database/mm3_vcompanion.db';
        $this->initDatabase();
    }
    
    private function initDatabase() {
        try {
            $this->db = new PDO('sqlite:' . $this->dbPath);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Create tables if they don't exist
            $this->createTables();
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    private function createTables() {
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT UNIQUE NOT NULL,
                password_hash TEXT NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                last_activity DATETIME DEFAULT CURRENT_TIMESTAMP
            );
            
            CREATE TABLE IF NOT EXISTS progress (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NOT NULL,
                area_key TEXT NOT NULL,
                location_id TEXT NOT NULL,
                completed BOOLEAN DEFAULT 0,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id),
                UNIQUE(user_id, area_key, location_id)
            );
            
            CREATE TABLE IF NOT EXISTS settings (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NOT NULL,
                setting_key TEXT NOT NULL,
                setting_value TEXT,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id),
                UNIQUE(user_id, setting_key)
            );
            
            CREATE TABLE IF NOT EXISTS notes (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER NOT NULL,
                content TEXT DEFAULT '',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id),
                UNIQUE(user_id)
            );
        ";
        
        $this->db->exec($sql);
    }
    
    public function register($username, $password) {
        // Validate input
        if (strlen($username) < 2) {
            return ['success' => false, 'message' => 'Username must be at least 2 characters'];
        }
        
        if (strlen($password) < 6) {
            return ['success' => false, 'message' => 'Password must be at least 6 characters'];
        }
        
        // Check if username exists
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->fetch()) {
            return ['success' => false, 'message' => 'Username already exists'];
        }
        
        // Create user
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
        
        try {
            $stmt->execute([$username, $passwordHash]);
            return ['success' => true, 'message' => 'Registration successful'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Registration failed'];
        }
    }
    
    public function login($username, $password) {
        // Get user
        $stmt = $this->db->prepare("SELECT id, password_hash FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || !password_verify($password, $user['password_hash'])) {
            return ['success' => false, 'message' => 'Invalid username or password'];
        }
        
        // Update last activity
        $stmt = $this->db->prepare("UPDATE users SET last_activity = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$user['id']]);
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;
        
        return ['success' => true, 'message' => 'Login successful'];
    }
    
    public function logout() {
        session_destroy();
        $_SESSION = [];
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
    
    public function requireAuth() {
        if (!$this->isLoggedIn()) {
            // Use relative path for redirect
            $currentPath = $_SERVER['REQUEST_URI'];
            $basePath = dirname($_SERVER['SCRIPT_NAME']);
            if ($basePath !== '/' && $basePath !== '\\') {
                $loginUrl = $basePath . '/login.php?redirect=' . urlencode($currentPath);
            } else {
                $loginUrl = '/login.php?redirect=' . urlencode($currentPath);
            }
            header('Location: ' . $loginUrl);
            exit;
        }
        
        return [
            'user_id' => $_SESSION['user_id'],
            'username' => $_SESSION['username']
        ];
    }
    
    public function checkAuth() {
        if ($this->isLoggedIn()) {
            return [
                'logged_in' => true,
                'user_id' => $_SESSION['user_id'],
                'username' => $_SESSION['username']
            ];
        }
        
        return ['logged_in' => false];
    }
    
    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }
}

// Create global instance
$mm3Auth = new MM3Auth();
?>