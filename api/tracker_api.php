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
		
		<!-- User Info Section -->
		<div class="user-info-section">
			<div class="username">Welcome, <?= htmlspecialchars($username) ?>!</div>
		</div>
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