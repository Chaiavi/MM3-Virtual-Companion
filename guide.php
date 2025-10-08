<?php
require_once 'api/auth.php';

$auth = $mm3Auth->requireAuth();
$userId = $auth['user_id'];
$username = $auth['username'];
$page_title = 'MM3 Guide & Tips';

include 'includes/header_unified.php';
?>

<style>
/* Guide-specific styles */
.guide-wrapper {
    width: 100%;
    margin: 0 auto;
    padding: 20px;
    max-width: 1200px;
}

.guide-header {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: #fff;
    padding: 30px 20px;
    text-align: center;
    border-radius: 4px;
    margin: 0 auto 20px auto;
    border: 1px solid #4a5a6b;
    width: 100%;
}

.guide-header h1 {
    font-size: 2.5em;
    margin: 0 0 15px 0;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    color: #fff;
}

.guide-header p {
    font-size: 1.1em;
    opacity: 0.9;
    margin: 0;
}

/* Section Cards */
.guide-section {
    background: white;
    color: #2c3e50;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}

.section-header {
    display: flex;
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 6px;
    margin-bottom: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    padding: 15px 20px;
    cursor: pointer;
    user-select: none;
    position: relative;
    overflow: hidden;
}

.section-header::after {
    content: '▼';
    font-size: 0.8em;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-left: auto;
    padding-left: 10px;
}

.section-header.active::after {
    transform: rotate(180deg);
}

.section-header:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.section-header.objectives {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
}

.section-header.exploration {
    background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
}

.section-header.spells {
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
}

.section-header.tips {
    background: linear-gradient(135deg, #f39c12 0%, #d68910 100%);
}

.section-header.advanced {
    background: linear-gradient(135deg, #16a085 0%, #138d75 100%);
}

.section-header.story {
    background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
}

.section-header.items {
    background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
}

.section-title {
    font-size: 1.2em;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
    color: #fff;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
    flex: 1;
}

.section-icon {
    font-size: 1.3em;
}

.section-content {
    padding: 0 20px;
    max-height: 0;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(255, 255, 255, 0.05);
    border-radius: 0 0 6px 6px;
    margin: -8px 0 20px 0;
}

.section-content.active {
    padding: 25px 20px;
    max-height: 5000px;
    border-left: 3px solid #3498db;
    background: rgba(255, 255, 255, 0.08);
}

.section-content h3 {
    color: #2c3e50;
    font-size: 1.2em;
    margin: 20px 0 10px 0;
    padding-bottom: 5px;
    border-bottom: 2px solid #3498db;
}

.section-content h3:first-child {
    margin-top: 0;
}

.section-content ul {
    margin: 10px 0;
    padding-left: 25px;
}

.section-content li {
    margin: 8px 0;
    line-height: 1.6;
}

.section-content p {
    margin: 10px 0;
    line-height: 1.7;
}

.section-content ol {
    margin: 10px 0;
    padding-left: 25px;
}

.section-content ol li {
    margin: 10px 0;
    line-height: 1.6;
}

/* Highlight boxes */
.highlight-box {
    background: #ecf0f1;
    border-left: 4px solid #3498db;
    padding: 15px;
    margin: 15px 0;
    border-radius: 4px;
}

.highlight-box.warning {
    background: #fef5e7;
    border-left-color: #f39c12;
}

.highlight-box.danger {
    background: #fadbd8;
    border-left-color: #e74c3c;
}

.highlight-box.success {
    background: #d5f4e6;
    border-left-color: #27ae60;
}

.highlight-box.info {
    background: #e8f4f8;
    border-left-color: #3498db;
}

.highlight-box strong {
    color: #2c3e50;
}

.section-content strong {
    color: #2c3e50;
}

/* Spell grid */
.spell-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 10px;
    margin: 15px 0;
}

.spell-item {
    background: #ecf0f1;
    padding: 10px;
    border-radius: 6px;
    border-left: 3px solid #9b59b6;
    font-weight: 500;
    color: #2c3e50;
}

/* Quick reference table */
.quick-ref-table {
    width: 100%;
    border-collapse: collapse;
    margin: 15px 0;
    background: white;
}

.quick-ref-table th {
    background: #34495e;
    color: white;
    padding: 12px;
    text-align: left;
    font-weight: bold;
}

.quick-ref-table td {
    padding: 10px 12px;
    border-bottom: 1px solid #ecf0f1;
    color: #2c3e50;
}

.quick-ref-table tr:hover {
    background: #f8f9fa;
}

@media (max-width: 768px) {
    .guide-header h1 {
        font-size: 1.8em;
    }
    
    .section-title {
        font-size: 1.1em;
    }
    
    .spell-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
}
</style>

<div class="guide-wrapper">
    <div class="guide-header">
        <h1>📚 Guide & Tips</h1>
        <p>Complete strategy guide for Might and Magic III: Isles of Terra</p>
    </div>
    
    <!-- Main Objectives Section -->
    <div class="guide-section">
        <div class="section-header objectives" onclick="toggleSection(this)">
            <div class="section-title">
                <span class="section-icon">🎯</span>
                Main Objectives
            </div>
        </div>
        <div class="section-content">
            <div class="highlight-box danger">
                <strong>Critical Victory Conditions:</strong> Complete all objectives below to finish the game.
            </div>
            
            <ol>
                <li><strong>Attain the Crusader rank</strong> at the <em>Temple of Moo</em> (located in area A1)</li>
                <li><strong>Deliver 11 Power Orbs</strong> to any one of the three castles to obtain the corresponding key</li>
                <li><strong>Acquire all six Hologram Sequence cards</strong> scattered throughout the world</li>
                <li><strong>Enter and complete</strong> the Main Control Center Pyramid with your keys and cards</li>
            </ol>
        </div>
    </div>

    <!-- World Overview Section -->
    <div class="guide-section">
        <div class="section-header exploration" onclick="toggleSection(this)">
            <div class="section-title">
                <span class="section-icon">🗺️</span>
                World Overview & Exploration
            </div>
        </div>
        <div class="section-content">
            <h3>Primary Location Types</h3>
            <table class="quick-ref-table">
                <tr>
                    <th>Location Type</th>
                    <th>Count</th>
                    <th>Notes</th>
                </tr>
                <tr>
                    <td><strong>Towns</strong></td>
                    <td>5</td>
                    <td>Main hubs for services, training, and quests</td>
                </tr>
                <tr>
                    <td><strong>Castles</strong></td>
                    <td>3</td>
                    <td>Turn in Power Orbs here for keys</td>
                </tr>
                <tr>
                    <td><strong>Pyramids</strong></td>
                    <td>Multiple</td>
                    <td>High-tech dungeons with unique challenges</td>
                </tr>
                <tr>
                    <td><strong>Dungeons</strong></td>
                    <td>Many</td>
                    <td>Various caves, keeps, and underground areas</td>
                </tr>
            </table>

            <h3>Recommended Exploration Order</h3>
            <div class="highlight-box success">
                <strong>Efficient Route:</strong> Follow this progression for optimal difficulty curve
            </div>
            <ol>
                <li>Complete all areas in <strong>A1–A4</strong> (starting regions)</li>
                <li>Proceed to <strong>B1–B4</strong> (intermediate difficulty)</li>
                <li>Continue exploring remaining regions systematically</li>
                <li>Utilize <strong>teleporters and Town Portal</strong> for efficient travel between areas</li>
            </ol>

            <h3>Core Gameplay Loop</h3>
            <ul>
                <li><strong>Exploration:</strong> Discover new areas and hidden secrets</li>
                <li><strong>Tactical Combat:</strong> Strategic party-based encounters</li>
                <li><strong>Equipment Management:</strong> Expect significant time managing inventory and selling items</li>
                <li><strong>Character Progression:</strong> Level up and train at temples</li>
            </ul>
        </div>
    </div>

    <!-- Essential Spells Section -->
    <div class="guide-section">
        <div class="section-header spells" onclick="toggleSection(this)">
            <div class="section-title">
                <span class="section-icon">✨</span>
                Essential Spells
            </div>
        </div>
        <div class="section-content">
            <div class="highlight-box">
                <strong>Priority Spells:</strong> Master these utility and recovery spells for smoother navigation and combat survival
            </div>

            <h3>Movement & Exploration Spells</h3>
            <div class="spell-grid">
                <div class="spell-item">Jump</div>
                <div class="spell-item">Levitate</div>
                <div class="spell-item">Teleport</div>
                <div class="spell-item">Lloyd's Beacon</div>
                <div class="spell-item">Town Portal</div>
                <div class="spell-item">Walk on Water</div>
            </div>

            <h3>Recovery & Utility Spells</h3>
            <div class="spell-grid">
                <div class="spell-item">Cure Disease</div>
                <div class="spell-item">Cure Poison</div>
                <div class="spell-item">Stone to Flesh</div>
                <div class="spell-item">Awaken</div>
                <div class="spell-item">Light</div>
                <div class="spell-item">Create Rope</div>
                <div class="spell-item">Revive</div>
                <div class="spell-item">Dis-Eradicate</div>
            </div>

            <h3>Combat Spells</h3>
            <div class="highlight-box warning">
                <strong>Implosion</strong> is highly effective against Terminators and other tough enemies
            </div>
        </div>
    </div>

    <!-- Items & Equipment Section -->
    <div class="guide-section">
        <div class="section-header items" onclick="toggleSection(this)">
            <div class="section-title">
                <span class="section-icon">⚔️</span>
                Items & Equipment Guide
            </div>
        </div>
        <div class="section-content">
            <h3>Understanding Item Properties</h3>
            
            <div class="highlight-box info">
                <strong>Suffix "OF...":</strong> Can be disregarded – it only means you can use the item to cast that spell
            </div>

            <div class="highlight-box warning">
                <strong>Important:</strong> Item prefixes are not all equal – always check their actual value, as some prefixes provide better bonuses than others
            </div>

            <h3>Best Equipment</h3>
            <div class="highlight-box success">
                <strong>OBSIDIAN Items:</strong> If you find OBSIDIAN items, use them immediately – they are almost always the best equipment available in their category
            </div>

            <h3>Items to Discard</h3>
            <ul>
                <li><strong>Jewelry of Youth and Beauty:</strong> Throw these out – they're not worth keeping</li>
            </ul>

            <h3>Inventory Management Tips</h3>
            <ul>
                <li><strong>Use inactive characters as item holders:</strong> Characters not in your active party make excellent storage for keys, quest items, and equipment you don't need short-term</li>
                <li><strong>Equipment management takes time:</strong> Be prepared to spend significant time organizing, equipping, and selling items throughout your adventure</li>
            </ul>
        </div>
    </div>

    <!-- Pro Tips & Strategies Section -->
    <div class="guide-section">
        <div class="section-header tips" onclick="toggleSection(this)">
            <div class="section-title">
                <span class="section-icon">💡</span>
                Pro Tips & Strategies
            </div>
        </div>
        <div class="section-content">
            <h3>Save Management</h3>
            <div class="highlight-box success">
                <strong>Multi-Save Slots:</strong> Duplicate the save file to create multiple save slots for safety and experimentation
            </div>

            <h3>Money Management</h3>
            <ul>
                <li><strong>Use the bank:</strong> Put spare money in the bank to earn excellent interest over time</li>
            </ul>

            <h3>Quest Optimization</h3>
            <div class="highlight-box warning">
                <strong>Skip timed quests:</strong> Disregard quests that require waiting for a specific day – they're generally not worth the time investment
            </div>

            <h3>Hireling Management</h3>
            <ul>
                <li><strong>Cost scaling:</strong> Hirelings cost more and more as they gain higher levels</li>
                <li><strong>Temporary hirelings:</strong> You can hire them momentarily just to sell their equipment or give them quest items for safekeeping</li>
            </ul>

            <h3>Character Issues</h3>
            <div class="highlight-box info">
                <strong>Aging problem:</strong> If your characters age too much, you can use a hex editor to restore them (advanced users only)
            </div>

            <h3>Game Modifications</h3>
            <div class="highlight-box warning">
                <strong>Ludwig Patch:</strong> There is only one worthy patch for the game (Ludwig), but the price is lots of non-needed fights. Use at your own discretion.
            </div>
        </div>
    </div>

    <!-- Advanced Completionist Section -->
    <div class="guide-section">
        <div class="section-header advanced" onclick="toggleSection(this)">
            <div class="section-title">
                <span class="section-icon">🏆</span>
                Advanced Completionist Guide
            </div>
        </div>
        <div class="section-content">
            <div class="highlight-box info">
                <strong>For a more full experience:</strong> These optional challenges provide a richer gameplay experience
            </div>

            <h3>Optional Challenge Order</h3>
            <ol>
                <li><strong>Return artifacts of Good/Evil/Neutral</strong> before turning in 11 Power Orbs to a castle
                    <ul>
                        <li>Save the Power Orbs in one of your non-active hirelings for safekeeping</li>
                    </ul>
                </li>
                <li><strong>Solve the castle dungeons</strong> before returning the Power Orbs for maximum challenge and rewards</li>
            </ol>

            <p>These optional objectives add depth and challenge to your playthrough while ensuring you experience more of the game's content before reaching the endgame.</p>
        </div>
    </div>

    <!-- Story Background Section -->
    <div class="guide-section">
        <div class="section-header story" onclick="toggleSection(this)">
            <div class="section-title">
                <span class="section-icon">📖</span>
                Story Background
            </div>
        </div>
        <div class="section-content">
            <h3>The Eternal Conflict</h3>
            
            <p><strong>Sheltem & Corak</strong> are two guardians created by the Ancients. Sheltem developed a critical bug in his programming and now attempts to destroy worlds across the galaxy.</p>

            <p>In <em>Might and Magic III: Isles of Terra</em>, you are helping <strong>Corak</strong> defend Terra from Sheltem's destructive plans.</p>

            <div class="highlight-box info">
                <strong>Series Continuity:</strong> In later games of the series, Sheltem will attempt to destroy other worlds, which you will save with Corak's continued assistance. This ongoing conflict forms the backbone of the early Might and Magic saga.
            </div>

            <h3>Your Role</h3>
            <p>As adventurers on the Isles of Terra, your party must gather the necessary power and artifacts to enter the Main Control Center and stop Sheltem's plans once and for all – at least for this world.</p>
        </div>
    </div>

</div>

<script>
function toggleSection(header) {
    const content = header.nextElementSibling;
    content.classList.toggle('active');
    header.classList.toggle('active');
}
</script>

<?php
include 'includes/footer.php';
?>