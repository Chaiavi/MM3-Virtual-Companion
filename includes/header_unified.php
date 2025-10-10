<?php
// Ensure we have authentication info if not already set
if (!isset($username) || empty($username)) {
    require_once __DIR__ . '/../api/auth.php';
    $auth = $mm3Auth->checkAuth();
    if ($auth['logged_in']) {
        $username = $auth['username'];
        $userId = $auth['user_id'];
    } else {
        $username = '';
        $userId = null;
    }
}

if (!isset($page_title)) {
    $page_title = 'Might and Magic III - Virtual Companion';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="<?php echo rtrim(str_replace('\\', '/', dirname($_SERVER['PHP_SELF'])), '/') ?>/assets/css/minimal.css?ver=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF']) ?>" />
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
            padding: 20px 20px 15px;
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
        
        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        
        /* Hamburger Menu Button - Hidden on desktop */
        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.8em;
            cursor: pointer;
            padding: 15px 20px;
            z-index: 1001;
        }
        
        .nav-menu {
            display: flex;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
            flex: 1;
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-link {
            display: block;
            padding: 18px 20px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9em;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            text-transform: uppercase;
            white-space: nowrap;
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
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 15px;
            margin-left: auto;
        }
        
        .username-display {
            color: #e94560;
            font-weight: 600;
            font-size: 0.9em;
            white-space: nowrap;
        }
        
        .username-display::before {
            content: '👤 ';
            margin-right: 3px;
        }
        
        .logout-btn {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85em;
            transition: all 0.3s ease;
            padding: 6px 12px;
            white-space: nowrap;
            background: rgba(220, 53, 69, 0.2);
            border-radius: 4px;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        .logout-btn:hover {
            color: #fff;
            background: rgba(220, 53, 69, 0.5);
            border-color: rgba(220, 53, 69, 0.6);
        }
        
        /* Content Area */
        .app-content {
            max-width: 1400px;
            margin: 20px auto;
            padding: 0 20px;
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .nav-link {
                padding: 18px 15px;
                font-size: 0.85em;
            }
        }
        
        @media (max-width: 768px) {
            .app-title {
                font-size: 1.5em;
                letter-spacing: 1px;
            }
            
            .app-subtitle {
                font-size: 0.85em;
            }
            
            .header-title-section {
                padding: 15px 15px 12px;
            }
            
            /* Show hamburger button */
            .hamburger-btn {
                display: block;
            }
            
            /* Mobile menu wrapper */
            .nav-container {
                flex-wrap: wrap;
            }
            
            /* Hide menu by default on mobile */
            .nav-menu {
                display: none;
                flex-direction: column;
                width: 100%;
                order: 3;
                background: linear-gradient(135deg, #0f3460 0%, #1a1a2e 100%);
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            /* Show menu when active */
            .nav-menu.active {
                display: flex;
            }
            
            .nav-item {
                width: 100%;
            }
            
            .nav-link {
                width: 100%;
                text-align: left;
                padding: 15px 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                border-left: 3px solid transparent;
            }
            
            .nav-link.active {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                border-left-color: #e94560;
            }
            
            /* User section on mobile */
            .user-section {
                width: auto;
                padding: 12px 15px;
                margin: 0;
                gap: 10px;
                order: 2;
            }
            
            .username-display {
                font-size: 0.85em;
            }
            
            .logout-btn {
                padding: 8px 12px;
                font-size: 0.8em;
            }
        }
        
        @media (max-width: 480px) {
            .app-title {
                font-size: 1.3em;
            }
            
            .app-subtitle {
                font-size: 0.8em;
            }
            
            .username-display::before {
                content: '';
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <header class="app-header">
        <div class="header-title-section">
            <h1 class="app-title">Might and Magic III - Virtual Companion</h1>
            <p class="app-subtitle">Your ultimate companion for the world of Might and Magic III</p>
        </div>
        <nav class="header-navigation">
            <div class="nav-container">
                <button class="hamburger-btn" onclick="toggleMobileMenu()">☰</button>
                
                <ul class="nav-menu" id="navMenu">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="itemsCalculator.php">Items Calculator</a></li>
                    <li class="nav-item"><a class="nav-link" href="guide.php">Guide & Tips</a></li>
                    <li class="nav-item"><a class="nav-link" href="keyboard.php">Keyboard Shortcuts</a></li>
                    <li class="nav-item"><a class="nav-link" href="notes.php">Notes</a></li>
                    <li class="nav-item"><a class="nav-link" href="maps.php">Maps</a></li>
                    <li class="nav-item"><a class="nav-link" href="tracker.php">Progress Tracker</a></li>
                </ul>
                
                <?php if (!empty($username)): ?>
                <div class="user-section">
                    <span class="username-display"><?php echo htmlspecialchars($username); ?></span>
                    <a class="logout-btn" href="api/auth.php?action=logout">Logout</a>
                </div>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main class="app-content">
    
    <script>
        // Toggle mobile menu
        function toggleMobileMenu() {
            const navMenu = document.getElementById('navMenu');
            const hamburgerBtn = document.querySelector('.hamburger-btn');
            
            navMenu.classList.toggle('active');
            hamburgerBtn.textContent = navMenu.classList.contains('active') ? '✕' : '☰';
        }
        
        // Close menu when clicking a link on mobile
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    const navMenu = document.getElementById('navMenu');
                    const hamburgerBtn = document.querySelector('.hamburger-btn');
                    navMenu.classList.remove('active');
                    hamburgerBtn.textContent = '☰';
                }
            });
        });
        
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