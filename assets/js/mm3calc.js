var changeInWeaponValue = function() {
	var weapons = document.getElementById("weaponId");
	var materials = document.getElementById("weaponMaterialId");

	var selected_weapon = weapons.options[weapons.selectedIndex];
	var selected_material = materials.options[materials.selectedIndex];

	var weapon_damage = selected_weapon.value;
	var material_damage = materials.options[materials.selectedIndex].value;

	var num_of_hands = selected_weapon.getAttribute("data-hands");
	var usableby = selected_weapon.getAttribute("data-usable-by");

	document.getElementById("damage").value = parseInt(weapon_damage) + parseInt(material_damage);			
	document.getElementById("hands").value = num_of_hands;
	document.getElementById("weapon_usable").value = usableby;
}

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