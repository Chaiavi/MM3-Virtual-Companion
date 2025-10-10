<?php
require_once 'api/auth.php';

$auth = $mm3Auth->requireAuth();
$userId = $auth['user_id'];
$username = $auth['username'];
$page_title = 'MM3 Riddles & Answers';

include 'includes/header_unified.php';
?>

<script>
function toggleAreaSection(header) {
    const content = header.nextElementSibling;
    const isOpening = !content.classList.contains('active');
    
    content.classList.toggle('active');
    header.classList.toggle('active');
    
    // If opening the section, reveal all answers in it
    if (isOpening) {
        const answers = content.querySelectorAll('.answer-hidden');
        answers.forEach(span => {
            span.classList.remove('answer-hidden');
            span.classList.add('answer-revealed');
        });
    }
}
</script>

<style>
/* Riddles-specific styles */
.riddles-wrapper {
    width: 100%;
    margin: 0 auto;
    padding: 20px;
    max-width: 1200px;
}

.riddles-header {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: #fff;
    padding: 30px 20px;
    text-align: center;
    border-radius: 4px;
    margin: 0 auto 20px auto;
    border: 1px solid #4a5a6b;
    width: 100%;
}

.riddles-header h1 {
    font-size: 2.5em;
    margin: 0 0 15px 0;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    color: #fff;
}

.riddles-header p {
    font-size: 1.1em;
    opacity: 0.9;
    margin: 0;
}

/* Area Sections */
.area-section {
    margin-bottom: 20px;
    border-radius: 8px;
    overflow: hidden;
    background: white;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}

.area-header {
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    color: white;
    padding: 15px 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    justify-content: space-between;
    align-items: center;
    user-select: none;
    position: relative;
}

.area-header::after {
    content: '▼';
    font-size: 0.8em;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-left: 10px;
}

.area-header.active::after {
    transform: rotate(180deg);
}

.area-header:hover {
    background: linear-gradient(135deg, #8e44ad 0%, #7d3c98 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.area-title {
    font-size: 1.2em;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 10px;
}

.area-count {
    background: rgba(255,255,255,0.2);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.85em;
}

.area-content {
    padding: 0;
    max-height: 0;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.area-content.active {
    padding: 20px;
    max-height: 5000px;
}

/* Riddle Table */
.riddles-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

.riddles-table thead {
    background: #34495e;
    color: white;
}

.riddles-table th {
    padding: 12px;
    text-align: left;
    font-weight: bold;
    border-bottom: 2px solid #2c3e50;
}

.riddles-table td {
    padding: 12px;
    border-bottom: 1px solid #ecf0f1;
    color: #2c3e50;
}

.riddles-table tbody tr {
    transition: background 0.2s ease;
}

.riddles-table tbody tr:hover {
    background: #f8f9fa;
}

/* Answer Cell - Spoiler Effect */
.answer-cell {
    position: relative;
    user-select: none;
}

.answer-hidden {
    background: #2c3e50;
    color: #2c3e50;
    padding: 4px 8px;
    border-radius: 4px;
    display: inline-block;
    min-width: 100px;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
}

.answer-hidden::after {
    content: 'Click section to reveal';
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255,255,255,0.5);
    font-size: 0.75em;
    pointer-events: none;
}

.answer-revealed {
    background: #d4edda;
    color: #155724;
    padding: 4px 8px;
    border-radius: 4px;
    display: inline-block;
    font-weight: bold;
    animation: revealPulse 0.5s ease;
}

@keyframes revealPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

/* Location name styling */
.location-name {
    font-weight: 600;
    color: #2c3e50;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .riddles-header h1 {
        font-size: 1.8em;
    }
    
    .riddles-table {
        font-size: 0.9em;
    }
    
    .riddles-table th,
    .riddles-table td {
        padding: 8px;
    }
    
    .control-btn {
        padding: 10px 18px;
        font-size: 0.9em;
    }
}

/* Warning box */
.warning-box {
    background: #fff3cd;
    border-left: 4px solid #ffc107;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    color: #856404;
}

.warning-box strong {
    color: #856404;
}
</style>

