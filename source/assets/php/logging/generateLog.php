<?php
$fp = fopen('/var/log/homegear/Loxone.'. $_POST['file'], 'r');

fseek($fp, -2048, SEEK_END);

$data = array();
$data = explode("\n", fread($fp, 2048));
fclose($fp);

$grep = $_POST['grep'];

$keyword = strtolower($grep);

if(strpos($grep, '!') !== false) {
	$keyword = str_replace('!', '', $grep);
	$keyword = strtolower($keyword);
}

if($grep == '') {
	for($i = 1; $i<= count($data); $i++) {
		echo '<p>'. $data[$i]. '</p>';
	}
} elseif(strpos($grep, '!') === false) {
	for($i = 1; $i<= count($data); $i++) {
		if(strpos(strtolower($data[$i]), $keyword) !== false) {
			//show all within the keyword
			echo '<p>'. $data[$i]. '</p>';
		}
	}
} elseif(strpos($grep, '!') !== false) {
	for($i = 1; $i<= count($data); $i++) {
		if(strpos(strtolower($data[$i]), $keyword) === false) {
			//show all without the keyword
			echo '<p>'. $data[$i]. '</p>';
		}
	}
}





