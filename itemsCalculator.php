<?php
require_once 'api/auth.php';

// Require authentication for calculator
$auth = $mm3Auth->requireAuth();
$userId = $auth['user_id'];
$username = $auth['username'];
$page_title = 'Items Calculator - MM3 Virtual Companion';

include 'includes/header_unified.php';
?>

<main class="main-content">
<style>
/* Mobile-first responsive styles */
@media (max-width: 768px) {
    .form-row {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
        width: 100%;
        padding: 0;
    }
    
    .form-group {
        width: 100%;
    }
    
    .form-row select,
    .form-row input {
        width: 100%;
        padding: 15px 12px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        margin: 0;
        height: auto;
        min-height: 50px;
        line-height: 1.4;
        vertical-align: top;
    }
    
    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin: 20px 0 10px 0;
        color: white;
        text-align: center;
    }
    
    .reset-btn {
        width: 100%;
        padding: 15px;
        margin-top: 25px;
        font-size: 18px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        box-sizing: border-box;
    }
    
    .reset-btn:hover {
        background-color: #c82333;
    }
}

@media (min-width: 769px) {
    .form-row {
        display: grid;
        gap: 15px;
        margin-bottom: 20px;
        align-items: center;
    }
    
    .weapon-row {
        grid-template-columns: 2fr 2fr 2fr 1fr 2fr 1fr;
    }
    
    .armor-row {
        grid-template-columns: 2fr 2fr 2fr 1fr;
    }
    
    .item-row {
        grid-template-columns: 2fr 2fr 2fr 1fr;
    }
    
    .form-group {
        width: 100%;
    }
    
    .form-row select,
    .form-row input {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    
    .section-title {
        font-size: 20px;
        font-weight: bold;
        margin: 25px 0 15px 0;
        color: white;
        text-align: left;
    }
    
    .reset-btn {
        width: auto;
        padding: 10px 20px;
        margin-top: 20px;
        font-size: 14px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .reset-btn:hover {
        background-color: #c82333;
    }
}

.calculator-header {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 20px 15px;
    text-align: center;
    width: 100%;
    box-sizing: border-box;
    border-radius: 4px;
    margin-bottom: 20px;
}

.calculator-title {
    margin: 0 0 15px 0;
    font-size: 28px;
    font-weight: 800;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    letter-spacing: 0.5px;
}

.calculator-description {
    margin: 0;
    opacity: 0.95;
    font-size: 16px;
    line-height: 1.5;
    font-weight: 300;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.form-row select:focus,
.form-row input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}

.readonly-input {
    background-color: #f8f9fa;
    cursor: default;
}

select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=US-ASCII,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'><path fill='%23333' d='M2 0L0 2h4zm0 5L0 3h4z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 12px;
    padding-right: 30px;
}

@media (max-width: 768px) {
    select, input[type="text"] {
        height: 50px !important;
        min-height: 50px !important;
        padding: 12px !important;
        box-sizing: border-box !important;
        vertical-align: middle !important;
        line-height: 1.5 !important;
        display: block !important;
        width: 100% !important;
    }
}
</style>

<div class="calculator-header">
    <h1 class="calculator-title">⚔️ Items Calculator</h1>
    <p class="calculator-description">
        Calculate weapon damage, armor protection, and item stats for Might and Magic III - Isles of Terra
    </p>
</div>

<div class="container">
    <form method="post" action="#">
        <!-- WEAPONS SECTION -->
        <div class="section-title">⚔️ WEAPONS</div>
        <div class="form-row weapon-row">
            <div class="form-group">            
                <select id="weaponId" onchange="changeInWeaponValue()">
                    <option value="0" data-hands="0" data-usable-by="">Weapon</option>
                    <!-- Add your weapon options here -->
                </select>
            </div>
            <!-- Add all other weapon fields -->
        </div>
        
        <!-- ARMOR SECTION -->
        <div class="section-title">🛡️ ARMOR</div>
        <div class="form-row armor-row">
            <div class="form-group">            
                <select id="armorId" onchange="changeInArmorValue()">
                    <option value="0">Armor</option>
                    <!-- Add your armor options here -->
                </select>
            </div>
            <!-- Add all other armor fields -->
        </div>
        
        <!-- ITEMS SECTION -->
        <div class="section-title">💎 ITEMS</div>
        <div class="form-row item-row">
            <div class="form-group">            
                <select id="itemId" onchange="changeInItemValue()">
                    <option value="0">Item</option>
                    <!-- Add your item options here -->
                </select>
            </div>
            <!-- Add all other item fields -->
        </div>
        
        <div class="form-group">
            <input type="reset" value="Reset" class="reset-btn" />
        </div>
    </form>
</div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="assets/js/mm3calc.js?v=2"></script>