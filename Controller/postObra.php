<?php

  $url = $_ENV['URL_BASE'] . "obra/adicionar";


  $ch = require "init_curl.php";



	curl_setopt($ch, CURLOPT_URL, $url);



  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  $_POST = json_encode($_POST);



  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($_POST)));

	curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);





	$statusc =curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

  $resultado = json_decode(curl_exec($ch));



  curl_close($ch);
  
  header('location: ../obra/postarObra.php');

?>