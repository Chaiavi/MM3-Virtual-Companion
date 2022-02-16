// WEAPON
var changeInWeaponValue = function() {
	var weapons = document.getElementById("weaponId");
  	var special = document.getElementById("weaponSpecialId");
	var materials = document.getElementById("weaponMaterialId");

	var weapon_damage = weapons.options[weapons.selectedIndex].value;
	var special_damage = special.options[special.selectedIndex].value;
  	var material_damage = materials.options[materials.selectedIndex].value;

  	var selected_weapon = weapons.options[weapons.selectedIndex];
	var num_of_hands = selected_weapon.getAttribute("data-hands");
	var usableby = selected_weapon.getAttribute("data-usable-by");

	document.getElementById("damage").value = parseInt(weapon_damage) + parseInt(material_damage) + parseInt(special_damage);			
	document.getElementById("hands").value = num_of_hands;
	document.getElementById("weapon_usable").value = usableby;
}

var clickOnHands = function() {
	var weapons = document.getElementById("weaponId");
	var selected_weapon = weapons.options[weapons.selectedIndex];
	var num_of_hands = selected_weapon.getAttribute("data-hands");
	swal({
	  title: 'Hands',
	  text: `Number of hands used for this weapon: ${num_of_hands}`,
	  showConfirmButton: false
	})
}

var clickOnDamageResult = function() {
	var damage = document.getElementById("damage").value;
	swal({
	  title: 'Damage',
	  text: `Damage Issued by This Weapon: ${damage}`,
	  showConfirmButton: false
	})
}

var clickOnWeaponUsableBy = function() {
	var usableBy = document.getElementById("weapon_usable").value;
	usableBy = usableBy.replace("Kn", "Knight").replace("Pa", "Paladin").replace("Ar", "Archer").replace("Cl", "Cleric").replace("Ro", "Robber").replace("Ni", "Ninja").replace("Ba", "Barbarian").replace("Dr", "Druid").replace("Ra", "Ranger");
	swal({
	  title: 'Usable By',
	  text: `This Weapon can be Used only by the Following:\n ${usableBy}`,
	  showConfirmButton: false
	})
}

// ARMOR
var changeInArmorValue = function() {
	var armor = document.getElementById("armorId");
	var materials = document.getElementById("armorMaterialId");

	var selected_armor = armor.options[armor.selectedIndex];
	var selected_material = materials.options[materials.selectedIndex];

	var armor_protection = selected_armor.value;
	var material_protection = materials.options[materials.selectedIndex].value;

	var usableby = selected_armor.getAttribute("data-usable-by");

	document.getElementById("protection").value = parseInt(armor_protection) + parseInt(material_protection);			
	document.getElementById("armor_usable").value = usableby;
}

var clickOnArmorUsableBy = function() {
	var usableBy = document.getElementById("armor_usable").value;
	usableBy = usableBy.replace("Kn", "Knight").replace("Pa", "Paladin").replace("Ar", "Archer").replace("Cl", "Cleric").replace("Ro", "Robber").replace("Ni", "Ninja").replace("Ba", "Barbarian").replace("Dr", "Druid").replace("Ra", "Ranger");
	swal({
	  title: 'Usable By',
	  text: `This Armor can be Used only by the Following:\n ${usableBy}`,
	  showConfirmButton: false
	})
}

var clickOnProtectionResult = function() {
	var protection = document.getElementById("protection").value;
	swal({
	  title: 'Protection',
	  text: `Protection Issued by This Armor: ${protection}`,
	  showConfirmButton: false
	})
}

// ITEMS
var changeInItemValue = function() {
	var item = document.getElementById("itemId");
	var materials = document.getElementById("itemMaterialId");

	var selected_item = item.options[item.selectedIndex];
	var selected_material = materials.options[materials.selectedIndex];

	var item_protection = selected_item.value;
	var material_protection = selected_material.value;

	document.getElementById("itemProtection").value = parseInt(item_protection) + parseInt(material_protection);			
}

var clickOnItemResult = function() {
	var protection = document.getElementById("itemProtection").value;
	swal({
	  title: 'Protection',
	  text: `Protection Issued by This Item: ${protection}`,
	  showConfirmButton: false
	})
}
