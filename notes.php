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
				<button type="button" class="btn btn-primary" onclick="saveNotes()">💾 Save Notes</button>
				<button type="button" class="btn btn-secondary" onclick="clearNotes()">🗑️ Clear All</button>
			</div>
			
			<div class="status-message" id="statusMessage"></div>
		</div>
	</div>

	<script>
		const API_URL = 'api/notes_api.php';
		let autoSaveTimeout;
		let lastSavedContent = '';
		
		// Load notes on page load
		document.addEventListener('DOMContentLoaded', function() {
			loadNotes();
			
			// Set up auto-save on typing
			const textarea = document.getElementById('notes-textarea');
			textarea.addEventListener('input', function() {
				clearTimeout(autoSaveTimeout);
				autoSaveTimeout = setTimeout(autoSave, 2000); // Auto-save after 2 seconds of inactivity
			});
		});
		
		async function apiCall(action, data = null, method = 'GET') {
			try {
				const options = {
					method: method,
					headers: {
						'Content-Type': 'application/json',
					}
				};
				
				let url = `${API_URL}?action=${action}`;
				
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
		
		async function loadNotes() {
			try {
				const data = await apiCall('load');
				document.getElementById('notes-textarea').value = data.content || '';
				lastSavedContent = data.content || '';
			} catch (error) {
				showStatus('Failed to load notes: ' + error.message, 'error');
			}
		}
		
		async function saveNotes() {
			const content = document.getElementById('notes-textarea').value;
			
			try {
				await apiCall('save', { content }, 'POST');
				lastSavedContent = content;
				showStatus('Notes saved successfully!', 'success');
			} catch (error) {
				showStatus('Failed to save notes: ' + error.message, 'error');
			}
		}
		
		async function autoSave() {
			const content = document.getElementById('notes-textarea').value;
			
			// Only auto-save if content has changed
			if (content === lastSavedContent) {
				return;
			}
			
			try {
				showAutoSaveIndicator();
				await apiCall('save', { content }, 'POST');
				lastSavedContent = content;
				hideAutoSaveIndicator();
			} catch (error) {
				console.error('Auto-save failed:', error);
				hideAutoSaveIndicator();
			}
		}
		
		function clearNotes() {
			if (confirm('Are you sure you want to clear all notes? This cannot be undone.')) {
				document.getElementById('notes-textarea').value = '';
				saveNotes();
			}
		}
		
		function showStatus(message, type) {
			const statusEl = document.getElementById('statusMessage');
			statusEl.textContent = message;
			statusEl.className = `status-message status-${type}`;
			statusEl.style.display = 'block';
			
			setTimeout(() => {
				statusEl.style.display = 'none';
			}, 3000);
		}
		
		function showAutoSaveIndicator() {
			document.getElementById('autoSaveIndicator').classList.add('show');
		}
		
		function hideAutoSaveIndicator() {
			setTimeout(() => {
				document.getElementById('autoSaveIndicator').classList.remove('show');
			}, 1000);
		}
		
		// Save before leaving page
		window.addEventListener('beforeunload', function(e) {
			const content = document.getElementById('notes-textarea').value;
			if (content !== lastSavedContent) {
				// Attempt to save (may not complete due to page unload)
				navigator.sendBeacon(`${API_URL}?action=save`, JSON.stringify({ content }));
			}
		});
	</script>
</body>
</html>