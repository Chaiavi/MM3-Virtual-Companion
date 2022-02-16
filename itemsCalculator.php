<?php
include "link.php";
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	<script src="assets/js/mm3calc.js"></script>
	<title>Items Calculator</title>
</head>

<body>
	<div id="page-wrapper" >
	
      <div class="container ">   	  
      	<section class="wrapper style5" >
            <form method="post" action="#">

              <!-- WEAPONS -->
              <div class="row gtr-uniform">         
                <div class="col-2" id="weaponDropdown">            
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

                <div class="col-2" >
                  <select id="weaponSpecialId" onchange="changeInWeaponValue()">
                    <option value="0">Special Property</option>
                    <option value="23">Accelerator</option>
                    <option value="5">Accurate</option>
                    <option value="4">Acidic</option>
                    <option value="12">Arcane</option>
                    <option value="10">Archmage</option>
                    <option value="4">Armored</option>
                    <option value="25">Blazing</option>
                    <option value="5">Brigand</option>
                    <option value="1">Buddy</option>
                    <option value="3">Burglar</option>
                    <option value="3">Burning</option>
                    <option value="2">Castors</option>
                    <option value="5">Chance</option>
                    <option value="6">Charisma</option>
                    <option value="3">Charm</option>
                    <option value="1">Clever</option>
                    <option value="5">Clover</option>
                    <option value="14">Cold</option>
                    <option value="10">Criminal</option>
                    <option value="6">Defender</option>
                    <option value="6">Dense</option>
                    <option value="16">Divine</option>
                    <option value="38">Dragon</option>
                    <option value="25">Dyna</option>
                    <option value="30">Ectoplasmic</option>
                    <option value="12">Ego</option>
                    <option value="19">Electric</option>
                    <option value="30">Exacto</option>
                    <option value="5">Fast</option>
                    <option value="5">Fiery</option>
                    <option value="6">Filch</option>
                    <option value="13">Flaming</option>
                    <option value="8">Flashing</option>
                    <option value="3">Flickering</option>
                    <option value="23">Force</option>
                    <option value="8">Freezing</option>
                    <option value="2">Friendship</option>
                    <option value="6">Frost</option>
                    <option value="8">Fuming</option>
                    <option value="25">Gamblers</option>
                    <option value="15">Genius</option>
                    <option value="12">Giant</option>
                    <option value="3">Glowing</option>
                    <option value="6">Health</option>
                    <option value="15">Holy</option>
                    <option value="3">Icy</option>
                    <option value="5">Incandescent</option>
                    <option value="8">Intellect</option>
                    <option value="35">Kinetic</option>
                    <option value="6">Knowledge</option>
                    <option value="8">Leadership</option>
                    <option value="30">Leprechauns</option>
                    <option value="5">Life</option>
                    <option value="4">Looter</option>
                    <option value="20">Luck</option>
                    <option value="8">Mage</option>
                    <option value="12">Magical</option>
                    <option value="10">Marksman</option>
                    <option value="2">Might</option>
                    <option value="1">Mind</option>
                    <option value="2">Mugger</option>
                    <option value="6">Mystic</option>
                    <option value="40">Noxious</option>
                    <option value="8">Ogre</option>
                    <option value="4">Personality</option>
                    <option value="47">Photon</option>
                    <option value="12">Pirate</option>
                    <option value="9">Plunderer</option>
                    <option value="12">Poisonous</option>
                    <option value="13">Power</option>
                    <option value="15">Precision</option>
                    <option value="2">Protection</option>
                    <option value="6">Pyric</option>
                    <option value="1">Quick</option>
                    <option value="24">Radiating</option>
                    <option value="8">Rapid</option>
                    <option value="8">Rogue</option>
                    <option value="2">Sage</option>
                    <option value="36">Scorching</option>
                    <option value="19">Seething</option>
                    <option value="3">Sharp</option>
                    <option value="13">Shocking</option>
                    <option value="7">Sonic</option>
                    <option value="5">Sparking</option>
                    <option value="6">Speed</option>
                    <option value="2">Spell</option>
                    <option value="6">Static</option>
                    <option value="5">Stealth</option>
                    <option value="3">Strength</option>
                    <option value="2">Swift</option>
                    <option value="18">Thermal</option>
                    <option value="7">Thief</option>
                    <option value="4">Thought</option>
                    <option value="17">Thunder</option>
                    <option value="21">Toxic</option>
                    <option value="10">Troll</option>
                    <option value="20">True</option>
                    <option value="25">Vampyric</option>
                    <option value="15">Velocity</option>
                    <option value="7">Venemous</option>
                    <option value="2">Vigor</option>
                    <option value="5">Warrior</option>
                    <option value="8">Wind</option>
                    <option value="15">Winners</option>
                    <option value="11">Wisdom</option>
                    <option value="6">Witch</option>
                  </select>
                </div>
                
                <div class="col-2" >
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

                <div class="col-2">
                  <input type="text" id="hands" placeholder="Hands" onclick="clickOnHands()" readonly />	
                </div>

                <div class="col-4">
                  <input type="text" id="weapon_usable" placeholder="Usable By" onclick="clickOnWeaponUsableBy()" readonly />
                </div>

                <div class="col-2">
                  <input type="text" id="damage" placeholder="Damage" onclick="clickOnDamageResult()" readonly />
              	</div>
          </div>

          <br/>

          <!-- ARMOR -->
          <div class="row gtr-uniform">
            <div class="col-2">
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

            <div class="col-2" >
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

            <div class="col-4">
              <input type="text" id="armor_usable" placeholder="Usable By" onclick="clickOnArmorUsableBy()" readonly />
            </div>

            <div class="col-2">
            	<input type="text" id="protection" placeholder="Protection" onclick="clickOnProtectionResult()" readonly />
            </div>
          </div>

          <br/>

          <!-- ITEMS -->
          <div class="row gtr-uniform">
            <div class="col-2">
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

            <div class="col-2" >
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

            <div class="col-2">
              <input type="text" id="itemProtection" placeholder="Item Protection" onclick="clickOnItemResult()" readonly />
          	</div>

          	<div class="col-12">
            	<div class="actions">
              		<input type="reset" value="Reset" />
          		</div>
        	</div>
		</div>
              
      </form>      
      </section>
	</div>
  </div>
  
	<!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="assets/js/util.js"></script>
  <script src="assets/js/main.js"></script>

  <script src="assets/js/sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
</body>
</html>