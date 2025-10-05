<?php
require_once 'api/auth.php';
include "link.php";
include 'includes/header_unified.php';

// Require authentication for notes
$auth = $mm3Auth->requireAuth();
$userId = $auth['user_id'];
$username = $auth['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MM3 Notes</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Open Sans', Helvetica, sans-serif;
            line-height: 1.6;
            color: #e0e0e0;
            background: #2e3842;
            padding: 0;
            margin: 0;
        }
        .note {
            background: #3a4652;
            border: 1px solid #4a5664;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
            color: #e0e0e0;
        }
        
        .notes-container {
            background: #3a4652;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            overflow: hidden;
            margin: 20px auto;
            max-width: 1200px;
        }
        
        .notes-header {
            background: #2a3540;
            color: #e0e0e0;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #4a5664;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .note-title {
            font-size: 1.2em;
            font-weight: 500;
            margin-bottom: 10px;
            color: #4a9cff;     
        }
        .btn-primary {
            background-color: #4a9cff;
            background-image: linear-gradient(to bottom, #4a9cff, #3a8aee);
            color: white;
            border: 1px solid #3a8aee;
        }
        
        .notes-content {
            padding: 20px;
        }
{{ ... }}
	</style>
</head>

<body>
    <div class="content-wrapper">
        <div class="notes-container">
            <div class="notes-content">
                <div class="form-group">
                    <label for="notes-textarea">Your Notes:</label>
                    <textarea id="notes-textarea" class="form-control" rows="20" placeholder="Type your notes here..."></textarea>
                </div>
                
                <div class="button-group" style="margin-top: 15px; display: flex; gap: 10px;">
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