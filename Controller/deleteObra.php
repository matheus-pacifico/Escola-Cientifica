<?php

if($_POST['id'] == "") {

  header('Location: ../obra/gerenciarObra.php');

} else {

    $url = $_ENV['URL_BASE'] . "obra/" ."deletar/{$_POST['id']}";

    $ch = require "init_curl.php";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if(curl_errno($ch)) {
      echo 'Erro ao enviar a solicitação: ' . curl_error($ch);
    }

    $statusc = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    if($statusc == 200) {
      echo '<p> Removido</p>';
    }

    curl_close($ch);

    header('Location: ../obra/gerenciarObra.php');
  }


?>
