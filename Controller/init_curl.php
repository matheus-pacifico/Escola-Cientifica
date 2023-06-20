<?php



  $ch = curl_init();




  curl_setopt_array($ch, [

  	CURLOPT_RETURNTRANSFER => true, 

  	CURLOPT_SSL_VERIFYPEER => false

  	]);





  return $ch;

  ?>