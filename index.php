<?php
include "link.php";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Isles Of Terra vCompanion</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="assets/js/custom-util.js"></script>
		<script src="assets/js/mm3calc.js"></script>
		
		<style>
			.navbar-dark {
				color: white;
			}
			
			/* Mobile-first responsive navigation */
			@media (max-width: 768px) {
				.nav-tabs {
					display: flex;
					flex-direction: column;
					gap: 10px;
					margin: 20px 0;
					padding: 0;
					list-style: none;
				}
				
				.nav-tabs li {
					width: 100%;
				}
				
				.nav-tabs button {
					width: 100% !important;
					padding: 15px 20px;
					font-size: 16px;
					border: none;
					border-radius: 8px;
					cursor: pointer;
					transition: all 0.3s ease;
					font-weight: bold;
					text-transform: uppercase;
					letter-spacing: 0.5px;
				}
				
				.btn-danger {
					background: linear-gradient(135deg, #dc3545, #c82333);
					color: white;
					box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
				}
				
				.btn-danger:hover,
				.btn-danger:focus {
					background: linear-gradient(135deg, #c82333, #a71e2a);
					transform: translateY(-2px);
					box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
				}
				
				.btn-danger:active {
					transform: translateY(0);
					box-shadow: 0 2px 10px rgba(220, 53, 69, 0.3);
				}
				
				.container {
					padding: 10px;
				}
				
				header h2 {
					font-size: 24px !important;
					text-align: center;
					margin-bottom: 10px;
				}
				
				header p {
					font-size: 16px !important;
					text-align: center;
					margin-bottom: 20px;
				}
				
				#main {
					padding: 20px 0;
				}
				
				.align-center {
					text-align: center;
				}
			}
			
			@media (min-width: 769px) {
				.nav-tabs {
					display: flex;
					flex-direction: row;
					justify-content: center;
					gap: 15px;
					margin: 30px 0;
					padding: 0;
					list-style: none;
					flex-wrap: wrap;
				}
				
				.nav-tabs li {
					flex: 0 1 auto;
				}
				
				.nav-tabs button {
					padding: 12px 25px;
					font-size: 14px;
					border: none;
					border-radius: 6px;
					cursor: pointer;
					transition: all 0.3s ease;
					font-weight: bold;
					text-transform: uppercase;
					letter-spacing: 0.5px;
					white-space: nowrap;
				}
				
				.btn-danger {
					background: linear-gradient(135deg, #dc3545, #c82333);
					color: white;
					box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
				}
				
				.btn-danger:hover,
				.btn-danger:focus {
					background: linear-gradient(135deg, #c82333, #a71e2a);
					transform: translateY(-1px);
					box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
				}
				
				.btn-danger:active {
					transform: translateY(0);
					box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
				}
				
				.container {
					max-width: 1200px;
					margin: 0 auto;
					padding: 20px;
				}
				
				header h2 {
					font-size: 32px;
					text-align: center;
					margin-bottom: 10px;
				}
				
				header p {
					font-size: 18px;
					text-align: center;
					margin-bottom: 30px;
				}
				
				#main {
					padding: 40px 0;
				}
			}
			
			/* Common styles */
			.content-container {
				min-height: 400px;
				background: rgba(255, 255, 255, 0.05);
				border-radius: 10px;
				padding: 20px;
				margin-top: 20px;
				backdrop-filter: blur(10px);
				border: 1px solid rgba(255, 255, 255, 0.1);
			}
			
			/* Loading animation */
			.loading {
				display: flex;
				justify-content: center;
				align-items: center;
				height: 200px;
				font-size: 18px;
				color: #666;
			}
			
			.loading::after {
				content: '';
				width: 20px;
				height: 20px;
				margin-left: 10px;
				border: 2px solid #f3f3f3;
				border-top: 2px solid #dc3545;
				border-radius: 50%;
				animation: spin 1s linear infinite;
			}
			
			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}
			
			/* Active button state */
			.btn-danger.active {
				background: linear-gradient(135deg, #a71e2a, #721c24);
				box-shadow: 0 2px 8px rgba(220, 53, 69, 0.5);
			}
			
			/* Footer responsive */
			#footer {
				margin-top: 40px;
				padding: 20px;
				text-align: center;
			}
			
			@media (max-width: 768px) {
				#footer {
					margin-top: 30px;
					padding: 15px;
				}
				
				#footer .copyright {
					font-size: 14px;
				}
			}
		</style>
		
		<script>	
			$(document).ready(function() {
				// Show loading state initially
				$('#items-content, #map-content, #notes-content, #keyboard-content').html('<div class="loading">Loading</div>');
				
				// Load content
				$('#items-content').load("itemsCalculator.php", function(response, status, xhr) {
					if (status == "error") {
						$(this).html('<div style="text-align: center; padding: 40px; color: #dc3545;">Error loading content: ' + xhr.status + " " + xhr.statusText + '</div>');
					}
				});
				
				$('#map-content').load("maps.php", function(response, status, xhr) {
					if (status == "error") {
						$(this).html('<div style="text-align: center; padding: 40px; color: #dc3545;">Error loading content: ' + xhr.status + " " + xhr.statusText + '</div>');
					}
				});
				
				$('#notes-content').load("notes.php", function(response, status, xhr) {
					if (status == "error") {
						$(this).html('<div style="text-align: center; padding: 40px; color: #dc3545;">Error loading content: ' + xhr.status + " " + xhr.statusText + '</div>');
					}
				});
				
				$('#keyboard-content').load("keyboard.php", function(response, status, xhr) {
					if (status == "error") {
						$(this).html('<div style="text-align: center; padding: 40px; color: #dc3545;">Error loading content: ' + xhr.status + " " + xhr.statusText + '</div>');
					}
				});
				
				// Initially show items calculator and hide others
				$('#map-content, #notes-content, #keyboard-content').hide();
				$('#items-content').show();
				
				// Add active class to first button
				$('#btnItems').addClass('active');

				// Navigation handlers
				$('#btnMap').on('click', function() {
					showContent('#map-content');
					setActiveButton(this);
				});

				$('#btnItems').on('click', function() {
					showContent('#items-content');
					setActiveButton(this);
				});
				
				$('#btnNotes').on('click', function() {
					showContent('#notes-content');
					setActiveButton(this);
				});
				
				$('#btnKeyboard').on('click', function() {
					showContent('#keyboard-content');
					setActiveButton(this);
				});
				
				function showContent(activeContent) {
					$('#map-content, #items-content, #notes-content, #keyboard-content').hide();
					$(activeContent).show();
				}
				
				function setActiveButton(activeBtn) {
					$('.nav-tabs button').removeClass('active');
					$(activeBtn).addClass('active');
				}
			});
		</script>
	</head>

	<body>
		<div id="page-wrapper">
			<article id="main">
				<header>
					<h2 style="color:white">Might and Magic III - Isles Of Terra</h2>
					<p style="color:white">Virtual Companion</p>
				</header>
							
				<section>
					<div class="container align-center">
						<h2></h2>
						<ul class="nav nav-tabs"> 
							<li><button id="btnItems" type="button" class="btn-danger">📊 Item Calculator</button></li>
							<li><button id="btnMap" type="button" class="btn-danger">🗺️ Maps</button></li>
							<li><button id="btnNotes" type="button" class="btn-danger">📝 Notes</button></li>
							<li><button id="btnKeyboard" type="button" class="btn-danger">⌨️ Keyboard Shortcuts</button></li>
						</ul>
						
						<div id="items-content" class="content-container" style="width: 100%; height: auto;"></div>
						<div id="map-content" class="content-container" style="width: 100%; height: auto;"></div>
						<div id="notes-content" class="content-container" style="width: 100%; height: auto;"></div>
						<div id="keyboard-content" class="content-container" style="width: 100%; height: auto;"></div>
					</div>
				</section>
			</article>

			<!-- Footer -->
			<footer id="footer">
				<ul class="copyright">
					<li>&copy; <a href="https://chaiware.org/">Chaiware.org</a></li>
				</ul>
			</footer>
		</div>

		<!-- Scripts -->
		<script src="assets/js/main.js"></script>
	</body>
</html>