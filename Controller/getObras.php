<?php

function getAllObras() {
	$ch = require "init_curl.php";
	$url = require("get_api_url.php");
	$url = $url . "obra/exibir";
	curl_setopt($ch, CURLOPT_URL, $url);
	$resultado = json_decode(curl_exec($ch));
	curl_close($ch);
	return $resultado;
}

function nomeAutoresFormatado($autores) {
	if(!empty($autores)) {
		if(count($autores) > 1){
			$nomes = "";

			foreach ($autores as $autor) {
				$nome = explode(" ", $autor->nome);
				$lastNome = end($nome);
				$first = implode(' ', array_slice($nome, 0, -1));
				$nomes .= $lastNome .', '.substr($first,0,1) . '.; ';
			}
			$nomes = rtrim($nomes, ' ; ') . '';
			echo $nomes;
			
		} else if(is_array($autores)) {
			echo $autores[0]->nome; 
		} else {
			echo $autores->nome;
		}

	}

}

function numeroAutores($autores) {
	return count($autores);
}

function getSearchedObras($q) {
	if($q != "") {
		$ch = require "init_curl.php";
		$url = require("get_api_url.php");
		$url = $url .  "obra/search?q=" . $q;
		
		curl_setopt($ch, CURLOPT_URL, $url);
		$resultado = json_decode(curl_exec($ch));
		curl_close($ch);
		return $resultado;
	}

	return [];
}

function tituloLimitado($titulo) {
	if(strlen($titulo > 141)) {
		return substr($titulo, 0, 146) . "...";
	} 
	return $titulo;	
}

function descricaoLimitada($descricao) {
	if(strlen($descricao > 261)) {
		return substr($descricao, 0, 256) . "...";
	} 
	return $descricao;
}

?>
