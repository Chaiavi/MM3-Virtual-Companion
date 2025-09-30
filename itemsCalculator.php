<?php
include "link.php";
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/minimal.css" />
	<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	<script src="assets/js/mm3calc.js"></script>
	<title>Items Calculator</title>
	
	<style>
		/* Mobile-first responsive styles - Enhanced for full width */
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
				font-size: 16px; /* Prevents zoom on iOS */
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
				grid-template-columns: 2fr 2fr 1fr;
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
		
		/* Header styles */
		.calculator-container {
			width: 100%;
			margin: 0;
			padding: 0;
		}
		
		.calculator-header {
			background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
			color: white;
			padding: 20px 15px;
			text-align: center;
			width: 100%;
			box-sizing: border-box;
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
		
		/* Common styles */
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
		
		/* Improve select dropdown appearance on mobile */
		select {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			background-image: url("data:image/svg+xml;charset=US-ASCII,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'><path fill='%23333' d='M2 0L0 2h4zm0 5L0 3h4z'/></svg>");
			background-repeat: no-repeat;
			background-position: right 10px center;
			background-size: 12px;
			padding-right: 30px;
			height: auto;
			min-height: 50px;
			line-height: 1.4;
		}
		
		/* Mobile specific fixes */
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
			
			.readonly-input {
				height: 50px !important;
				padding: 12px !important;
				line-height: 1.5 !important;
			}
		}
	</style>
</head>

