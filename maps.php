<?php
// Enable error reporting
include 'includes/header_unified.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set the base path for the gallery
$mapsDir = __DIR__ . '/maps';

// Check if the maps directory exists
if (!is_dir($mapsDir)) {
    die('Maps directory not found');
}

// Get all image files from the maps directory
$files = scandir($mapsDir);
$imageFiles = [];

foreach ($files as $file) {
    if ($file === '.' || $file === '..' || is_dir($mapsDir . '/' . $file)) {
        continue;
    }
    
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (in_array($ext, ['png', 'jpg', 'jpeg', 'gif'])) {
        $imageFiles[] = $file;
    }
}

// Sort files naturally (so 2 comes after 1, not 10)
natsort($imageFiles);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Might and Magic III - Maps</title>
    <meta charset="utf-8">
    <style>
        body { 
            background-color: #1e1e1e; 
            color: #fff; 
            font-family: Arial, sans-serif; 
            padding: 20px;
            margin: 0;
        }
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
        }
        h1 { 
            color: #f0c14b; 
            text-align: center; 
            margin-bottom: 20px;
        }
        .map-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); 
            gap: 20px; 
            padding: 20px; 
        }
        .map-item { 
            text-align: center; 
            background: #2a2a2a;
            padding: 10px;
            border-radius: 5px;
            transition: transform 0.2s;
        }
        .map-item:hover {
            transform: translateY(-5px);
        }
        .map-item img { 
            max-width: 100%; 
            height: auto;
            border: 1px solid #444; 
            margin-bottom: 10px;
            border-radius: 3px;
        }
        .map-item a { 
            color: #f0c14b; 
            text-decoration: none; 
            font-weight: bold;
            display: block;
        }
        .map-item a:hover { 
            text-decoration: underline; 
        }
        .no-maps { 
            color: #fff; 
            text-align: center; 
            padding: 40px; 
            font-style: italic;
            grid-column: 1 / -1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Might and Magic III - Maps</h1>
        <div class="map-grid">
            <?php if (empty($imageFiles)): ?>
                <div class="no-maps">No map files found in the maps directory.</div>
            <?php else: ?>
                <?php foreach ($imageFiles as $file): ?>
                    <div class="map-item">
                        <a href="maps/<?php echo htmlspecialchars($file); ?>" target="_blank">
                            <img src="maps/<?php echo htmlspecialchars($file); ?>" 
                                 alt="<?php echo htmlspecialchars($file); ?>">
                            <div><?php echo htmlspecialchars($file); ?></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
