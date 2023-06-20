<?php

function getAllObras() {
	$ch = require "init_curl.php";
	$url = $_ENV['URL_BASE'] . "obra/" . "exibir";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$resultado = json_decode(curl_exec($ch));
	$ch = curl_init($url);
	curl_close($ch);
	return $resultado;
}

function nomeAutoresFormatado($autores) {
	if(!empty($autores)) {
		if(count($autores) > 1){
			$nomes = "";

			foreach ($autores as $autor) {
				$nomees = explode(" ", $autor->nome);
				$lastnome = end($nomees);
				$first = implode(' ', array_slice($nomees, 0, -1));
				$nomes .= $lastnome .', '.substr($first,0,1) . '.; ';
			}
			$nomes = rtrim($nomes, ' ; ') . '';
			echo $nomes;
			
		} else {
			echo $autores->nome; 
		}

	}

}

function getSearchedObras($q) {
	if($q != "") {
		$ch = require "init_curl.php";
		$url = $_ENV['URL_BASE'] . "obra/" . "search?q=" . $q;
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$resultado = json_decode(curl_exec($ch));
		$ch = curl_init($url);
		curl_close($ch);
		return $resultado;
	}

	return [];
}

?>
