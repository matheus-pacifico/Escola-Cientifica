<?php

$url = require("get_api_url.php");
$url = $url. "obras/adicionar";

$ch = curl_init();

if(trim($_POST['autor2']) != "") {
  $autores = array(
    array('id' => null, 'nome' => $_POST['autor']),
    array('id' => null, 'nome' => $_POST['autor2'])
  );
} else {
  $autores = array(array('id' => null, 'nome' => $_POST['autor']));
}

$obra = [
  'id' => null,
  'ifsn' => $_POST['ifsn'],
  'titulo' => $_POST['titulo'],
  'area' => $_POST['area'],
  'descricao' => $_POST['descricao'],
  'ano' => (int) $_POST['ano'],
  'nomeArquivo' => $_POST['nome_arquivo'],
  'caminhoArquivo' => $_POST['caminho_arquivo'],
  'autores' => $autores
];

$obra = json_encode($obra);

curl_setopt_array($ch, [
  CURLOPT_URL => $url,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Content-Length: ' . strlen($obra)],
  CURLOPT_POSTFIELDS => $obra
]);

curl_exec($ch);

curl_close($ch);

header('location: ../obras/postar.php');
?>
