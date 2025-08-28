<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>Keyboard Shortcuts</title>
	
	<style>
		/* Simple, working responsive styles */
		body {
			margin: 0;
			padding: 20px;
			font-family: Arial, sans-serif;
			background: #f5f5f5;
		}
		
		.keyboard-container {
			max-width: 1000px;
			margin: 0 auto;
			background: white;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0,0,0,0.1);
			overflow: hidden;
		}
		
		.keyboard-header {
			background: linear-gradient(135deg, #dc3545, #c82333);
			color: white;
			padding: 20px;
			text-align: center;
		}
		
		.keyboard-title {
			margin: 0 0 10px 0;
			font-size: 24px;
			font-weight: bold;
		}
		
		.keyboard-description {
			margin: 0;
			opacity: 0.9;
			font-size: 16px;
		}
				
		/* Simple image container */
		.image-container {
			padding: 20px;
			text-align: center;
			background: #f8f9fa;
		}
		
		.keyboard-image {
			max-width: 100%;
			height: auto;
			border-radius: 8px;
			box-shadow: 0 4px 15px rgba(0,0,0,0.15);
			border: 2px solid #dee2e6;
			cursor: zoom-in;
			transition: transform 0.3s ease;
		}
		
		.keyboard-image:hover {
			transform: scale(1.02);
		}
		
		/* Mobile adjustments */
		@media (max-width: 768px) {
			body {
				padding: 10px;
			}
			
			.keyboard-header {
				padding: 15px;
			}
			
			.keyboard-title {
				font-size: 20px;
			}
			
			.keyboard-description {
				font-size: 14px;
			}
			
			.image-container {
				padding: 15px;
			}
			
			.keyboard-image:hover {
				transform: none; /* Disable hover zoom on mobile */
			}
		}
		
		/* Simple zoom modal */
		.zoom-modal {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0,0,0,0.9);
			z-index: 1000;
			cursor: zoom-out;
		}
		
		.zoom-modal.active {
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}
		
		.zoom-image {
			max-width: 95%;
			max-height: 95%;
			object-fit: contain;
			border-radius: 8px;
		}
		
		.zoom-close {
			position: absolute;
			top: 20px;
			right: 30px;
			color: white;
			font-size: 40px;
			cursor: pointer;
			background: rgba(0,0,0,0.5);
			border-radius: 50%;
			width: 60px;
			height: 60px;
			display: flex;
			align-items: center;
			justify-content: center;
			border: none;
		}
		
		.zoom-close:hover {
			background: rgba(0,0,0,0.7);
		}
		
		/* Error state */
		.error-message {
			text-align: center;
			padding: 40px;
			color: #dc3545;
			background: #f8d7da;
			border: 2px dashed #dc3545;
			border-radius: 8px;
			margin: 20px;
		}
		
		.error-icon {
			font-size: 48px;
			margin-bottom: 15px;
		}
	</style>
</head>

<body>
	<div class="keyboard-container">
		<div class="keyboard-header">
			<div class="keyboard-title">⌨️ Keyboard Shortcuts</div>
			<div class="keyboard-description">
				Click on the image to zoom in and see all the keyboard shortcuts for Might and Magic III - Isles Of Terra
			</div>
		</div>
		
		<div class="image-container">
			<img 
				src="keyboard_shortcuts.png" 
				alt="Might and Magic III - Keyboard Shortcuts" 
				class="keyboard-image"
				onclick="openZoom(this.src)"
				onerror="showError()"
			>
		</div>
	</div>
	
	<!-- Zoom modal -->
	<div class="zoom-modal" id="zoomModal" onclick="closeZoom()">
		<button class="zoom-close" onclick="closeZoom()">&times;</button>
		<img class="zoom-image" id="zoomImage" src="" alt="Keyboard Shortcuts - Zoomed">
	</div>

	<script>
		console.log('Simple Keyboard loaded - Version 7');
		
		function openZoom(imageSrc) {
			const modal = document.getElementById('zoomModal');
			const zoomImg = document.getElementById('zoomImage');
			
			zoomImg.src = imageSrc;
			modal.classList.add('active');
			document.body.style.overflow = 'hidden';
		}
		
		function closeZoom() {
			const modal = document.getElementById('zoomModal');
			modal.classList.remove('active');
			document.body.style.overflow = 'auto';
		}
		
		function showError() {
			const container = document.querySelector('.image-container');
			container.innerHTML = `
				<div class="error-message">
					<div class="error-icon">📷</div>
					<div><strong>Image not found</strong></div>
					<div>keyboard_shortcuts.png could not be loaded</div>
					<div style="margin-top: 15px; font-size: 14px; opacity: 0.8;">
						Please make sure the image file exists in the same directory
					</div>
				</div>
			`;
		}
		
		// Close with Escape key
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape') {
				closeZoom();
			}
		});
	</script>
</body>
</html>