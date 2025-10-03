<?php
require_once 'api/auth.php';
include "link.php";

// Require authentication for notes
$auth = $mm3Auth->requireAuth();
$userId = $auth['user_id'];
$username = $auth['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MM3 Notes</title>
	
	<style>
		* {
			box-sizing: border-box;
		}
		
		body {
			margin: 0;
			padding: 20px;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
		}
		
		.notes-container {
			max-width: 1200px;
			margin: 0 auto;
			background: rgba(255, 255, 255, 0.95);
			border-radius: 15px;
			box-shadow: 0 8px 32px rgba(0,0,0,0.15);
			overflow: hidden;
			backdrop-filter: blur(10px);
		}
		
		.notes-header {
			background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
			color: white;
			padding: 20px;
			text-align: center;
		}
		
		.notes-title {
			margin: 0 0 10px 0;
			font-size: 24px;
			font-weight: bold;
		}
		
		.user-info {
			font-size: 14px;
			opacity: 0.9;
		}
		
		.notes-content {
			padding: 20px;
		}
		
		.form-group {
			margin-bottom: 20px;
		}
		
		.form-group label {
			display: block;
			margin-bottom: 8px;
			font-weight: 600;
			color: #333;
		}
		
		#notes-textarea {
			width: 100%;
			min-height: 400px;
			padding: 15px;
			border: 2px solid #e0e0e0;
			border-radius: 8px;
			font-family: 'Consolas', 'Monaco', monospace;
			font-size: 14px;
			line-height: 1.5;
			resize: vertical;
			transition: border-color 0.3s ease;
		}
		
		#notes-textarea:focus {
			outline: none;
			border-color: #667eea;
			box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
		}
		
		.button-group {
			display: flex;
			gap: 10px;
			justify-content: center;
			flex-wrap: wrap;
		}
		
		.btn {
			padding: 12px 24px;
			border: none;
			border-radius: 6px;
			font-size: 16px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			min-width: 120px;
		}
		
		.btn-primary {
			background: linear-gradient(135deg, #667eea, #764ba2);
			color: white;
		}
		
		.btn-primary:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
		}
		
		.btn-secondary {
			background: #6c757d;
			color: white;
		}
		
		.btn-secondary:hover {
			background: #5a6268;
			transform: translateY(-2px);
		}
		
		.status-message {
			margin-top: 15px;
			padding: 12px;
			border-radius: 6px;
			text-align: center;
			font-weight: 600;
			display: none;
		}
		
		.status-success {
			background: #d4edda;
			color: #155724;
			border: 1px solid #c3e6cb;
		}
		
		.status-error {
			background: #f8d7da;
			color: #721c24;
			border: 1px solid #f5c6cb;
		}
		
		.auto-save-indicator {
			position: fixed;
			top: 20px;
			right: 20px;
			background: rgba(0, 0, 0, 0.8);
			color: white;
			padding: 8px 16px;
			border-radius: 20px;
			font-size: 12px;
			z-index: 1000;
			opacity: 0;
			transition: opacity 0.3s ease;
		}
		
		.auto-save-indicator.show {
			opacity: 1;
		}
		
		@media (max-width: 768px) {
			body {
				padding: 10px;
			}
			
			.notes-container {
				border-radius: 10px;
			}
			
			.notes-header {
				padding: 15px;
			}
			
			.notes-title {
				font-size: 20px;
			}
			
			.notes-content {
				padding: 15px;
			}
			
			#notes-textarea {
				min-height: 300px;
				font-size: 16px; /* Prevent zoom on iOS */
			}
			
			.button-group {
				flex-direction: column;
			}
			
			.btn {
				width: 100%;
			}
		}
	</style>
</head>

<body>
	<div class="auto-save-indicator" id="autoSaveIndicator">Auto-saving...</div>
	
	<div class="notes-container">
		<div class="notes-header">
			<div class="notes-title">📝 Game Notes</div>
			<div class="user-info">Logged in as: <?= htmlspecialchars($username) ?></div>
		</div>
		
		<div class="notes-content">
			<div class="form-group">
				<label for="notes-textarea">Your Notes:</label>
				<textarea id="notes-textarea" placeholder="Write your game notes, strategies, and important information here..."></textarea>
			</div>
			
			<div class="button-group">
				<button type="button" id="saveNotesBtn" class="btn btn-primary">💾 Save Notes</button>
				<button type="button" id="clearNotesBtn" class="btn btn-secondary">🗑️ Clear All</button>
			</div>
			
			<div class="status-message" id="statusMessage"></div>
		</div>
	</div>
	<!-- Include jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		const API_URL = 'api/notes_api.php';
		let lastSavedContent = '';
		
		// Function to show status messages
		function showStatus(message, type) {
			const $statusEl = $('#statusMessage');
			$statusEl.text(message)
				.removeClass('status-success status-error')
				.addClass('status-' + type)
				.fadeIn();
			
			setTimeout(() => {
				$statusEl.fadeOut();
			}, 3000);
		}

		// Function to show auto-save indicator
		function showAutoSaveIndicator() {
			$('#autoSaveIndicator').addClass('show');
		}

		// Function to hide auto-save indicator
		function hideAutoSaveIndicator() {
			setTimeout(() => {
				$('#autoSaveIndicator').removeClass('show');
			}, 1000);
		}

		// Function to load notes
		async function loadNotes() {
			try {
				console.log('Loading notes...');
				const response = await $.ajax({
					url: API_URL,
					data: { action: 'load' },
					dataType: 'json',
					xhrFields: {
						withCredentials: true
					}
				});
				
				console.log('Load response:', response);
				
				if (response.success && response.data) {
					const content = response.data.content || '';
					$('#notes-textarea').val(content);
					lastSavedContent = content;
					console.log('Notes loaded successfully');
				} else {
					throw new Error(response.error || 'No data returned from server');
				}
			} catch (error) {
				console.error('Error loading notes:', error);
				showStatus('Failed to load notes: ' + error.message, 'error');
			}
		}

		// Function to save notes
		async function saveNotes() {
			const content = $('#notes-textarea').val();
			
			try {
				console.log('Saving notes...');
				const response = await $.ajax({
					url: `${API_URL}?action=save`,
					method: 'POST',
					data: JSON.stringify({ content: content }),
					contentType: 'application/json',
					dataType: 'json',
					xhrFields: {
						withCredentials: true
					}
				});
				
				console.log('Save response:', response);
				
				if (response.success) {
					lastSavedContent = content;
					showStatus('Notes saved successfully!', 'success');
				} else {
					throw new Error(response.error || 'Failed to save notes');
				}
			} catch (error) {
				console.error('Error saving notes:', error);
				showStatus('Failed to save notes: ' + error.message, 'error');
			}
		}

		// Function to clear notes
		function clearNotes() {
			if (confirm('Are you sure you want to clear all notes? This cannot be undone.')) {
				$('#notes-textarea').val('');
				saveNotes();
			}
		}

		// Document ready handler
		$(document).ready(function() {
			// Load notes when the page loads
			loadNotes();
			
			// Set up event listeners
			$('#saveNotesBtn').on('click', saveNotes);
			$('#clearNotesBtn').on('click', clearNotes);
			
			// Warn before leaving page if there are unsaved changes
			$(window).on('beforeunload', function(e) {
				const content = $('#notes-textarea').val();
				if (content !== lastSavedContent) {
					e.preventDefault();
					e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
					return e.returnValue;
				}
			});
		});
	</script>
</body>