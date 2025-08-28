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
		/* Simple, working responsive styles */
		body {
			margin: 0;
			padding: 20px;
			font-family: Arial, sans-serif;
			background: #f5f5f5;
		}
		
		.notes-container {
			max-width: 1200px;
			margin: 0 auto;
			background: white;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			overflow: hidden;
		}
		
		.notes-header {
			background: linear-gradient(135deg, #dc3545, #c82333);
			color: white;
			padding: 20px;
			text-align: center;
		}
		
		.notes-title {
			margin: 0 0 10px 0;
			font-size: 24px;
			font-weight: bold;
		}
		
		.notes-description {
			margin: 0;
			opacity: 0.9;
			font-size: 16px;
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
			
			.notes-header {
				padding: 15px;
			}
			
			.notes-title {
				font-size: 20px;
			}
			
			.notes-description {
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