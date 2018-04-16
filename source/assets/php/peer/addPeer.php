<?php

require 'LoxHom.php';

$uuid = $_POST['uuid'];
$name = $_POST['room']. ' | '. $_POST['name'];

try {
	$uuid = $_POST['uuid'];
	$name = $_POST['room']. '|'. $_POST['name'];

	$serial = 'LOX'. substr($_POST['uuid'],1,7);

	$hg = new \Homegear\Homegear();

	$type = LoxHom::getDeviceType($_POST['type']);

	if($type > 0){

		$newPeer = $hg->createDevice(254, $type, $serial, -1, -1);

		if(!$hg->putParamset($newPeer, 0,  array('UUID' => $uuid))) {
			$hg->setName($newPeer, $name);
			//todo: set room, set cat
			echo $newPeer;
		}
	}
}
catch (Exception $e)
{
	echo -1;
}