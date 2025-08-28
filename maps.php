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
			padding: 20px;
			font-family: Arial, sans-serif;
			background: #f5f5f5;
		}
		
		.maps-container {
			max-width: 1200px;
			margin: 0 auto;
			background: white;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			overflow: hidden;
		}
		
		.maps-header {
			background: linear-gradient(135deg, #dc3545, #c82333);
			color: white;
			padding: 20px;
			text-align: center;
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
		@media (max-width: 768px) {
			body {
				padding: 10px;
			}
			
			.maps-header {
				padding: 15px;
			}
			
			.maps-title {
				font-size: 20px;
			}
			
			.maps-description {
				font-size: 14px;
			}
			
			.iframe-wrapper {
				padding-bottom: 75%; /* 4:3 aspect ratio on mobile */
			}
		}
		
		/* Fullscreen button */
		.fullscreen-btn {
			position: absolute;
			top: 10px;
			right: 10px;
			background: rgba(0,0,0,0.7);
			color: white;
			border: none;
			padding: 8px 12px;
			border-radius: 4px;
			font-size: 12px;
			cursor: pointer;
			z-index: 10;
		}
		
		.fullscreen-btn:hover {
			background: rgba(0,0,0,0.9);
		}
		
		/* Simple fullscreen modal */
		.fullscreen-modal {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0,0,0,0.95);
			z-index: 1000;
		}
		
		.fullscreen-modal.active {
			display: block;
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
			height: calc(100% - 60px);
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
			<div class="version-info">
				Version: Simple v8 | Updated: <?php echo date('Y-m-d H:i:s'); ?> | Direct load
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
		console.log('Simple Maps loaded - Version 8');
		
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