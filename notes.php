<?php
include "link.php";
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>Notes</title>
	
	<style>
		/* Enhanced responsive styles with better typography and colors */
		body {
			margin: 0;
			padding: 20px;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
		}
		
		.notes-container {
			width: 100%;
			margin: 0;
			background: rgba(255, 255, 255, 0.95);
			border-radius: 15px;
			box-shadow: 0 8px 32px rgba(0,0,0,0.15);
			overflow: hidden;
			backdrop-filter: blur(10px);
			border: 1px solid rgba(255, 255, 255, 0.2);
		}
		
		.notes-header {
			background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
			color: white;
			padding: 30px 20px;
			text-align: center;
			position: relative;
			overflow: hidden;
		}

		.notes-header::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
			animation: shimmer 3s infinite;
		}

		@keyframes shimmer {
			0% { left: -100%; }
			100% { left: 100%; }
		}
		
		.notes-title {
			margin: 0 0 15px 0;
			font-size: 28px;
			font-weight: 800;
			text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
			letter-spacing: 0.5px;
		}
		
		.notes-description {
			margin: 0;
			opacity: 0.95;
			font-size: 16px;
			line-height: 1.5;
			font-weight: 300;
		}
		
		/* Enhanced responsive iframe with loading state */
		.iframe-wrapper {
			position: relative;
			width: 100%;
			height: 0;
			padding-bottom: 60%; /* 16:10 aspect ratio */
			background: linear-gradient(45deg, #f8f9fa 25%, #e9ecef 25%, #e9ecef 50%, #f8f9fa 50%, #f8f9fa 75%, #e9ecef 75%);
			background-size: 20px 20px;
			animation: loading 1s linear infinite;
		}

		@keyframes loading {
			0% { background-position: 0 0; }
			100% { background-position: 20px 20px; }
		}

		.iframe-wrapper.loaded {
			animation: none;
			background: #f8f9fa;
		}
		
		.iframe-wrapper iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			border: none;
		}
		
		/* Mobile adjustments */
		/* Enhanced mobile responsiveness */
		@media (max-width: 768px) {
			body {
				padding: 10px;
			}
			
			.notes-container {
				border-radius: 10px;
				margin: 0;
				width: 100%;
			}
			
			.notes-header {
				padding: 20px 15px;
			}
			
			.notes-title {
				font-size: 22px;
			}
			
			.notes-description {
				font-size: 14px;
			}
			
			.iframe-wrapper {
				padding-bottom: 75%; /* 4:3 aspect ratio on mobile */
			}
			
			.fullscreen-btn {
				top: 10px;
				right: 10px;
				padding: 10px 15px;
				font-size: 14px;
				border-radius: 25px;
			}
			
			.fullscreen-header {
				padding: 15px 20px;
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
		
		/* Enhanced fullscreen modal with animations */
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
			background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
			color: white;
			padding: 20px 25px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			box-shadow: 0 2px 10px rgba(0,0,0,0.3);
		}
		
		.fullscreen-close {
			background: rgba(255,255,255,0.1);
			border: 1px solid rgba(255,255,255,0.2);
			color: white;
			font-size: 20px;
			cursor: pointer;
			padding: 8px 12px;
			border-radius: 50%;
			transition: all 0.3s ease;
			width: 40px;
			height: 40px;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.fullscreen-close:hover {
			background: rgba(255,255,255,0.2);
			transform: rotate(90deg);
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
	<div class="notes-container">
		<div class="notes-header">
			<div class="notes-title">📝 Game Notes</div>
			<div class="notes-description">
				Access your game notes, strategies, and important information for Might and Magic III - Isles Of Terra
			</div>
		</div>
		
		<div class="iframe-wrapper">
			<button class="fullscreen-btn" onclick="openFullscreen()">⛶ Fullscreen</button>
			<iframe src="notes/" title="Game Notes"></iframe>
		</div>
	</div>
	
	<!-- Fullscreen modal -->
	<div class="fullscreen-modal" id="fullscreenModal">
		<div class="fullscreen-header">
			<div>📝 Game Notes - Fullscreen</div>
			<button class="fullscreen-close" onclick="closeFullscreen()">&times;</button>
		</div>
		<div class="fullscreen-content">
			<iframe src="notes/" title="Game Notes - Fullscreen"></iframe>
		</div>
	</div>

	<script>
		console.log('Simple Notes loaded - Version 6');
		
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