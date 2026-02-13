<?php

function getAllObras() {
	$ch = require "init_curl.php";
	$url = require("get_api_url.php");
	$url = $url . "obra/listar-paginado";
	curl_setopt($ch, CURLOPT_URL, $url);
	$resultado = json_decode(curl_exec($ch));
	curl_close($ch);
	return $resultado->content;
}

function nomeAutoresFormatado($autores) {
	if(!empty($autores)) {
		if(count($autores) > 1) {
			$nomes = "";
			foreach ($autores as $autor) {
				$nome = is_object($autor) ? explode(" ", $autor->nome) : explode(" ", $autor);
				$lastNome = end($nome);
				$first = implode(' ', array_slice($nome, 0, -1));
				$nomes .= $lastNome .', '.substr($first,0,1) . '.; ';
			}
			$nomes = rtrim($nomes, ' ; ') . '';
			echo $nomes;
		} else if(is_array($autores)) {
			echo is_object($autores[0]) ? $autores[0]->nome : $autores[0]; 
		} else {
			echo is_object($autores) ? $autores->nome : $autores;
		}
	} else {
		echo "";
	}
}

function numeroAutores($autores) {
	return count($autores);
}

function nomeAutores($autores) {
	if(!empty($autores)) {
		if(count($autores) > 1) {
			$nomes = "";
			foreach ($autores as $autor) {
				$nomes = $nomes . (is_object($autor) ? $autor->nome : $autor) . ', ';
			}
			$nomes = rtrim($nomes, ' , ') . '';
			echo $nomes;
		} else if(is_array($autores)) {
			echo is_object($autores[0]) ? $autores[0]->nome : $autores[0]; 
		} else {
			echo is_object($autores) ? $autores->nome : $autores;
		}
	} else {
		echo "";
	}
}

function getSearchedObras($q) {
	if($q == "") {
		return [];
	}
	$ch = require "init_curl.php";
	$url = require("get_api_url.php");
	$url = $url .  "obra/search?q={$q}";
	curl_setopt($ch, CURLOPT_URL, $url);
	$resultado = json_decode(curl_exec($ch));
	curl_close($ch);
	return $resultado;
}

function tituloLimitado($titulo) {
	if(strlen($titulo) > 141) {
		return substr($titulo, 0, 146) . "...";
	}
	return $titulo;	
}

function descricaoLimitada($descricao) {
	if(strlen($descricao) > 254) {
		$corte = substr($descricao, 0, 250);
		$corte = rtrim($corte, " \n\r\t");
		return $corte . "...";
	}
	return $descricao;
}

function getObraByIfsn($ifsn) {
	if(trim($ifsn) == "") {
		return null;
	}
	$ifsn = preg_replace('/ $/', '', $ifsn);
	$ch = require("init_curl.php");
	$url = require("get_api_url.php");
	$url = $url . "obra/mostrar/ifsn/{$ifsn}";
	curl_setopt($ch, CURLOPT_URL, $url);
	$resultado = json_decode(curl_exec($ch));
	curl_close($ch);
	return $resultado;
}

function scape_html_tags($string, $scape_quotes = false) {
   return htmlspecialchars($string, ($scape_quotes ? ENT_QUOTES : ENT_NOQUOTES), 'UTF-8');
}

?>
