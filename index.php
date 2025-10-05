<?php
// index.php - Main page with authentication
require_once 'api/auth.php';

// Check if user is logged in
$auth = $mm3Auth->requireAuth();
$isLoggedIn = true;
$username = $auth['username'];

include "link.php";

?>

<div class="app-content">
    <div id="items-content" class="content-container">
        <?php include 'itemsCalculator.php'; ?>
    </div>
</div>

<script src="assets/js/custom-util.js"></script>
<script src="assets/js/mm3calc.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>