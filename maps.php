<?php
// Redirect to original PHP gallery
header('Location: maps/index.php');
exit;
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>Maps</title>
	
	<style>
		/* Simple, working responsive styles */
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			background: #f5f5f5;
			width: 100%;
			overflow-x: hidden;
		}
		
		.maps-container {
			width: 100%;
			margin: 0;
			padding: 0;
			background: white;
			border-radius: 0;
			box-shadow: none;
			overflow: hidden;
		}
		
		.maps-header {
			background: linear-gradient(135deg, #dc3545, #c82333);
			color: white;
			padding: 20px 10px;
			text-align: center;
			width: 100%;
			box-sizing: border-box;
		}
		
		.maps-title {
			margin: 0 0 10px 0;
			font-size: 24px;
			font-weight: bold;
		}
		
		.maps-description {
			margin: 0;
			opacity: 0.9;
			font-size: 16px;
		}
		
		.version-info {
			font-size: 12px;
			opacity: 0.7;
			margin-top: 10px;
		}
		
		/* Simple responsive iframe */
		.iframe-wrapper {
			position: relative;
			width: 100%;
			height: 0;
			padding-bottom: 60%; /* 16:10 aspect ratio */
			background: #f8f9fa;
			margin: 0;
			padding-left: 0;
			padding-right: 0;
		}
		
		.iframe-wrapper iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			border: none;
		}
		
		/* Mobile adjustments - Maximum width usage */
		@media (max-width: 768px) {
			body {
				padding: 0;
				margin: 0;
				width: 100%;
			}
			
			.maps-container {
				border-radius: 0;
				margin: 0;
				width: 100%;
				padding: 0;
			}
			
			.maps-header {
				padding: 15px 10px;
				width: 100%;
				box-sizing: border-box;
			}
			
			.fullscreen-btn {
				top: 10px;
				right: 10px;
				padding: 10px 15px;
				font-size: 14px;
				border-radius: 25px;
			}
			
			.maps-title {
				font-size: 20px;
			}
			
			.maps-description {
				font-size: 14px;
			}
			
			.iframe-wrapper {
				padding-bottom: 75%; /* 4:3 aspect ratio on mobile */
				width: 100%;
				margin: 0;
				padding-left: 0;
				padding-right: 0;
			}
			
			/* Ensure no horizontal scrolling */
			* {
				max-width: 100%;
				box-sizing: border-box;
			}
			
			html, body {
				overflow-x: hidden;
				position: relative;
			}
		}
		
		/* Fullscreen button matching tracker style */
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
		
		/* Enhanced fullscreen modal */
		.fullscreen-modal {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100vw;
			height: 100vh;
			background: rgba(0,0,0,0.95);
			z-index: 1000;
			opacity: 0;
			transition: opacity 0.3s ease;
		}

		.fullscreen-modal.active {
			display: block;
			opacity: 1;
		}
		
		.fullscreen-header {
			background: rgba(0,0,0,0.8);
			color: white;
			padding: 15px 20px;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		
		.fullscreen-close {
			background: none;
			border: none;
			color: white;
			font-size: 24px;
			cursor: pointer;
			padding: 5px;
		}
		
		.fullscreen-content {
			height: calc(100vh - 80px);
			width: 100vw;
		}
		
		.fullscreen-content iframe {
			width: 100%;
			height: 100%;
			border: none;
		}
	</style>
</head>

<body>
	<div class="maps-container">
		<div class="maps-header">
			<div class="maps-title">🗺️ Game Maps</div>
			<div class="maps-description">
				Explore all the maps and locations for Might and Magic III - Isles Of Terra
			</div>
		</div>
		
		<div class="iframe-wrapper">
			<button class="fullscreen-btn" onclick="openFullscreen()">⛶ Fullscreen</button>
			<iframe src="maps/" title="Game Maps" allowfullscreen></iframe>
		</div>
	</div>
	
	<!-- Fullscreen modal -->
	<div class="fullscreen-modal" id="fullscreenModal">
		<div class="fullscreen-header">
			<div>🗺️ Game Maps - Fullscreen</div>
			<button class="fullscreen-close" onclick="closeFullscreen()">&times;</button>
		</div>
		<div class="fullscreen-content">
			<iframe src="maps/" title="Game Maps - Fullscreen" allowfullscreen></iframe>
		</div>
	</div>

	<script>
		console.log('Simple Maps loaded');
		
		function openFullscreen() {
			document.getElementById('fullscreenModal').classList.add('active');
			document.body.style.overflow = 'hidden';
		}
		
		function closeFullscreen() {
			document.getElementById('fullscreenModal').classList.remove('active');
			document.body.style.overflow = 'auto';
		}
		
		// Close with Escape key
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape') {
				closeFullscreen();
			}
		});
	</script>
</body>
</html>