<body>
	<div id="page-wrapper">
		<div class="calculator-container">
			<div class="calculator-header">
				<h1 class="calculator-title">⚔️ Items Calculator</h1>
				<p class="calculator-description">
					Calculate weapon damage, armor protection, and item stats for Might and Magic III - Isles of Terra
				</p>
			</div>
		</div>
		
		<div class="container">   	  
			<section class="wrapper style5">
				<form method="post" action="#">

					<!-- WEAPONS SECTION -->
					<div class="section-title">⚔️ WEAPONS</div>
					<div class="form-row weapon-row">         
						<div class="form-group">            
							<select id="weaponId" onchange="changeInWeaponValue()">
								<option value="0" data-hands="0" data-usable-by="">Weapon</option>
								<option value="10" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Ra">Bardiche</option>
								<option value="9" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ba, Ra">Battle Axe</option>
								<option value="8" data-hands="1" data-usable-by="Kn, Pa, Ar, Ro, Ra">Broad Sword</option>
								<option value="2" data-hands="1" data-usable-by="All">Club</option>
								<option value="6" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Ra">Crossbow</option>
								<option value="4" data-hands="1" data-usable-by="Kn, Pa, Ar, Cl, Ro, Ni, Ba, Dr, Ra">Cudgel</option>
								<option value="5" data-hands="1" data-usable-by="Kn, Pa, Ar, Ro, Ra">Cutlass</option>
								<option value="3" data-hands="1" data-usable-by="Kn, Pa, Ar, So, Ro, Ni, Ba, Dr, Ra">Dagger</option>
								<option value="6" data-hands="1" data-usable-by="Kn, Pa, Ar, Cl, Ro, Ni, Ba, Dr, Ra">Flail</option>
								<option value="12" data-hands="2" data-usable-by="Kn, Pa, Ar, Ra">Flamberge</option>
								<option value="8" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Ra">Glaive</option>
								<option value="11" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ba, Ra">Grand Axe</option>
								<option value="12" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ba, Ra">Great Axe</option>
								<option value="11" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Ra">Halberd</option>
								<option value="6" data-hands="2" data-usable-by="Kn, Pa, Ar, Cl, Ro, Ni, Ba, Dr, Ra">Hammer</option>
								<option value="4" data-hands="1" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Dr, Ra">Hand Axe</option>
								<option value="8" data-hands="1" data-usable-by="Kn, Pa, Ni">Katana</option>
								<option value="8" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Ra">Long Bow</option>
								<option value="6" data-hands="1" data-usable-by="Kn, Pa, Ar, Ro, Ra">Long Sword</option>
								<option value="5" data-hands="1" data-usable-by="Kn, Pa, Ar, Cl, Ro, Ni, Ba, Dr, Ra">Mace</option>
								<option value="5" data-hands="1" data-usable-by="Kn, Pa, Ar, Cl, Ro, Ni, Ba, Dr, Ra">Maul</option>
								<option value="10" data-hands="2" data-usable-by="Kn, Pa, Ni">Naginata</option>
								<option value="4" data-hands="1" data-usable-by="Kn, Pa, Ni">Nunchakas</option>
								<option value="9" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Ra">Pike</option>
								<option value="6" data-hands="1" data-usable-by="Kn, Pa, Ar, Ro, Ra">Rapier</option>
								<option value="6" data-hands="1" data-usable-by="Kn, Pa, Ar, Ro, Ra">Sabre</option>
								<option value="6" data-hands="1" data-usable-by="Kn, Pa, Ar, Ro, Ra">Scimitar</option>
								<option value="5" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Ra">Short Bow</option>
								<option value="4" data-hands="1" data-usable-by="Kn, Pa, Ar, Ro, Ra">Short Sword</option>
								<option value="3" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Ra">Sling</option>
								<option value="5" data-hands="1" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Dr, Ra">Spear</option>
								<option value="5" data-hands="2" data-usable-by="All">Staff</option>
								<option value="7" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ni, Ba, Ra">Trident</option>
								<option value="6" data-hands="1" data-usable-by="Kn, Pa, Ni">Wakazashi</option>
								<option value="9" data-hands="2" data-usable-by="Kn, Pa, Ar, Ro, Ba, Ra">War Axe</option>
							</select>
						</div>

						<div class="form-group">
							<select id="weaponSpecialId" onchange="changeInWeaponValue()">
								<option value="0">Special Property</option>
								<option value="5">Acidic</option>
								<option value="26">Blazing</option>
								<option value="3">Burning</option>
								<option value="15">Cold</option>
								<option value="26">Cryo</option>
								<option value="6">Dense</option>
								<option value="26">Dyna</option>
								<option value="30">Ectoplasmic</option>
								<option value="20">Electric</option>
								<option value="5">Fiery</option>
								<option value="14">Flaming</option>
								<option value="8">Flashing</option>
								<option value="3">Flickering</option>
								<option value="9">Freezing</option>
								<option value="7">Frost</option>
								<option value="8">Fuming</option>
								<option value="3">Glowing</option>
								<option value="3">Icy</option>
								<option value="5">Incandescent</option>
								<option value="36">Kinetic</option>
								<option value="13">Magical</option>
								<option value="6">Mystic</option>
								<option value="42">Noxious</option>
								<option value="13">Poisonous</option>
								<option value="6">Pyric</option>
								<option value="25">Radiating</option>
								<option value="38">Scorching</option>
								<option value="20">Seething</option>
								<option value="14">Shocking</option>
								<option value="8">Sonic</option>
								<option value="5">Sparking</option>
								<option value="6">Static</option>
								<option value="19">Thermal</option>
								<option value="22">Toxic</option>
								<option value="8">Venomous</option>
							</select>
						</div>
						
						<div class="form-group">
							<select id="weaponMaterialId" onchange="changeInWeaponValue()">
								<option value="0">Material</option>
								<option value="6">Amber</option>
								<option value="-1">Brass</option>
								<option value="0">Bronze</option>
								<option value="2">Coral</option>
								<option value="2">Crystal</option>
								<option value="39">Diamond</option>
								<option value="8">Ebony</option>
								<option value="22">Emerald</option>
								<option value="0">Glass</option>
								<option value="12">Gold</option>
								<option value="3">Iron</option>
								<option value="4">Lapis</option>
								<option value="-10">Leather</option>
								<option value="60">Obsidian</option>
								<option value="4">Pearl</option>
								<option value="16">Platinum</option>
								<option value="10">Qaurtz</option>
								<option value="18">Ruby</option>
								<option value="28">Sapphire</option>
								<option value="6">Silver</option>
								<option value="9">Steel</option>
								<option value="-3">Wooden</option>
							</select>
						</div>

						<div class="form-group">
							<input type="text" id="hands" placeholder="Hands" onclick="clickOnHands()" readonly class="readonly-input" />	
						</div>

						<div class="form-group">
							<input type="text" id="weapon_usable" placeholder="Usable By" onclick="clickOnWeaponUsableBy()" readonly class="readonly-input" />
						</div>

						<div class="form-group">
							<input type="text" id="damage" placeholder="Damage" onclick="clickOnDamageResult()" readonly class="readonly-input" />
						</div>
					</div>

					<!-- ARMOR SECTION -->
					<div class="section-title">🛡️ ARMOR</div>
					<div class="form-row armor-row">
						<div class="form-group">
							<select id="armorId" onchange="changeInArmorValue()">
								<option value="0" data-usable-by="">Armor</option>
								<option value="1" data-usable-by="All">Cape</option>
								<option value="6" data-usable-by="Kn, Pa, Ar, Cl, Ro, Ra">Chain Mail</option>
								<option value="1" data-usable-by="All">Cloak</option>
								<option value="5" data-usable-by="All">Jerkin</option>
								<option value="3" data-usable-by="Kn, Pa, Ar, Cl, Ro, Ni, Ba, Dr, Ra">Leather Armor</option>
								<option value="2" data-usable-by="All">Padded Armor</option>
								<option value="10" data-usable-by="Kn, Pa">Plate Armor</option>
								<option value="8" data-usable-by="Kn, Pa">Plate Mail</option>
								<option value="5" data-usable-by="Kn, Pa, Ar, Cl, Ro, Ni, Ra">Ring mail</option>
								<option value="1" data-usable-by="All">Robes</option>
								<option value="4" data-usable-by="Kn, Pa, Ar, Cl, Ro, Ni, Ba, Ra">Scale Armor</option>
								<option value="7" data-usable-by="Kn, Pa, Cl, Ra">Splint Mail</option>
							</select>
						</div>

						<div class="form-group">
							<select id="armorMaterialId" onchange="changeInArmorValue()">
								<option value="0">Material</option>
								<option value="3">Amber</option>
								<option value="-2">Brass</option>
								<option value="-1">Bronze</option>
								<option value="1">Coral</option>
								<option value="1">Crystal</option>
								<option value="16">Diamond</option>
								<option value="4">Ebony</option>
								<option value="12">Emerald</option>
								<option value="0">Glass</option>
								<option value="6">Gold</option>
								<option value="1">Iron</option>
								<option value="2">Lapis</option>
								<option value="0">Leather</option>
								<option value="20">Obsidian</option>
								<option value="2">Pearl</option>
								<option value="8">Platinum</option>
								<option value="5">Qaurtz</option>
								<option value="10">Ruby</option>
								<option value="14">Sapphire</option>
								<option value="2">Silver</option>
								<option value="4">Steel</option>
								<option value="-3">Wooden</option>
							</select>
						</div>

						<div class="form-group">
							<input type="text" id="armor_usable" placeholder="Usable By" onclick="clickOnArmorUsableBy()" readonly class="readonly-input" />
						</div>

						<div class="form-group">
							<input type="text" id="protection" placeholder="Protection" onclick="clickOnProtectionResult()" readonly class="readonly-input" />
						</div>
					</div>

					<!-- ITEMS SECTION -->
					<div class="section-title">💍 ITEMS</div>
					<div class="form-row item-row">
						<div class="form-group">
							<select id="itemId" onchange="changeInItemValue()">
								<option value="0">Item</option>
								<option value="0">Amulet</option>
								<option value="0">Belt</option>
								<option value="1">Boots</option>
								<option value="0">Broach</option>
								<option value="0">Cameo</option>
								<option value="1">Cape</option>
								<option value="0">Charm</option>
								<option value="1">Cloak</option>
								<option value="3">Cowl</option>
								<option value="0">Crown</option>
								<option value="1">Gauntlets</option>
								<option value="1">Greaves</option>
								<option value="2">Helm</option>
								<option value="0">Medal</option>
								<option value="0">Necklace</option>
								<option value="0">Pendant</option>
								<option value="0">Ring</option>
								<option value="1">Robes</option>
								<option value="0">Scarab</option>
								<option value="4">Shield</option>
								<option value="0">Tiara</option>
								<option value="4">Tower Shield</option>
							</select>
						</div>

						<div class="form-group">
							<select id="itemMaterialId" onchange="changeInItemValue()">
								<option value="0">Material</option>
								<option value="3">Amber</option>
								<option value="-2">Brass</option>
								<option value="-1">Bronze</option>
								<option value="1">Coral</option>
								<option value="1">Crystal</option>
								<option value="16">Diamond</option>
								<option value="4">Ebony</option>
								<option value="12">Emerald</option>
								<option value="0">Glass</option>
								<option value="6">Gold</option>
								<option value="1">Iron</option>
								<option value="2">Lapis</option>
								<option value="0">Leather</option>
								<option value="20">Obsidian</option>
								<option value="2">Pearl</option>
								<option value="8">Platinum</option>
								<option value="5">Qaurtz</option>
								<option value="10">Ruby</option>
								<option value="14">Sapphire</option>
								<option value="2">Silver</option>
								<option value="4">Steel</option>
								<option value="-3">Wooden</option>
							</select>
						</div>

						<div class="form-group">
							<input type="text" id="itemProtection" placeholder="Item Protection" onclick="clickOnItemResult()" readonly class="readonly-input" />
						</div>
					</div>

					<div class="form-group">
						<input type="reset" value="Reset" class="reset-btn" />
					</div>
				</form>      
			</section>
		</div>
	</div>
  
	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="assets/js/custom-util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/sweetalert2.all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
	<script src="assets/js/searchable-dropdown.js"></script>
</body>
</html>