<?php
$url = require("get_api_url.php");
$url = $url . "obra/atualizar/{$_POST['id']}";

$ch = curl_init();

if(isset($_POST['autor1'])) {
  $autores = [
    array('id' => $_POST['autor_id'], 'nome' => $_POST['autor']),
    array('id' => $_POST['autor_id1'], 'nome' => $_POST['autor1'])
  ];
} else {
  $autores = [array('id' => $_POST['autor_id'], 'nome' => $_POST['autor'])];
}

$obra = [
  'id' => $_POST['id'],
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
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Content-Length: ' . strlen($obra)],
  CURLOPT_POSTFIELDS => $obra
]);

curl_exec($ch);

curl_close($ch);

header('location: ../obra/gerenciar.php');
?>