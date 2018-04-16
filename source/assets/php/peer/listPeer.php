<?php
function decode($uuids)
{
	foreach($uuids as $uuid => $value) {
		$array[$uuid] = $value['name'];
	}
	return $array;
}

$hg = new \Homegear\Homegear();
$devices = $hg->listDevices(false, array("ID", "FAMILY", "TYPE_ID"), 254); //@ToDo++++++++++++++++++++++++++++++++++++++254 = Miscellaneous, muss noch auf eigenen ID umgebaut werden
foreach($devices as $device) {
	if($device['TYPE_ID'] > 768 && $device['TYPE_ID'] < 1024) {
		//@ToDo
		//Finde alle Devices UUIDmit einer Type ID größer 0x300, da diese Loxone Bausteine sind.
		//768 = 0x300, noch umbauen auf ID 1 wenn eigene Familie
		$config = $hg->getParamset($device['ID'], 0, "MASTER");
		$loxonePeerIds[$config["UUID"]] = $device['ID'];
	}
	if($device['TYPE_ID'] == 768) {
		$config = $hg->getParamset($device['ID'], 0, "MASTER");
		$url = "http://". addslashes($config['USER']). ":". addslashes($config['PASSWORD']). "@". $config['HOST']. ":". $config['PORT']. "/data/LoxAPP3.json";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$LoxAPP3 = curl_exec($ch);
		curl_close($ch);
	}
}

if($LoxAPP3) {
	$LoxAPP3 = json_decode($LoxAPP3, true);
	//generate Array with all UUID - Room Pairs
	$rooms = decode($LoxAPP3['rooms']);
	//generate Array with all UUID - Categorie Pairs
	$categories = decode($LoxAPP3['cats']);
	//generate Array with all UUID and Infos
	$controls = $LoxAPP3['controls'];

	require 'LoxHom.php';
}
?>

<div class="dynamicContent">
<div class="panel panel-default">
	<div class="panel-heading">
		Device Overview
	</div>
	<div class="panel-body">
		<p>Here's a list of all the devices in your Loxone configuration. Note that only devices are displayed for which the user has the required rights.</p>
		<p>By pressing the add peer button, the device is created in homegear and the associated peer id is displayed.</p>
		<p>devices without peer id and add peer button can not be created in homegear yet. Please wait a while and wait for the next update.</p>
	</div>
	<?php
	if($LoxAPP3) {
	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/script.inc.js"></script>
	<table class="table">
		<thead>
			<tr>
				<th>Raum</th>
				<th>Kategorie</th>
				<th>Name</th>
				<th>Typ</th>
				<th>UUID</th>
				<th>PeerId</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 0;
		foreach($controls as $control => $values) {
		?>
			<tr>
				<td><input id="room<?= $i ?>" type="text" textarea readonly="readonly" value="<?= $rooms[$values['room']]?>" /></td>
				<td><input id="cat<?= $i ?>" type="text" textarea readonly="readonly" value="<?= $categories[$values['cat']]?>" /></td>
				<td><input id="name<?= $i ?>" type="text" textarea readonly="readonly" value="<?= $values['name']?>" /></td>
				<td><input id="type<?= $i ?>" type="text" textarea readonly="readonly" value="<?= $values['type']?>" /></td>
				<td><input id="uuid<?= $i ?>" type="text" textarea readonly="readonly" value="<?= $control?>" /></td>
				<td id="peer<?= $i ?>">
					<?php
					if(array_key_exists($control, $loxonePeerIds)) {
						echo $loxonePeerIds[$control];
					} else {
						$type = LoxHom::getDeviceType($values['type']);
						if($type > 0){
						?>
							<input class="submit" id="<?= $i ?>" type="button" value="add Peer" />
						<?php
						}
					}
					?>
				</td>
			</tr>
			<?php
			$i++;
		}
		?>
		</tbody>
	</table>
	<?php
	}
	?>
</div>
</div>

<!--
	
toDo
//Ermittlen welche uuid in Homegear vorhanden ist aber nicht mehr in der LoxApp3 ist und die als nicht mehr vorhanden ausgeben
//prüfen ob überhaut ein Miniserver in Homegear vorhanden ist und nur bei vorhandem etwas ausgeben
-->
		