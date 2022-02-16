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
		<script src="assets/js/mm3calc.js"></script>
		<style> .navbar-dark{
		color: white;
		} </style>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

      <script>	
  $(document).ready(function() {
      $('#items-content').load("itemsCalculator.php");
      $('#map-content').load("maps.php");
      $('#notes-content').load("notes.php");
      $('#keyboard-content').load("keyboard.php");
    
      $('#map-content').hide();
      $('#notes-content').hide();
      $('#keyboard-content').hide();

      $('#btnMap').on('click', function() {
        $('#map-content').show();
        $('#items-content').hide();
        $('#notes-content').hide();
        $('#keyboard-content').hide();
      });

      $('#btnItems').on('click', function() {
        $('#map-content').hide();
        $('#items-content').show();
        $('#notes-content').hide();
        $('#keyboard-content').hide();
      });
    
      $('#btnNotes').on('click', function() {
        $('#map-content').hide();
        $('#items-content').hide();
        $('#notes-content').show();
      });
    
      $('#btnKeyboard').on('click', function() {
        $('#map-content').hide();
        $('#items-content').hide();
        $('#notes-content').hide();
        $('#keyboard-content').show();
      });
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
              <ul class="nav nav-tabs ml-auto mr-auto"> 
                  <li><button id="btnItems" type="button" class="btn-danger">Item Calculator</button></li>
                  <li><button id="btnMap" type="button" class="btn-danger">Maps</button></li>
                  <li><button id="btnNotes" type="button" class="btn-danger">Notes</button></li>
                  <li><button id="btnKeyboard" type="button" class="btn-danger">Keyboard Shortcuts</button></li>
              </ul>
					
              <div id="items-content" style="width: 100%; height: auto;"></div>
              <div id="map-content" style="width: 100%; height: auto;" ></div>
              <div id="notes-content" style="width: 100%; height: auto;" ></div>
              <div id="keyboard-content" style="width: 100%; height: auto;" ></div>
          </div>
      </section>
	</article>

      <!-- Footer -->
      <footer id="footer">
        <ul class="copyright">
          <li>&copy; <a href="http://dosgameshub.org">Dos Games Hub</a></li>
        </ul>
      </footer>
	</div>

    <!-- Scripts -->
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>