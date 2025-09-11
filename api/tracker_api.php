<?php
require_once 'auth.php';
require_once 'database.php';

header('Content-Type: application/json');

// Handle CORS if needed
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    exit(0);
}

try {
    // Use the same authentication system as the main tracker page
    $auth = $mm3Auth->requireAuth();
    $userId = $auth['user_id'];
    
    $database = new MM3Database();
    
    $action = $_GET['action'] ?? '';
    
    switch ($action) {
        case 'progress':
            $progress = $database->loadProgress($userId);
            echo json_encode(['success' => true, 'data' => $progress]);
            break;
            
        case 'save_progress':
            $input = json_decode(file_get_contents('php://input'), true);
            error_log('API received input: ' . print_r($input, true));
            
            if (!isset($input['progress'])) {
                throw new Exception('Progress data is required');
            }
            
            error_log('Progress data to save: ' . print_r($input['progress'], true));
            $success = $database->saveProgress($userId, $input['progress']);
            if ($success) {
                echo json_encode(['success' => true, 'message' => 'Progress saved successfully']);
            } else {
                throw new Exception('Failed to save progress');
            }
            break;
            
        case 'settings':
            $settings = $database->loadSettings($userId);
            echo json_encode(['success' => true, 'data' => $settings]);
            break;
            
        case 'save_settings':
            $input = json_decode(file_get_contents('php://input'), true);
            if (!isset($input['settings'])) {
                throw new Exception('Settings data is required');
            }
            
            $success = $database->saveSettings($userId, $input['settings']);
            if ($success) {
                echo json_encode(['success' => true, 'message' => 'Settings saved successfully']);
            } else {
                throw new Exception('Failed to save settings');
            }
            break;
            
        case 'stats':
            $stats = $database->getStats();
            echo json_encode(['success' => true, 'data' => $stats]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
