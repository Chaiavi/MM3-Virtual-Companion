<?php
require_once 'api/auth.php';

$auth = $mm3Auth->requireAuth();
$userId = $auth['user_id'];
$username = $auth['username'];
$page_title = 'Keyboard Shortcuts - MM3 Virtual Companion';

include 'includes/header_unified.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Might and Magic III - Keyboard Shortcuts Reference">
	<title>Keyboard Shortcuts - MM3 Virtual Companion</title>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
	
	<style>
		/* Reset and base styles */
		body {
			margin: 0;
			padding: 20px 0;
			font-family: 'Open Sans', Helvetica, sans-serif;
			background: #2e3842;
			color: #fff;
			width: 100%;
			line-height: 1.65em;
		}
		
		.keyboard-container {
			width: 100%;
			max-width: 1200px;
			margin: 0 auto;
			background: rgba(46, 56, 66, 0.95);
			border-radius: 8px;
			overflow: hidden;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
		}
		
		.keyboard-header {
			background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
			color: white;
			padding: 30px 20px;
			text-align: center;
			border-bottom: 2px solid #3a4652;
		}
		
		.keyboard-title {
			margin: 0 0 10px 0;
			font-size: 28px;
			font-weight: bold;
			text-shadow: 0 2px 4px rgba(0,0,0,0.3);
		}
		
		.keyboard-description {
			margin: 0;
			opacity: 0.9;
			font-size: 16px;
		}
		
		/* Section headers */
		.section-header {
			background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
			color: white;
			padding: 15px 20px;
			font-size: 18px;
			font-weight: bold;
			border: none;
			margin: 0;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.section-header:hover {
			background: linear-gradient(135deg, #2980b9 0%, #1f5582 100%);
		}
		
		/* Shortcuts grid */
		.shortcuts-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 15px;
			padding: 20px;
			background: transparent;
		}
		
		/* Individual shortcut */
		.shortcut-item {
			display: flex;
			align-items: flex-start;
			gap: 12px;
			padding: 15px;
			background: rgba(255, 255, 255, 0.1);
			backdrop-filter: blur(5px);
			border-radius: 8px;
			border-left: 4px solid #3498db;
			transition: all 0.3s ease;
		}
		
		.shortcut-item:hover {
			background: rgba(255, 255, 255, 0.15);
			transform: translateX(5px);
			box-shadow: 0 4px 12px rgba(0,0,0,0.2);
		}
		
		/* Key display */
		.shortcut-key {
			background: linear-gradient(135deg, #2c3e50, #34495e);
			color: #fff;
			padding: 8px 12px;
			border-radius: 6px;
			font-family: 'Courier New', monospace;
			font-weight: bold;
			font-size: 16px;
			min-width: 30px;
			text-align: center;
			box-shadow: 0 2px 4px rgba(0,0,0,0.3);
			white-space: nowrap;
			border: 1px solid rgba(255,255,255,0.1);
		}
		
		/* Description */
		.shortcut-desc {
			flex: 1;
		}
		
		.shortcut-name {
			font-weight: bold;
			color: #f8f9fa;
			margin-bottom: 4px;
			font-size: 14px;
		}
		
		.shortcut-detail {
			color: #d1d7e0;
			font-size: 13px;
			line-height: 1.5;
		}
		
		/* Combat specific styling */
		.combat-section .shortcut-item {
			border-left-color: #fd7e14;
		}
		
		.combat-section .shortcut-key {
			background: linear-gradient(135deg, #fd7e14, #e67e22);
		}
		
		/* Special multi-key shortcuts */
		.key-combo {
			display: flex;
			align-items: center;
			gap: 5px;
		}
		
		.key-plus {
			color: #a0aec0;
			font-size: 14px;
		}
		
		/* Info note */
		.info-note {
			background: rgba(23, 162, 184, 0.2);
			border: 1px solid rgba(23, 162, 184, 0.3);
			color: #a8e6f0;
			padding: 15px;
			margin: 20px;
			border-radius: 6px;
			font-size: 14px;
			line-height: 1.5;
		}

		.info-note strong {
			color: #4fd1e5;
		}

		/* Responsive design */
		@media (max-width: 768px) {
			.keyboard-header {
				padding: 20px 15px;
			}
			
			.keyboard-title {
				font-size: 24px;
			}
			
			.keyboard-description {
				font-size: 14px;
			}
			
			.shortcuts-grid {
				grid-template-columns: 1fr;
				padding: 15px;
				gap: 12px;
			}
			
			.section-header {
				padding: 14px 15px;
				font-size: 16px;
			}
			
			.shortcut-item {
				padding: 12px;
			}
			
			.shortcut-key {
				font-size: 15px;
				padding: 6px 10px;
			}

			.info-note {
				margin: 15px 10px;
				padding: 12px;
			}
		}
	</style>
</head>

<body>
	<div class="keyboard-container">
		<div class="keyboard-header">
			<div class="keyboard-title">⌨️ Keyboard Shortcuts</div>
			<div class="keyboard-description">
				Complete keyboard reference for Might and Magic III - Isles of Terra
			</div>
		</div>
		
		<div class="info-note">
			<strong>💡 Tip:</strong> These shortcuts work during gameplay. Some shortcuts like Quick Fight (F) and Quick Reference (Q) are especially useful for speeding up gameplay.
		</div>
		
		<!-- Party Management Section -->
		<div class="section-header">Party Management & Interface</div>
		<div class="shortcuts-grid">
			<div class="shortcut-item">
				<div class="shortcut-key">S</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Shoot</div>
					<div class="shortcut-detail">Party members with equipped missile weapons fire them straight ahead.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">C</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Cast</div>
					<div class="shortcut-detail">To cast the readied spell select Cast again. To change the readied spell, select New again.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">R</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Rest</div>
					<div class="shortcut-detail">Restores the party's hit points and spell points. Provided there is at least one food for every member of the party.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">B</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Bash</div>
					<div class="shortcut-detail">Attempts to knock down locked doors and thin walls that hide secret passages.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">D</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Dismiss</div>
					<div class="shortcut-detail">Removes any party member to the Tavern.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">V</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">View Quests</div>
					<div class="shortcut-detail">Displays the Current Quest items and notes.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">M</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Automap</div>
					<div class="shortcut-detail">Displays the map of the current area. Only active if at least one character has the Cartography skill.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">I</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Information</div>
					<div class="shortcut-detail">Lists the date, time, and any active spells.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">Q</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Quick Reference</div>
					<div class="shortcut-detail">Displays the party's vital statistics, gold, gems, and food.</div>
				</div>
			</div>
		</div>
		
		<!-- Combat Section -->
		<div class="combat-section">
			<div class="section-header">Combat Icons</div>
			<div class="shortcuts-grid">
				<div class="shortcut-item">
					<div class="shortcut-key">F</div>
					<div class="shortcut-desc">
						<div class="shortcut-name">Quick Fight</div>
						<div class="shortcut-detail">Battles the opponent(s) using the current Quick Fight option setting.</div>
					</div>
				</div>
				
				<div class="shortcut-item">
					<div class="shortcut-key">C</div>
					<div class="shortcut-desc">
						<div class="shortcut-name">Cast</div>
						<div class="shortcut-detail">Same as in adventuring mode.</div>
					</div>
				</div>
				
				<div class="shortcut-item">
					<div class="shortcut-key">A</div>
					<div class="shortcut-desc">
						<div class="shortcut-name">Attack</div>
						<div class="shortcut-detail">Attacks the targeted opponent with whatever weapon the character has equipped.</div>
					</div>
				</div>
				
				<div class="shortcut-item">
					<div class="shortcut-key">U</div>
					<div class="shortcut-desc">
						<div class="shortcut-name">Use</div>
						<div class="shortcut-detail">Allows a character to equip or remove items, or use an item's special ability.</div>
					</div>
				</div>
				
				<div class="shortcut-item">
					<div class="shortcut-key">R</div>
					<div class="shortcut-desc">
						<div class="shortcut-name">Run</div>
						<div class="shortcut-detail">If successful, the highlighted party member will run to a safe location nearby.</div>
					</div>
				</div>
				
				<div class="shortcut-item">
					<div class="shortcut-key">B</div>
					<div class="shortcut-desc">
						<div class="shortcut-name">Block</div>
						<div class="shortcut-detail">The highlighted party member will attempt to block the opponent's next attack.</div>
					</div>
				</div>
				
				<div class="shortcut-item">
					<div class="shortcut-key">O</div>
					<div class="shortcut-desc">
						<div class="shortcut-name">Quick Fight Options</div>
						<div class="shortcut-detail">A party member may be set to attack, cast, block, or run.</div>
					</div>
				</div>
				
				<div class="shortcut-item">
					<div class="shortcut-key">I</div>
					<div class="shortcut-desc">
						<div class="shortcut-name">Information</div>
						<div class="shortcut-detail">Same as adventuring mode.</div>
					</div>
				</div>
				
				<div class="shortcut-item">
					<div class="shortcut-key">Q</div>
					<div class="shortcut-desc">
						<div class="shortcut-name">Quick Reference</div>
						<div class="shortcut-detail">Same as adventuring mode.</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Movement Section -->
		<div class="section-header">Movement Controls</div>
		<div class="shortcuts-grid">
			<div class="shortcut-item">
				<div class="shortcut-key">↑</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Move Forward</div>
					<div class="shortcut-detail">Move the party forward one step.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">↓</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Move Backward</div>
					<div class="shortcut-detail">Move the party backward one step.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">←</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Turn Left</div>
					<div class="shortcut-detail">Turn the party 90 degrees to the left.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">→</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Turn Right</div>
					<div class="shortcut-detail">Turn the party 90 degrees to the right.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="key-combo">
					<div class="shortcut-key">Shift</div>
					<span class="key-plus">+</span>
					<div class="shortcut-key">←/→</div>
				</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Sidestep</div>
					<div class="shortcut-detail">Move sideways without turning.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">Space</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Interact</div>
					<div class="shortcut-detail">Open doors, chests, or interact with NPCs and objects.</div>
				</div>
			</div>
		</div>
		
		<!-- System Section -->
		<div class="section-header">System Controls</div>
		<div class="shortcuts-grid">
			<div class="shortcut-item">
				<div class="shortcut-key">Esc</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Menu / Cancel</div>
					<div class="shortcut-detail">Opens the game menu or cancels current action.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="key-combo">
					<div class="shortcut-key">F1</div>
					<span class="key-plus">-</span>
					<div class="shortcut-key">F6</div>
				</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Select Character</div>
					<div class="shortcut-detail">Directly select party member 1-6.</div>
				</div>
			</div>
			
			<div class="shortcut-item">
				<div class="shortcut-key">Enter</div>
				<div class="shortcut-desc">
					<div class="shortcut-name">Confirm</div>
					<div class="shortcut-detail">Confirm selections and dialog choices.</div>
				</div>
			</div>
		</div>
	</div>
	<?php
// Include footer
include 'includes/footer.php';
?>
</body>
</html>

