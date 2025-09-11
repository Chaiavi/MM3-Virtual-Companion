<?php
// api/notes_api.php
require_once 'auth.php';

// Require authentication
$auth = $mm3Auth->requireAuth();
$userId = $auth['user_id'];

header('Content-Type: application/json');

// Get action from query parameter
$action = $_GET['action'] ?? '';

try {
    $db = new PDO('sqlite:' . __DIR__ . '/../database/mm3_vcompanion.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    switch ($action) {
        case 'load':
            // Get user's notes
            $stmt = $db->prepare("SELECT content FROM notes WHERE user_id = ?");
            $stmt->execute([$userId]);
            $note = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true, 
                'data' => ['content' => $note ? $note['content'] : '']
            ]);
            break;
            
        case 'save':
            // Save notes
            $input = json_decode(file_get_contents('php://input'), true);
            $content = $input['content'] ?? '';
            
            // Use REPLACE to insert or update
            $stmt = $db->prepare("
                INSERT OR REPLACE INTO notes (user_id, content, updated_at) 
                VALUES (?, ?, CURRENT_TIMESTAMP)
            ");
            $stmt->execute([$userId, $content]);
            
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