</main>
    
    <footer class="app-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3 class="footer-title">⚔️ MM3 Virtual Companion</h3>
                <p class="footer-description">
                    Your complete toolkit for Might and Magic III: Isles of Terra
                </p>
            </div>
            
            <div class="footer-section">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="tracker.php">Progress Tracker</a></li>
                    <li><a href="itemsCalculator.php">Items Calculator</a></li>
                    <li><a href="guide.php">Guide & Tips</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4 class="footer-heading">Resources</h4>
                <ul class="footer-links">
                    <li><a href="maps.php">Maps Gallery</a></li>
                    <li><a href="keyboard.php">Keyboard Shortcuts</a></li>
                    <li><a href="notes.php">Personal Notes</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4 class="footer-heading">About</h4>
                <p class="footer-text">
                    This is a fan-made companion app for Might and Magic III: Isles of Terra. 
                    All game content is property of their respective owners.
                </p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> MM3 Virtual Companion. Created for fans by fans.</p>
        </div>
    </footer>
    
    <style>
        /* Footer Styles */
        .app-footer {
            background: linear-gradient(135deg, #0f3460 0%, #16213e 100%);
            color: rgba(255, 255, 255, 0.9);
            margin-top: 60px;
            border-top: 3px solid #e94560;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.3);
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 20px 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }
        
        .footer-section {
            color: rgba(255, 255, 255, 0.9);
        }
        
        .footer-title {
            font-size: 1.8em;
            font-weight: 800;
            color: #fff;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(233, 69, 96, 0.3);
            letter-spacing: 1px;
        }
        
        .footer-description {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            font-size: 1.05em;
        }
        
        .footer-heading {
            font-size: 1.3em;
            font-weight: 600;
            color: #e94560;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            padding: 5px 0;
            font-size: 1.05em;
        }
        
        .footer-links a:hover {
            color: #e94560;
            transform: translateX(5px);
        }
        
        .footer-text {
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.6;
            font-size: 0.95em;
        }
        
        .footer-bottom {
            background: rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .footer-bottom p {
            margin: 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95em;
            letter-spacing: 0.5px;
        }
        
        /* Responsive Footer */
        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 40px 20px 20px;
            }
            
            .footer-section {
                text-align: center;
            }
            
            .footer-title {
                font-size: 1.5em;
            }
            
            .footer-heading {
                font-size: 1.2em;
            }
            
            .footer-links a:hover {
                transform: none;
            }
        }
    </style>
    
    <script>
        // Highlight active page in footer links too
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop() || 'index.php';
            const footerLinks = document.querySelectorAll('.footer-links a');
            
            footerLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href === currentPage || (currentPage === 'index.php' && href === 'index.php')) {
                    link.style.color = '#e94560';
                    link.style.fontWeight = '600';
                }
            });
        });
    </script>
</body>
</html>