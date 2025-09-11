<?php
// index.php - Main page with authentication
require_once 'api/auth.php';

// Check if user is logged in
$auth = $mm3Auth->checkAuth();
$isLoggedIn = $auth['logged_in'];
$username = $isLoggedIn ? $auth['username'] : '';

// If not logged in, redirect to login page
if (!$isLoggedIn) {
    header('Location: login.php');
    exit;
}

include "link.php";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Isles Of Terra vCompanion</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/minimal.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="assets/js/custom-util.js"></script>
		<script src="assets/js/mm3calc.js"></script>
		
		<style>
			.navbar-dark {
				color: white;
			}
			
			/* User info bar */
			.user-bar {
				position: fixed;
				top: 0;
				right: 0;
				background: rgba(0, 0, 0, 0.8);
				color: white;
				padding: 10px 20px;
				border-radius: 0 0 0 10px;
				z-index: 1000;
				font-size: 14px;
			}
			
			/* Fix page wrapper to account for user bar */
			#page-wrapper {
				padding-top: 60px; /* Add space for user bar */
			}
			
			/* Beautiful header styling */
			#main > header {
				background: linear-gradient(135deg, rgba(44, 62, 80, 0.95) 0%, rgba(52, 73, 94, 0.95) 100%), 
				           url('images/banner.jpg') center center / cover;
				padding: 60px 20px;
				text-align: center;
				position: relative;
				margin-bottom: 0;
				box-shadow: 0 4px 20px rgba(0,0,0,0.3);
			}
			
			#main > header::before {
				content: '';
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background: linear-gradient(135deg, rgba(44, 62, 80, 0.8) 0%, rgba(52, 73, 94, 0.6) 100%);
				z-index: 1;
			}
			
			#main > header h2 {
				position: relative;
				z-index: 2;
				font-size: 2.5em;
				font-weight: 800;
				text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
				margin-bottom: 15px;
				letter-spacing: 2px;
				text-transform: uppercase;
			}
			
			#main > header p {
				position: relative;
				z-index: 2;
				font-size: 1.3em;
				opacity: 0.9;
				text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
				font-weight: 300;
				letter-spacing: 1px;
			}
			
			.user-bar a {
				color: #dc3545;
				text-decoration: none;
				margin-left: 10px;
				font-weight: bold;
			}
			
			.user-bar a:hover {
				text-decoration: underline;
			}
			
			/* Mobile-first responsive navigation */
			@media (max-width: 768px) {
				.user-bar {
					position: relative;
					top: auto;
					right: auto;
					border-radius: 0;
					text-align: center;
					margin-bottom: 20px;
				}
				
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
			
			.btn-danger.active {
				background: linear-gradient(135deg, #a71e2a, #721c24);
				box-shadow: 0 2px 8px rgba(220, 53, 69, 0.5);
			}
			
			.btn-danger:disabled {
				opacity: 0.6;
				cursor: not-allowed;
			}
			
			/* Content container */
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
		</style>
		
		<script>	
			$(document).ready(function() {
				// Track which content has been loaded
				var loadedContent = {
					items: false,
					map: false,
					notes: false,
					keyboard: false,
					tracker: false
				};
				
				// Track if a request is in progress
				var loadingInProgress = false;
				
				// Delay between requests in milliseconds
				var REQUEST_DELAY = 300;
				
				// Function to load content with rate limiting
				function loadContent(contentId, phpFile, contentKey) {
					// Check if already loaded
					if (loadedContent[contentKey]) {
						return Promise.resolve();
					}
					
					// Check if another request is in progress
					if (loadingInProgress) {
						// Wait and retry
						return new Promise((resolve) => {
							setTimeout(() => {
								loadContent(contentId, phpFile, contentKey).then(resolve);
							}, REQUEST_DELAY);
						});
					}
					
					// Set loading flag
					loadingInProgress = true;
					$(contentId).html('<div class="loading">Loading</div>');
					
					// Return a promise for the load operation
					return new Promise((resolve, reject) => {
						// Add slight delay to prevent rapid-fire requests
						setTimeout(() => {
							$(contentId).load(phpFile, function(response, status, xhr) {
								loadingInProgress = false;
								
								if (status == "error") {
									$(this).html('<div style="text-align: center; padding: 40px; color: #dc3545;">Error loading content: ' + xhr.status + " " + xhr.statusText + '</div>');
									reject(xhr);
								} else {
									loadedContent[contentKey] = true;
									resolve();
								}
							});
						}, REQUEST_DELAY);
					});
				}
				
				// Initialize empty containers
				$('#items-content, #map-content, #notes-content, #keyboard-content, #tracker-content')
					.html('<div style="text-align: center; padding: 40px; color: #666;">Click to load content</div>');
				
				// Initially show items container (but don't load content yet)
				$('#map-content, #notes-content, #keyboard-content, #tracker-content').hide();
				$('#items-content').show();
				
				// Load items calculator on page load (only this one)
				loadContent('#items-content', 'itemsCalculator.php', 'items');
				
				// Add active class to first button
				$('#btnItems').addClass('active');

				// Navigation handlers - load on demand
				$('#btnMap').on('click', function() {
					var btn = this;
					$(btn).prop('disabled', true);
					
					loadContent('#map-content', 'maps.php', 'map').then(() => {
						showContent('#map-content');
						setActiveButton(btn);
						$(btn).prop('disabled', false);
					}).catch(() => {
						$(btn).prop('disabled', false);
					});
				});

				$('#btnItems').on('click', function() {
					var btn = this;
					$(btn).prop('disabled', true);
					
					loadContent('#items-content', 'itemsCalculator.php', 'items').then(() => {
						showContent('#items-content');
						setActiveButton(btn);
						$(btn).prop('disabled', false);
					}).catch(() => {
						$(btn).prop('disabled', false);
					});
				});
				
				$('#btnNotes').on('click', function() {
					var btn = this;
					$(btn).prop('disabled', true);
					
					loadContent('#notes-content', 'notes.php', 'notes').then(() => {
						showContent('#notes-content');
						setActiveButton(btn);
						$(btn).prop('disabled', false);
					}).catch(() => {
						$(btn).prop('disabled', false);
					});
				});
				
				$('#btnKeyboard').on('click', function() {
					var btn = this;
					$(btn).prop('disabled', true);
					
					loadContent('#keyboard-content', 'keyboard.php', 'keyboard').then(() => {
						showContent('#keyboard-content');
						setActiveButton(btn);
						$(btn).prop('disabled', false);
					}).catch(() => {
						$(btn).prop('disabled', false);
					});
				});
				
				$('#btnTracker').on('click', function() {
					var btn = this;
					$(btn).prop('disabled', true);
					
					loadContent('#tracker-content', 'tracker.php', 'tracker').then(() => {
						showContent('#tracker-content');
						setActiveButton(btn);
						$(btn).prop('disabled', false);
					}).catch(() => {
						$(btn).prop('disabled', false);
					});
				});
				
				function showContent(activeContent) {
					$('#map-content, #items-content, #notes-content, #keyboard-content, #tracker-content').hide();
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
		<!-- User Authentication Bar -->
		<div class="user-bar">
			Welcome, <?= htmlspecialchars($username) ?>
			<a href="login.php?action=logout">Logout</a>
		</div>

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
							<li><button id="btnTracker" type="button" class="btn-danger">✅ Progress Tracker</button></li>
						</ul>
						
						<div id="items-content" class="content-container" style="width: 100%; height: auto;"></div>
						<div id="map-content" class="content-container" style="width: 100%; height: auto;"></div>
						<div id="notes-content" class="content-container" style="width: 100%; height: auto;"></div>
						<div id="keyboard-content" class="content-container" style="width: 100%; height: auto;"></div>
						<div id="tracker-content" class="content-container" style="width: 100%; height: auto;"></div>
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