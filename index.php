<?php
// index.php - Main page with authentication
require_once 'api/auth.php';

// Check if user is logged in
$auth = $mm3Auth->requireAuth();
$isLoggedIn = true;
$username = $auth['username'];
$userId = $auth['user_id'];
$page_title = 'Home - MM3 Virtual Companion';

// Include header
include 'includes/header_unified.php';
?>

<style>
/* Home page specific styles */
.welcome-section {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 40px 30px;
    text-align: center;
    border-radius: 12px;
    margin-bottom: 40px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
}

.welcome-section h1 {
    font-size: 2.8em;
    margin: 0 0 15px 0;
    font-weight: 800;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    letter-spacing: 1px;
}

.welcome-section p {
    font-size: 1.2em;
    opacity: 0.95;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 auto;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin: 40px 0;
}

.feature-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    display: block;
    border: 2px solid transparent;
}

.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    border-color: #3498db;
}

.feature-icon {
    font-size: 3.5em;
    margin-bottom: 15px;
    display: block;
}

.feature-title {
    font-size: 1.5em;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 12px;
}

.feature-description {
    color: #555;
    line-height: 1.6;
    font-size: 1.05em;
}

.info-section {
    background: rgba(52, 152, 219, 0.1);
    border-left: 4px solid #3498db;
    padding: 25px;
    margin: 30px 0;
    border-radius: 8px;
}

.info-section h2 {
    color: #2c3e50;
    font-size: 1.8em;
    margin-bottom: 15px;
    font-weight: 700;
}

.info-section p {
    color: #34495e;
    line-height: 1.7;
    font-size: 1.1em;
}

.info-section ul {
    margin: 15px 0;
    padding-left: 30px;
}

.info-section li {
    color: #34495e;
    line-height: 1.8;
    margin: 10px 0;
    font-size: 1.05em;
}

@media (max-width: 768px) {
    .welcome-section h1 {
        font-size: 2em;
    }
    
    .welcome-section p {
        font-size: 1.05em;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .feature-card {
        padding: 25px;
    }
}
</style>

<div class="welcome-section">
    <h1>⚔️ Welcome to MM3 Virtual Companion</h1>
    <p>
        Your complete toolkit for conquering the Isles of Terra! Track your progress, 
        calculate item stats, take notes, and access comprehensive guides all in one place.
    </p>
</div>

<div class="features-grid">
    <a href="itemsCalculator.php" class="feature-card">
        <span class="feature-icon">⚔️</span>
        <div class="feature-title">Items Calculator</div>
        <div class="feature-description">
            Calculate weapon damage, armor protection, and item stats. Optimize your party's equipment 
            with detailed damage calculations and attribute bonuses.
        </div>
    </a>
    
    <a href="guide.php" class="feature-card">
        <span class="feature-icon">📚</span>
        <div class="feature-title">Guide & Tips</div>
        <div class="feature-description">
            Complete strategy guide covering main objectives, essential spells, exploration tips, 
            and advanced tactics to help you succeed.
        </div>
    </a>
    
    <a href="keyboard.php" class="feature-card">
        <span class="feature-icon">⌨️</span>
        <div class="feature-title">Keyboard Shortcuts</div>
        <div class="feature-description">
            Complete keyboard reference for gameplay. Master shortcuts for combat, movement, 
            party management, and more.
        </div>
    </a>
    
    <a href="notes.php" class="feature-card">
        <span class="feature-icon">📝</span>
        <div class="feature-title">Personal Notes</div>
        <div class="feature-description">
            Keep track of important information, quest details, NPC locations, and strategies. 
            Your notes are automatically saved to your account.
        </div>
    </a>
    
    <a href="maps.php" class="feature-card">
        <span class="feature-icon">🗺️</span>
        <div class="feature-title">Maps Gallery</div>
        <div class="feature-description">
            Browse all area maps for the Isles of Terra. Navigate dungeons, towns, and outdoor 
            areas with detailed map references.
        </div>
    </a>
    
    <a href="tracker.php" class="feature-card">
        <span class="feature-icon">🎯</span>
        <div class="feature-title">Progress Tracker</div>
        <div class="feature-description">
            Track your exploration progress through all 64+ locations. Mark completed areas, 
            dungeons, castles, and view your completion percentage.
        </div>
    </a>
</div>

<div class="info-section">
    <h2>🏰 About Might and Magic III: Isles of Terra</h2>
    <p>
        Might and Magic III is a classic RPG that takes you through a vast world of adventure. 
        This companion app provides all the tools you need to enhance your gaming experience:
    </p>
    <ul>
        <li><strong>Track Progress:</strong> Never lose track of which areas you've completed</li>
        <li><strong>Calculate Stats:</strong> Make informed equipment decisions with the items calculator</li>
        <li><strong>Take Notes:</strong> Keep all your important game information in one place</li>
        <li><strong>Learn Strategies:</strong> Access comprehensive guides and tips</li>
        <li><strong>Quick Reference:</strong> Keyboard shortcuts and maps at your fingertips</li>
    </ul>
</div>

<div class="info-section">
    <h2>🎮 Getting Started</h2>
    <p>
        New to the companion? Here's what you should do first:
    </p>
    <ul>
        <li>Visit the <strong>Progress Tracker</strong> to see all game locations and start marking your progress</li>
        <li>Check out the <strong>Guide & Tips</strong> for essential information about objectives and spells</li>
        <li>Use the <strong>Items Calculator</strong> to optimize your party's equipment</li>
        <li>Save important information in your <strong>Personal Notes</strong></li>
        <li>Reference the <strong>Maps</strong> when exploring new areas</li>
    </ul>
</div>

<?php
// Include footer
include 'includes/footer.php';
?>