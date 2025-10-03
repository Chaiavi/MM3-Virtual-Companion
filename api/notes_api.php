<?php
// api/notes_api.php
require_once 'auth.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log function (disabled)

// Require authentication
$auth = $mm3Auth->requireAuth();
$userId = $auth['user_id'];

// Logging disabled

header('Content-Type: application/json');

// Get action from query parameter
$action = $_GET['action'] ?? '';

try {
    $dbPath = __DIR__ . '/../database/mm3_vcompanion.db';
    // Logging disabled
    
    // Check if database file exists and is writable
    if (!file_exists($dbPath)) {
        // Logging disabled
        touch($dbPath);
    }
    
    if (!is_writable($dbPath)) {
        // Logging disabled
    }
    
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Ensure the notes table exists with a UNIQUE constraint on user_id
    $db->exec("CREATE TABLE IF NOT EXISTS notes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id TEXT NOT NULL UNIQUE,
        content TEXT DEFAULT '',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Logging disabled
    
    // Check if the table was created
    $tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='notes'")->fetchAll();
    
    switch ($action) {
        case 'load':
            // Get user's notes
            // Loading notes
            $stmt = $db->prepare("SELECT id, content, created_at, updated_at FROM notes WHERE user_id = ?");
            $stmt->execute([$userId]);
            $note = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Retrieved note from database
            
            $response = [
                'success' => true, 
                'data' => [
                    'content' => $note ? $note['content'] : '',
                    'id' => $note ? $note['id'] : null,
                    'created_at' => $note ? $note['created_at'] : null,
                    'updated_at' => $note ? $note['updated_at'] : null
                ],
                'user_id' => $userId
            ];
            
            // Sending response
            echo json_encode($response);
            break;
            
        case 'save':
            // Save notes
            $input = json_decode(file_get_contents('php://input'), true);
            $content = $input['content'] ?? '';
            
            // Saving note
            
            // Use INSERT OR REPLACE to handle both insert and update in one operation
            $stmt = $db->prepare("INSERT OR REPLACE INTO notes (user_id, content, updated_at) VALUES (?, ?, datetime('now'))");
            $result = $stmt->execute([$userId, $content]);
            
            if ($result === false) {
                $error = $stmt->errorInfo();
                throw new Exception("Failed to save note: " . ($error[2] ?? 'Unknown error'));
            }
            
            echo json_encode(['success' => true, 'data' => null]);
            break;
            
        default:
            echo json_encode(['success' => false, 'error' => 'Invalid action']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>