<div class="riddles-wrapper">
    <div class="riddles-header">
        <h1>🔮 Riddles & Answers</h1>
        <p>Complete guide to all riddles and puzzles in Might and Magic III</p>
    </div>
    
    <div class="warning-box">
        <strong>⚠️ Spoiler Warning:</strong> Click on any area header to expand and reveal the riddle answers for that section.
    </div>
    
    <!-- A1 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🌟 A1 - Starting Area <span class="area-count">1 riddle</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Fountain Head Cavern</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">RATS</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- A2 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🖥️ A2 - Coastal Area <span class="area-count">3 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Castle Whiteshield - Cavern Entrance</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">JOABARY</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Castle Whiteshield - Magic Chests</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">SMELLO</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Forward Storage Sector</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">YOUTH</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- A3 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🏝️ A3 - Island Area <span class="area-count">3 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Halls of Insanity - Eyes of Eternity (South)</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">BLINK</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Halls of Insanity - Well of Tears (East)</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">EYES</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Halls of Insanity - Blink of Destruction (West)</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">TEARS</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- B1 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">⚔️ B1 - Central Northern Area <span class="area-count">1 riddle</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Slithercult Stronghold</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">EPSILON</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- B3 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">👹 B3 - Land of Gargoyles <span class="area-count">5 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Cathedral of Carnage - Key Puzzle</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">NWNES</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Cathedral of Carnage - Lock Puzzle</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">WEEDS</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Cathedral of Carnage - Force Field</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">JVC</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Graveyard - "The more of it, the less you see"</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">DARKNESS</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Graveyard - "Too much for one, enough for two, nothing for three"</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">SECRET</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- B4 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🏘️ B4 - Wildabar Region <span class="area-count">3 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Arachnoid Cavern - Lord Luck Puzzle</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">20301</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Castle Bloodreign - Cavern Entrance</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">OGRE</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Castle Bloodreign - Magic Chests</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">NORTIC</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- C2 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🖥️ C2 - Central Control Area <span class="area-count">1 riddle</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Central Control Sector</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">CREATORS</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- C4 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🌫️ C4 - Isles of Illusion (North) <span class="area-count">2 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Castle Greywind - Puzzle</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">CIRCLE</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Castle Greywind - Thrones</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">Day 50</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- D1 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🧊 D1 - Frozen Isles (South) <span class="area-count">4 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Cursed Cold Cavern - Statue of Silver Hooves</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">TOMORROW</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Cursed Cold Cavern - Statue of Iron Hooves</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">ICICLE</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Cursed Cold Cavern - Statue of Golden Hooves</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">ECHO</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Cursed Cold Cavern - Statue of Copper Hooves</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">CHAIN</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- D3 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🌋 D3 - Fire Isle <span class="area-count">2 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Swamptown - Yad</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">MIRROR</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Swamptown - Yud</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">STAIRS</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- D4 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🌊 D4 - Isles of Illusion (South) <span class="area-count">3 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Castle Blackwind - Cavern Entrance</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">TEN</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Castle Blackwind - Thrones</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">Day 60</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Isles of Illusion - Treasure Chests</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">ONESDAY</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- E1 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">💨 E1 - Air Isle <span class="area-count">2 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Castle Dragontooth - Cavern Entrance</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">20000</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Castle Dragontooth - Magic Chests</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">11</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- F1 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🐲 F1 - Dragon Territory <span class="area-count">2 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Beta Engine Sector - Main Engine Access</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">PRIMARY</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Beta Engine Sector - Return</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">SUBLEVEL</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- F2 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">💀 F2 - Tomb Region <span class="area-count">4 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Main Engine Sector - Beta Sector Access</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">SUBLEVEL</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Main Engine Sector - Knowledge</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">KTOW</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Main Engine Sector - Primary Access</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">PRIMARY</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Main Control Sector - Initialization Sequence</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">645231</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- F3 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">😈 F3 - Hell Maze Area <span class="area-count">1 riddle</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Dark Warrior Keep</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">314</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- F4 Section -->
    <div class="area-section">
        <div class="area-header" onclick="toggleAreaSection(this)">
            <span class="area-title">🚀 F4 - Alpha Engine Region <span class="area-count">2 riddles</span></span>
        </div>
        <div class="area-content">
            <table class="riddles-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="location-name">Alpha Engine Sector - Main Engine Access</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">PRIMARY</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="location-name">Alpha Engine Sector - Return</td>
                        <td class="answer-cell">
                            <span class="answer-hidden">WARP</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function toggleSection(header) {
    const content = header.nextElementSibling;
    content.classList.toggle('active');
    header.classList.toggle('active');
}

function toggleAnswer(cell) {
    const span = cell.querySelector('span');
    if (span.classList.contains('answer-hidden')) {
        span.classList.remove('answer-hidden');
        span.classList.add('answer-revealed');
    } else {
        span.classList.remove('answer-revealed');
        span.classList.add('answer-hidden');
    }
}

function revealAllAnswers() {
    const allAnswers = document.querySelectorAll('.answer-hidden');
    allAnswers.forEach(span => {
        span.classList.remove('answer-hidden');
        span.classList.add('answer-revealed');
    });
}

function hideAllAnswers() {
    const allAnswers = document.querySelectorAll('.answer-revealed');
    allAnswers.forEach(span => {
        span.classList.remove('answer-revealed');
        span.classList.add('answer-hidden');
    });
}

function toggleAllSections() {
    const headers = document.querySelectorAll('.area-header');
    const contents = document.querySelectorAll('.area-content');
    
    // Check if any section is open
    const anyOpen = Array.from(contents).some(content => content.classList.contains('active'));
    
    if (anyOpen) {
        // Close all
        headers.forEach(header => header.classList.remove('active'));
        contents.forEach(content => content.classList.remove('active'));
    } else {
        // Open all
        headers.forEach(header => header.classList.add('active'));
        contents.forEach(content => content.classList.add('active'));
    }
}
</script>

<?php
include 'includes/footer.php';
?>