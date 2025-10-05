<?php
if (!isset($auth)) {
    require_once 'api/auth.php';
    $auth = $mm3Auth->requireAuth();
    $username = $auth['username'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>Might and Magic III - Virtual Companion</title>
    <link rel="stylesheet" href="assets/css/minimal.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
        }
        
        /* Main Header Container */
        .app-header {
            background: linear-gradient(135deg, #0f3460 0%, #16213e 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 3px solid #e94560;
        }
        
        /* Title Section */
        .header-title-section {
            text-align: center;
            padding: 25px 20px 20px;
            background: linear-gradient(135deg, #16213e 0%, #0f3460 100%);
        }
        
        .app-title {
            font-size: 2.5em;
            font-weight: 800;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(233, 69, 96, 0.5);
            letter-spacing: 2px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        
        .app-subtitle {
            font-size: 1.1em;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 300;
            letter-spacing: 1px;
        }
        
        /* Navigation Menu */
        .header-navigation {
            background: linear-gradient(135deg, #0f3460 0%, #1a1a2e 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .nav-menu {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-link {
            display: block;
            padding: 18px 30px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95em;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            text-transform: uppercase;
        }
        
        .nav-link:hover {
            color: #e94560;
            background: rgba(233, 69, 96, 0.1);
            border-bottom-color: #e94560;
        }
        
        .nav-link.active {
            color: #e94560;
            background: rgba(233, 69, 96, 0.15);
            border-bottom-color: #e94560;
            font-weight: 600;
        }
        
        /* User Info Section */
        .user-section {
            margin-left: auto;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 25px;
            margin-right: 15px;
        }
        
        .username-display {
            color: #fff;
            font-weight: 500;
            margin-right: 15px;
            font-size: 0.9em;
        }
        
        .logout-btn {
            background: linear-gradient(135deg, #e94560, #c72d47);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.85em;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .logout-btn:hover {
            background: linear-gradient(135deg, #c72d47, #a02239);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(233, 69, 96, 0.4);
        }
        
        /* Content Area */
        .app-content {
            max-width: 1400px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .app-title {
                font-size: 1.8em;
                letter-spacing: 1px;
            }
            
            .app-subtitle {
                font-size: 0.95em;
            }
            
            .nav-menu {
                flex-direction: column;
                width: 100%;
            }
            
            .nav-item {
                width: 100%;
            }
            
            .nav-link {
                width: 100%;
                text-align: center;
                padding: 15px 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                border-left: 3px solid transparent;
            }
            
            .nav-link:hover,
            .nav-link.active {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                border-left-color: #e94560;
            }
            
            .user-section {
                width: 100%;
                margin: 10px;
                justify-content: center;
                border-radius: 0;
                padding: 15px;
            }
            
            .header-title-section {
                padding: 20px 15px 15px;
            }
        }
        
        @media (min-width: 769px) and (max-width: 1024px) {
            .app-title {
                font-size: 2em;
            }
            
            .nav-link {
                padding: 15px 20px;
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <header class="app-header">
        <!-- Title Section -->
        <div class="header-title-section">
            <h1 class="app-title">Might and Magic III</h1>
            <p class="app-subtitle">Isles of Terra - Virtual Companion</p>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="header-navigation">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php" class="nav-link" data-page="items">Item Calculator</a>
                </li>
                <li class="nav-item">
                    <a href="maps.php" class="nav-link" data-page="maps">Maps</a>
                </li>
                <li class="nav-item">
                    <a href="notes.php" class="nav-link" data-page="notes">Notes</a>
                </li>
                <li class="nav-item">
                    <a href="keyboard.php" class="nav-link" data-page="keyboard">Keyboard</a>
                </li>
                <li class="nav-item">
                    <a href="tracker.php" class="nav-link" data-page="tracker">Progress Tracker</a>
                </li>
                <li class="user-section">
                    <span class="username-display"><?php echo htmlspecialchars($username); ?></span>
                    <a href="api/auth.php?action=logout" class="logout-btn">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    
    <script>
        // Highlight active page
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop() || 'index.php';
            const links = document.querySelectorAll('.nav-link');
            
            links.forEach(link => {
                const href = link.getAttribute('href');
                if (href === currentPage || (currentPage === 'index.php' && href === 'index.php')) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>