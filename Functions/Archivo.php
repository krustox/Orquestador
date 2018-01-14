<?php
	function escribir($nivel,$texto){
		$file = fopen($nivel.".txt", "a");
		fwrite($file, date("l jS \of F Y h:i:s A"));
		fwrite($file, ": ".$texto . PHP_EOL);
		fclose($file);
	}
?>