<?php
$url = require("get_api_url.php");
$url = $url . "obra/atualizar";

$ch = curl_init();
$autor0 = null;
$autor1 = null;
$autores = null;

if (trim($_POST['autor'] ?? '') != '') {
  $autor0 = array('id' => $_POST['autor_id'], 'nome' => $_POST['autor']);
}
if (trim($_POST['autor1'] ?? '') != '') {
  $autor1 = array('id' => $_POST['autor_id1'], 'nome' => $_POST['autor1']);
}

if ($autor0 != null || $autor1 != null) {
  if ($autor0 == null) {
    $autores = [$autor1];
  } else if ($autor1 == null) {
    $autores = [$autor0];
  } else {
    $autores = [$autor0, $autor1];
  }
}

$obra = [
  'id' => $_POST['id'],
  'ifsn' => $_POST['ifsn'],
  'titulo' => $_POST['titulo'],
  'area' => $_POST['area'],
  'descricao' => $_POST['descricao'],
  'ano' => (int) $_POST['ano'],
  'fileInfo' => $_POST['info_arquivo'] ?? ' ',
  'autores' => $autores
];

$obra = json_encode($obra);

curl_setopt_array($ch, [
  CURLOPT_URL => $url,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Content-Length: ' . strlen($obra)],
  CURLOPT_POSTFIELDS => $obra
]);

curl_exec($ch);

curl_close($ch);

header('location: ../obras/gerenciar');
?>