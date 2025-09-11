<?php
include "link.php";
?>
<?php
require_once 'api/auth.php';

// Require authentication for tracker
$auth = $mm3Auth->requireAuth();
$userId = $auth['user_id'];
$username = $auth['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MM3 Progress Tracker</title>
	
	<style>
		/* Reset for full width */
		* {
			box-sizing: border-box;
		}
		
		body {
			margin: 0;
			padding: 0;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: transparent;
			width: 100%;
		}

		.tracker-wrapper {
			width: 100%;
			margin: 0;
			padding: 0;
		}

		/* Container Layout - NO BORDER RADIUS ON MOBILE */
		.container {
			width: 100%;
			background: rgba(255, 255, 255, 0.95);
			overflow: hidden;
		}

		/* Header */
		.header {
			background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
			color: white;
			padding: 30px 20px;
			text-align: center;
		}

		.header h1 {
			font-size: 2em;
			margin-bottom: 10px;
			text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
		}

		.header p {
			font-size: 1.1em;
			opacity: 0.9;
		}

		/* Stats Section */
		.stats {
			display: flex;
			justify-content: space-around;
			padding: 20px 10px;
			background: #f8f9fa;
			border-bottom: 2px solid #e9ecef;
			flex-wrap: wrap;
		}

		.stat-item {
			text-align: center;
			padding: 10px;
			min-width: 100px;
			flex: 1;
		}

		.stat-number {
			font-size: 2em;
			font-weight: bold;
			color: #2c3e50;
			transition: all 0.3s ease;
		}

		.stat-number.updated {
			color: #28a745;
			transform: scale(1.1);
		}

		.stat-label {
			color: #6c757d;
			font-size: 0.9em;
			margin-top: 5px;
		}

		/* Content Area - CRITICAL FOR FULL WIDTH */
		.content {
			padding: 10px;
			width: 100%;
		}

		/* Controls */
		.controls {
			text-align: center;
			margin-bottom: 15px;
		}

		/* Area Sections - FULL WIDTH ON MOBILE */
		.area-section {
			margin-bottom: 15px;
			border: 2px solid #e9ecef;
			border-radius: 8px;
			overflow: hidden;
			background: white;
			box-shadow: 0 3px 10px rgba(0,0,0,0.08);
			width: 100%;
		}

		.area-header {
			background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
			color: white;
			padding: 15px;
			cursor: pointer;
			transition: all 0.3s ease;
			display: flex;
			justify-content: space-between;
			align-items: center;
			flex-wrap: wrap;
			gap: 10px;
		}

		.area-header:hover {
			background: linear-gradient(135deg, #2980b9 0%, #1f5582 100%);
		}

		.area-title {
			font-size: 1.1em;
			font-weight: bold;
			flex: 1;
		}

		.area-progress {
			background: rgba(255,255,255,0.2);
			padding: 5px 12px;
			border-radius: 20px;
			font-size: 0.85em;
			white-space: nowrap;
		}

		.area-content {
			padding: 15px 10px;
			display: none;
		}

		.area-content.active {
			display: block;
		}

		/* Location Items */
		.location-item {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 10px;
			margin-bottom: 8px;
			background: #f8f9fa;
			border-radius: 6px;
			transition: all 0.3s ease;
			border-left: 4px solid #dee2e6;
			gap: 10px;
		}

		.location-item:hover {
			background: #e9ecef;
			transform: translateX(3px);
		}

		.location-item.completed {
			background: #d4edda;
			border-left-color: #28a745;
		}

		@keyframes completionPulse {
			0% { transform: scale(1); }
			50% { transform: scale(1.05); }
			100% { transform: scale(1); }
		}

		.location-item.just-completed {
			animation: completionPulse 0.6s ease-in-out;
		}

		.location-info {
			flex: 1;
			min-width: 0;
			overflow: hidden;
		}

		.location-name {
			font-weight: bold;
			color: #2c3e50;
			display: flex;
			align-items: center;
			gap: 6px;
			flex-wrap: wrap;
			margin-bottom: 4px;
		}

		.location-details {
			font-size: 0.8em;
			color: #6c757d;
			word-break: break-word;
		}

		/* Location Type Badges */
		.location-type {
			background: #007bff;
			color: white;
			padding: 2px 6px;
			border-radius: 10px;
			font-size: 0.7em;
			white-space: nowrap;
			flex-shrink: 0;
		}

		.location-type.town { background: #28a745; }
		.location-type.castle { background: #dc3545; }
		.location-type.dungeon { background: #6f42c1; }
		.location-type.cavern { background: #6610f2; }
		.location-type.pyramid { background: #fd7e14; }
		.location-type.outdoor { background: #17a2b8; }
		.location-type.arena { background: #e83e8c; }

		/* Toggle Switch */
		.toggle-switch {
			position: relative;
			display: inline-block;
			width: 44px;
			height: 24px;
			flex-shrink: 0;
		}

		.toggle-switch input {
			opacity: 0;
			width: 0;
			height: 0;
		}

		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			transition: .4s;
			border-radius: 24px;
		}

		.slider:before {
			position: absolute;
			content: "";
			height: 18px;
			width: 18px;
			left: 3px;
			bottom: 3px;
			background-color: white;
			transition: .4s;
			border-radius: 50%;
		}

		input:checked + .slider {
			background-color: #28a745;
		}

		input:checked + .slider:before {
			transform: translateX(20px);
		}

		/* Single Button */
		.btn {
			background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
			color: white;
			border: none;
			padding: 12px 24px;
			border-radius: 25px;
			cursor: pointer;
			font-size: 0.95em;
			transition: all 0.3s ease;
			display: inline-block;
		}

		.btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(0,0,0,0.2);
		}

		/* User info section */
		.user-info-section {
			margin-top: 20px;
			padding: 15px 20px;
			background: rgba(255, 255, 255, 0.1);
			border-radius: 10px;
			backdrop-filter: blur(10px);
			text-align: center;
			color: white;
		}
		
		.user-info-section .username {
			font-size: 18px;
			font-weight: bold;
			margin-bottom: 10px;
		}
		
		.user-info-section .logout-link {
			color: #dc3545;
			text-decoration: none;
			font-weight: bold;
			padding: 8px 16px;
			border: 2px solid #dc3545;
			border-radius: 20px;
			transition: all 0.3s ease;
			display: inline-block;
		}
		
		.user-info-section .logout-link:hover {
			background: #dc3545;
			color: white;
			transform: translateY(-2px);
		}

		/* Fullscreen button */
		.fullscreen-btn {
			position: fixed;
			top: 10px;
			right: 10px;
			background: rgba(220, 53, 69, 0.9);
			color: white;
			border: none;
			padding: 8px 12px;
			border-radius: 20px;
			font-size: 12px;
			cursor: pointer;
			z-index: 100;
			box-shadow: 0 2px 8px rgba(0,0,0,0.3);
			transition: all 0.3s ease;
		}

		.fullscreen-btn:hover {
			background: rgba(200, 35, 51, 1);
			transform: scale(1.05);
		}

		/* Desktop/Tablet Styles */
		@media (min-width: 769px) {
			.container {
				max-width: 1200px;
				margin: 0 auto;
				border-radius: 15px;
			}
			
			.content {
				padding: 20px;
			}
			
			.area-section {
				margin-bottom: 20px;
				border-radius: 10px;
			}
			
			.area-header {
				padding: 15px 20px;
			}
			
			.area-title {
				font-size: 1.2em;
			}
			
			.area-progress {
				font-size: 0.9em;
				padding: 5px 15px;
			}
			
			.area-content {
				padding: 20px;
			}
			
			.location-item {
				padding: 12px 15px;
				border-radius: 8px;
			}
			
			.location-details {
				font-size: 0.85em;
			}
			
			.location-type {
				padding: 2px 8px;
				font-size: 0.75em;
			}
			
			.toggle-switch {
				width: 50px;
				height: 25px;
			}
			
			.slider:before {
				height: 19px;
				width: 19px;
			}
			
			input:checked + .slider:before {
				transform: translateX(25px);
			}
			
			.fullscreen-btn {
				top: 10px;
				right: 10px;
				padding: 10px 15px;
				font-size: 14px;
				border-radius: 25px;
			}
		}

		/* Mobile Specific Adjustments */
		@media (max-width: 768px) {
			.header {
				padding: 20px 15px;
			}
			
			.header h1 {
				font-size: 1.6em;
			}
			
			.header p {
				font-size: 0.95em;
			}
			
			.stats {
				padding: 15px 5px;
			}
			
			.stat-number {
				font-size: 1.8em;
			}
			
			.stat-label {
				font-size: 0.8em;
			}
			
			/* Ensure full width on mobile */
			#areas-container {
				width: 100%;
			}
		}
	</style>
</head>

<body>
	<div class="tracker-header">
		<h1 class="tracker-title">🎯 Progress Tracker</h1>
		<p class="tracker-description">
			Track your exploration progress through all areas of Might and Magic III - Isles of Terra
		</p>
	</div>
	
	<div class="tracker-wrapper">
		<button class="fullscreen-btn" onclick="toggleFullscreen()">⛶ Fullscreen</button>
		
		<div class="container">
			<div class="header">
				<h1>🏰 Might and Magic III: Isles of Terra</h1>
				<p>Progress Tracker - Mark Your Exploration Journey</p>
			</div>
			
			<div class="stats">
				<div class="stat-item">
					<div class="stat-number" id="completed-count">0</div>
					<div class="stat-label">Completed</div>
				</div>
				<div class="stat-item">
					<div class="stat-number" id="total-count">0</div>
					<div class="stat-label">Total Areas</div>
				</div>
				<div class="stat-item">
					<div class="stat-number" id="progress-percent">0%</div>
					<div class="stat-label">Progress</div>
				</div>
			</div>
			
			<div class="content">
				<div class="controls">
					<button class="btn" onclick="UI.toggleAllSections()">Expand/Collapse All</button>
				</div>
				
				<div id="areas-container">
					<!-- Areas will be dynamically generated here -->
				</div>
			</div>
		</div>
	</div>

	<script>
		// Constants (same as before)
		const LOCATION_TYPES = {
			town: { label: "Town", color: "#28a745", icon: "🏘️" },
			castle: { label: "Castle", color: "#dc3545", icon: "🏰" },
			dungeon: { label: "Dungeon", color: "#6f42c1", icon: "🕳️" },
			cavern: { label: "Cavern", color: "#6610f2", icon: "🕳️" },
			pyramid: { label: "Pyramid", color: "#fd7e14", icon: "🔺" },
			outdoor: { label: "Outdoor", color: "#17a2b8", icon: "🌍" },
			arena: { label: "Arena", color: "#e83e8c", icon: "⚔️" }
		};

		const STORAGE_KEYS = {
			PROGRESS: 'mm3Progress',
			SETTINGS: 'mm3Settings',
			LAST_SAVE: 'mm3LastSave'
		};

		const MESSAGES = {
			CLEAR_CONFIRM: 'Are you sure you want to clear all progress? This cannot be undone.',
			SAVE_SUCCESS: 'Progress saved successfully!',
			LOAD_SUCCESS: 'Progress loaded successfully!',
			EXPORT_SUCCESS: 'Progress exported to clipboard!',
			IMPORT_SUCCESS: 'Progress imported successfully!'
		};

		const AREA_ORDER = [
			'a1', 'a2', 'a3', 'a4',
			'b1', 'b2', 'b3', 'b4',
			'c1', 'c2', 'c3', 'c4',
			'd1', 'd2', 'd3', 'd4',
			'e1', 'e2', 'e3', 'e4',
			'f1', 'f2', 'f3', 'f4',
			'special'
		];

		// Game Areas Data (same as before - keeping all locations)
		const GAME_AREAS = {
			a1: {
				title: "🌟 A1 - Starting Area",
				locations: [
					{ name: "Fountain Head", type: "town", coordinates: "A1 (9,10)", transport: 1, mirrorPortal: "HOME" },
					{ name: "Fountain Head Cavern", type: "cavern", coordinates: "A1 Underground", transport: 6 },
					{ name: "Ancient Temple of Moo", type: "dungeon", coordinates: "A1 (6,5)", transport: 16 },
					{ name: "A1 Outdoor Area", type: "outdoor", coordinates: "A1 (0,0-15,15)", transport: 41 }
				]
			},
			a2: {
				title: "🏖️ A2 - Coastal Area",
				locations: [
					{ name: "Baywatch", type: "town", coordinates: "A2 (14,1)", transport: 2, mirrorPortal: "SEADOG" },
					{ name: "Baywatch Cavern", type: "cavern", coordinates: "A2 Underground", transport: 7 },
					{ name: "Castle Whiteshield", type: "castle", coordinates: "A2 (4,15)", transport: 24 },
					{ name: "Castle Whiteshield Dungeon", type: "dungeon", coordinates: "A2 Underground", transport: 29 },
					{ name: "Forward Storage Sector", type: "pyramid", coordinates: "A2 (5,2)", transport: 39 },
					{ name: "A2 Outdoor Area", type: "outdoor", coordinates: "A2 (0,0-15,15)", transport: 42 }
				]
			},
			a3: {
				title: "🏝️ A3 - Island Area",
				locations: [
					{ name: "Halls of Insanity", type: "dungeon", coordinates: "A3 (6,6)", transport: 19 },
					{ name: "A3 Outdoor Area", type: "outdoor", coordinates: "A3 (0,0-15,15)", transport: 43 }
				]
			},
			a4: {
				title: "🌅 A4 - Eastern Island",
				locations: [
					{ name: "A4 Outdoor Area", type: "outdoor", coordinates: "A4 (0,0-15,15)", transport: 44 }
				]
			},
			b1: {
				title: "⚔️ B1 - Central Northern Area",
				locations: [
					{ name: "Cyclops Cavern", type: "dungeon", coordinates: "B1 (12,10)", transport: 11 },
					{ name: "Slithercult Stronghold", type: "dungeon", coordinates: "B1 (3,1)", transport: 17 },
					{ name: "B1 Outdoor Area", type: "outdoor", coordinates: "B1 (0,0-15,15)", transport: 45 }
				]
			},
			b2: {
				title: "👹 B2 - Valley of Trolls",
				locations: [
					{ name: "Fortress of Fear", type: "dungeon", coordinates: "B2 (10,13)", transport: 18 },
					{ name: "B2 Outdoor Area", type: "outdoor", coordinates: "B2 (0,0-15,15)", transport: 46 }
				]
			},
			b3: {
				title: "👹 B3 - Land of Gargoyles",
				locations: [
					{ name: "Dark Warrior Keep", type: "dungeon", coordinates: "B3 (0,6)", transport: 20 },
					{ name: "Cathedral of Carnage", type: "dungeon", coordinates: "B3 (9,7)", transport: 21 },
					{ name: "B3 Outdoor Area", type: "outdoor", coordinates: "B3 (0,0-15,15)", transport: 47 }
				]
			},
			b4: {
				title: "🏘️ B4 - Wildabar Region",
				locations: [
					{ name: "Wildabar", type: "town", coordinates: "B4 (12,3)", transport: 3, mirrorPortal: "FREEMAN" },
					{ name: "Wildabar Cavern", type: "cavern", coordinates: "B4 Underground", transport: 8 },
					{ name: "Castle Bloodreign", type: "castle", coordinates: "B4 (4,11)", transport: 25 },
					{ name: "Castle Bloodreign Dungeon", type: "dungeon", coordinates: "B4 Underground", transport: 30 },
					{ name: "Arachnoid Cavern", type: "dungeon", coordinates: "B4 (0,7)", transport: 12 },
					{ name: "B4 Outdoor Area", type: "outdoor", coordinates: "B4 (0,0-15,15)", transport: 48 }
				]
			},
			c1: {
				title: "❄️ C1 - Frozen Isles (North)",
				locations: [
					{ name: "C1 Outdoor Area", type: "outdoor", coordinates: "C1 (0,0-15,15)", transport: 49 }
				]
			},
			c2: {
				title: "🖥️ C2 - Central Control Area",
				locations: [
					{ name: "Central Control Sector", type: "pyramid", coordinates: "C2 (15,0)", transport: 38, mirrorPortal: "FIRE" },
					{ name: "C2 Outdoor Area", type: "outdoor", coordinates: "C2 (0,0-15,15)", transport: 50 }
				]
			},
			c3: {
				title: "🐉 C3 - Great Hydra Territory",
				locations: [
					{ name: "C3 Outdoor Area", type: "outdoor", coordinates: "C3 (0,0-15,15)", transport: 51 }
				]
			},
			c4: {
				title: "🌫️ C4 - Isles of Illusion (North)",
				locations: [
					{ name: "Castle Greywind", type: "castle", coordinates: "C4 (5,8)", transport: 27 },
					{ name: "Castle Greywind Dungeon", type: "dungeon", coordinates: "C4 Underground", transport: 32 },
					{ name: "C4 Outdoor Area", type: "outdoor", coordinates: "C4 (0,0-15,15)", transport: 52 }
				]
			},
			d1: {
				title: "🧊 D1 - Frozen Isles (South)",
				locations: [
					{ name: "Cursed Cold Cavern", type: "dungeon", coordinates: "D1 (9,5)", transport: 13 },
					{ name: "D1 Outdoor Area", type: "outdoor", coordinates: "D1 (0,0-15,15)", transport: 53 }
				]
			},
			d2: {
				title: "🔥 D2 - Fire Stalker Region",
				locations: [
					{ name: "D2 Outdoor Area", type: "outdoor", coordinates: "D2 (0,0-15,15)", transport: 54 }
				]
			},
			d3: {
				title: "🌋 D3 - Fire Isle",
				locations: [
					{ name: "Blistering Heights", type: "town", coordinates: "D3 (6,15)", transport: 5, mirrorPortal: "REDHOT" },
					{ name: "Blistering Heights Cavern", type: "cavern", coordinates: "D3 Underground", transport: 10 },
					{ name: "D3 Outdoor Area", type: "outdoor", coordinates: "D3 (0,0-15,15)", transport: 55 }
				]
			},
			d4: {
				title: "🌊 D4 - Isles of Illusion (South)",
				locations: [
					{ name: "Castle Blackwind", type: "castle", coordinates: "D4 (6,8)", transport: 28 },
					{ name: "Castle Blackwind Dungeon", type: "dungeon", coordinates: "D4 Underground", transport: 33 },
					{ name: "D4 Outdoor Area", type: "outdoor", coordinates: "D4 (0,0-15,15)", transport: 56 }
				]
			},
			e1: {
				title: "💨 E1 - Air Isle",
				locations: [
					{ name: "Castle Dragontooth", type: "castle", coordinates: "E1 (10,5)", transport: 26 },
					{ name: "Castle Dragontooth Dungeon", type: "dungeon", coordinates: "E1 Underground", transport: 31 },
					{ name: "E1 Outdoor Area", type: "outdoor", coordinates: "E1 (0,0-15,15)", transport: 57, mirrorPortal: "AIR" }
				]
			},
			e2: {
				title: "🐸 E2 - Swamp Region",
				locations: [
					{ name: "Swamp Town", type: "town", coordinates: "E2 (7,1)", transport: 4, mirrorPortal: "DOOMED" },
					{ name: "Swamp Town Cavern", type: "cavern", coordinates: "E2 Underground", transport: 9 },
					{ name: "E2 Outdoor Area", type: "outdoor", coordinates: "E2 (0,0-15,15)", transport: 58 }
				]
			},
			e3: {
				title: "🌊 E3 - Water Isle",
				locations: [
					{ name: "E3 Outdoor Area", type: "outdoor", coordinates: "E3 (0,0-15,15)", transport: 59, mirrorPortal: "WATER" }
				]
			},
			e4: {
				title: "🌍 E4 - Earth Isle",
				locations: [
					{ name: "Magic Cavern", type: "dungeon", coordinates: "E4 (7,7)", transport: 15 },
					{ name: "E4 Outdoor Area", type: "outdoor", coordinates: "E4 (0,0-15,15)", transport: 60, mirrorPortal: "EARTH" }
				]
			},
			f1: {
				title: "🐲 F1 - Dragon Territory",
				locations: [
					{ name: "Dragon Cavern", type: "dungeon", coordinates: "F1 (10,10)", transport: 14, mirrorPortal: "DOE MEISTER" },
					{ name: "Beta Engine Sector", type: "pyramid", coordinates: "F1 (4,9)", transport: 36 },
					{ name: "F1 Outdoor Area", type: "outdoor", coordinates: "F1 (0,0-15,15)", transport: 61 }
				]
			},
			f2: {
				title: "💀 F2 - Tomb Region",
				locations: [
					{ name: "Tomb of Terror", type: "dungeon", coordinates: "F2 (0,0)", transport: 22 },
					{ name: "Main Engine Sector", type: "pyramid", coordinates: "F2 (3,4)", transport: 35 },
					{ name: "F2 Outdoor Area", type: "outdoor", coordinates: "F2 (0,0-15,15)", transport: 62 }
				]
			},
			f3: {
				title: "😈 F3 - Hell Maze Area",
				locations: [
					{ name: "Maze from Hell", type: "dungeon", coordinates: "F3 (2,6)", transport: 23 },
					{ name: "F3 Outdoor Area", type: "outdoor", coordinates: "F3 (0,0-15,15)", transport: 63 }
				]
			},
			f4: {
				title: "🚀 F4 - Alpha Engine Region",
				locations: [
					{ name: "Alpha Engine Sector", type: "pyramid", coordinates: "F4 (9,8)", transport: 34 },
					{ name: "F4 Outdoor Area", type: "outdoor", coordinates: "F4 (0,0-15,15)", transport: 64 }
				]
			},
			special: {
				title: "⭐ Special Areas",
				locations: [
					{ name: "The Arena", type: "arena", coordinates: "Special", transport: null, mirrorPortal: "ARENA" },
					{ name: "Aft Storage Sector", type: "pyramid", coordinates: "A2 (5,2)", transport: 37, mirrorPortal: "ORB MEISTER" },
					{ name: "Main Control Sector", type: "pyramid", coordinates: "C2 (15,0)", transport: 40 }
				]
			}
		};

		// Simple API caller - authentication handled server-side
		const API = {
			apiUrl: 'api/tracker_api.php',
			
			async call(action, data = null, method = 'GET') {
				try {
					const options = {
						method: method,
						headers: {
							'Content-Type': 'application/json',
						}
					};
					
					let url = `${this.apiUrl}?action=${action}`;
					
					if (method === 'POST' && data) {
						options.body = JSON.stringify(data);
					}
					
					const response = await fetch(url, options);
					const result = await response.json();
					
					if (!result.success) {
						throw new Error(result.error || 'API call failed');
					}
					
					return result.data;
				} catch (error) {
					console.error(`API call failed (${action}):`, error);
					throw error;
				}
			}
		};

		// Database Storage Manager - SQLite Backend
		const Storage = {
			async apiCall(action, data = null, method = 'GET') {
				return API.call(action, data, method);
			},
			
			async save(progress) {
				try {
					await this.apiCall('save_progress', { progress }, 'POST');
					return true;
				} catch (error) {
					console.error('Failed to save progress:', error);
					return false;
				}
			},
			
			async load() {
				try {
					const progress = await this.apiCall('progress');
					return progress || {};
				} catch (error) {
					console.error('Failed to load progress:', error);
					return {};
				}
			},
			
			async clear() {
				try {
					await this.apiCall('save_progress', { progress: {} }, 'POST');
					return true;
				} catch (error) {
					console.error('Failed to clear progress:', error);
					return false;
				}
			},
			
			async loadSettings() {
				try {
					const settings = await this.apiCall('settings');
					return Object.keys(settings).length > 0 ? settings : this.getDefaultSettings();
				} catch (error) {
					console.error('Failed to load settings:', error);
					return this.getDefaultSettings();
				}
			},
			
			async saveSettings(settings) {
				try {
					await this.apiCall('save_settings', { settings }, 'POST');
					return true;
				} catch (error) {
					console.error('Failed to save settings:', error);
					return false;
				}
			},
			
			getDefaultSettings: function() {
				return {
					autoSave: true,
					expandedSections: [],
					confirmClear: true
				};
			},
			
			async autoSave(progress) {
				const settings = await this.loadSettings();
				if (settings.autoSave) {
					return await this.save(progress);
				}
				return false;
			}
		};

		// UI Manager (most methods remain the same)
		const UI = {
			state: {
				sectionsExpanded: false,
				currentProgress: {},
				settings: {}
			},
			
			async init() {
				this.state.settings = await Storage.loadSettings();
			},
			
			generateLocationHTML: function(location, areaKey, locationIndex) {
				const locationId = `${areaKey}-${locationIndex}`;
				const transportInfo = location.transport ? `Transport #${location.transport}` : 'Special';
				const mirrorPortalInfo = location.mirrorPortal ? ` | Mirror Portal "${location.mirrorPortal}"` : '';
				
				return `
					<div class="location-item" data-location-id="${locationId}">
						<div class="location-info">
							<div class="location-name">
								<span class="location-type ${location.type}">${LOCATION_TYPES[location.type].label}</span>
								${location.name}
							</div>
							<div class="location-details">
								${location.coordinates} | ${transportInfo}${mirrorPortalInfo}
							</div>
						</div>
						<label class="toggle-switch">
							<input type="checkbox" 
								   id="checkbox-${locationId}"
								   data-area="${areaKey}" 
								   data-location-index="${locationIndex}"
								   onchange="UI.onLocationToggle(this)">
							<span class="slider"></span>
						</label>
					</div>
				`;
			},
			
			generateAreaHTML: function(areaKey, area) {
				const locationsHTML = area.locations.map((location, index) => 
					this.generateLocationHTML(location, areaKey, index)
				).join('');
				
				return `
					<div class="area-section" data-area="${areaKey}">
						<div class="area-header" onclick="UI.toggleSection('area-${areaKey}')">
							<span class="area-title">${area.title}</span>
							<span class="area-progress" id="progress-${areaKey}">0/${area.locations.length} completed</span>
						</div>
						<div class="area-content" id="area-${areaKey}">
							${locationsHTML}
						</div>
					</div>
				`;
			},
			
			renderAreas: function() {
				const container = document.getElementById('areas-container');
				if (!container) return;
				
				const areasHTML = AREA_ORDER.map(areaKey => {
					const area = GAME_AREAS[areaKey];
					return this.generateAreaHTML(areaKey, area);
				}).join('');
				
				container.innerHTML = areasHTML;
			},
			
			async toggleSection(sectionId) {
				const section = document.getElementById(sectionId);
				if (section) {
					section.classList.toggle('active');
					
					const areaKey = sectionId.replace('area-', '');
					if (section.classList.contains('active')) {
						if (!this.state.settings.expandedSections.includes(areaKey)) {
							this.state.settings.expandedSections.push(areaKey);
						}
					} else {
						this.state.settings.expandedSections = this.state.settings.expandedSections.filter(key => key !== areaKey);
					}
					
					await Storage.saveSettings(this.state.settings);
				}
			},
			
			async toggleAllSections() {
				const sections = document.querySelectorAll('.area-content');
				this.state.sectionsExpanded = !this.state.sectionsExpanded;
				
				sections.forEach(section => {
					if (this.state.sectionsExpanded) {
						section.classList.add('active');
					} else {
						section.classList.remove('active');
					}
				});
				
				const button = document.querySelector('.btn');
				if (button) {
					button.textContent = this.state.sectionsExpanded ? 'Collapse All' : 'Expand All';
				}
				
				if (this.state.sectionsExpanded) {
					this.state.settings.expandedSections = [...AREA_ORDER];
				} else {
					this.state.settings.expandedSections = [];
				}
				await Storage.saveSettings(this.state.settings);
			},
			
			async onLocationToggle(checkbox) {
				const areaKey = checkbox.dataset.area;
				const locationIndex = parseInt(checkbox.dataset.locationIndex);
				const locationId = `${areaKey}-${locationIndex}`;
				
				if (!this.state.currentProgress[areaKey]) {
					this.state.currentProgress[areaKey] = {};
				}
				this.state.currentProgress[areaKey][locationId] = checkbox.checked;
				
				const locationItem = checkbox.closest('.location-item');
				if (locationItem) {
					if (checkbox.checked) {
						locationItem.classList.add('completed');
						locationItem.classList.add('just-completed');
						setTimeout(() => locationItem.classList.remove('just-completed'), 600);
					} else {
						locationItem.classList.remove('completed');
					}
				}
				
				this.updateProgress();
				await Storage.autoSave(this.state.currentProgress);
			},
			
			updateProgress: function() {
				let totalCompleted = 0;
				let totalLocations = 0;
				
				AREA_ORDER.forEach(areaKey => {
					const area = GAME_AREAS[areaKey];
					const areaLocations = area.locations.length;
					totalLocations += areaLocations;
					
					let areaCompleted = 0;
					if (this.state.currentProgress[areaKey]) {
						areaCompleted = Object.values(this.state.currentProgress[areaKey]).filter(v => v).length;
					}
					totalCompleted += areaCompleted;
					
					const progressElement = document.getElementById(`progress-${areaKey}`);
					if (progressElement) {
						progressElement.textContent = `${areaCompleted}/${areaLocations} completed`;
					}
				});
				
				this.updateStatElement('completed-count', totalCompleted);
				this.updateStatElement('total-count', totalLocations);
				this.updateStatElement('progress-percent', 
					totalLocations > 0 ? Math.round((totalCompleted / totalLocations) * 100) + '%' : '0%'
				);
			},
			
			updateStatElement: function(id, value) {
				const element = document.getElementById(id);
				if (element && element.textContent !== value.toString()) {
					element.classList.add('updated');
					element.textContent = value;
					setTimeout(() => element.classList.remove('updated'), 300);
				}
			},
			
			async loadProgress() {
				const progress = await Storage.load();
				this.state.currentProgress = progress;
				
				for (const areaKey in progress) {
					for (const locationId in progress[areaKey]) {
						if (progress[areaKey][locationId]) {
							const checkbox = document.getElementById(`checkbox-${locationId}`);
							if (checkbox) {
								checkbox.checked = true;
								const locationItem = checkbox.closest('.location-item');
								if (locationItem) {
									locationItem.classList.add('completed');
								}
							}
						}
					}
				}
				
				this.state.settings.expandedSections.forEach(areaKey => {
					const section = document.getElementById(`area-${areaKey}`);
					if (section) {
						section.classList.add('active');
					}
				});
				
				this.updateProgress();
			},
			
			showMessage: function(message, duration = 3000) {
				let messageEl = document.getElementById('temp-message');
				if (!messageEl) {
					messageEl = document.createElement('div');
					messageEl.id = 'temp-message';
					messageEl.style.cssText = `
						position: fixed;
						top: 20px;
						right: 20px;
						background: #28a745;
						color: white;
						padding: 10px 20px;
						border-radius: 5px;
						z-index: 1000;
						opacity: 0;
						transition: opacity 0.3s ease;
					`;
					document.body.appendChild(messageEl);
				}
				
				messageEl.textContent = message;
				messageEl.style.opacity = '1';
				
				setTimeout(() => {
					messageEl.style.opacity = '0';
				}, duration);
			}
		};

		// Main App
		const App = {
			async init() {
				console.log('Initializing MM3 Progress Tracker with SQLite backend');
				
				try {
					await UI.init();
					UI.renderAreas();
					
					// Load progress (user is already authenticated server-side)
					await UI.loadProgress();
					
					// Set up auto-save
					setInterval(async () => {
						if (UI.state.currentProgress && Object.keys(UI.state.currentProgress).length > 0) {
							await Storage.autoSave(UI.state.currentProgress);
						}
					}, 30000);
					
					window.addEventListener('beforeunload', async () => {
						await Storage.save(UI.state.currentProgress);
					});
					
					console.log('MM3 Progress Tracker initialized successfully with database backend');
				} catch (error) {
					console.error('Failed to initialize tracker:', error);
					this.showError('Failed to connect to database. Please refresh the page.');
				}
			},
			
			showError(message) {
				const errorDiv = document.createElement('div');
				errorDiv.style.cssText = `
					position: fixed;
					top: 20px;
					left: 50%;
					transform: translateX(-50%);
					background: #dc3545;
					color: white;
					padding: 15px 25px;
					border-radius: 5px;
					z-index: 1000;
					font-weight: bold;
				`;
				errorDiv.textContent = message;
				document.body.appendChild(errorDiv);
				
				setTimeout(() => {
					document.body.removeChild(errorDiv);
				}, 5000);
			}
		};

		// Initialize when DOM is ready
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', () => {
				App.init();
			});
		} else {
			App.init();
		}

		// Make UI available globally
		window.UI = UI;
		
		// Fullscreen functionality
		function toggleFullscreen() {
			if (!document.fullscreenElement) {
				document.documentElement.requestFullscreen().catch(err => {
					alert(`Error attempting to enable fullscreen: ${err.message}`);
				});
				document.querySelector('.fullscreen-btn').innerHTML = '✕ Exit';
			} else {
				document.exitFullscreen();
				document.querySelector('.fullscreen-btn').innerHTML = '⛶ Fullscreen';
			}
		}
		
		document.addEventListener('fullscreenchange', () => {
			if (document.fullscreenElement) {
				document.querySelector('.fullscreen-btn').innerHTML = '✕ Exit';
			} else {
				document.querySelector('.fullscreen-btn').innerHTML = '⛶ Fullscreen';
			}
		});
	</script>
</body>
</html>