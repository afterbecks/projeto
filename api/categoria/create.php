<?php

header('Content-Type: application/json');

require_once '../../config/Conexao.php';
require_once '../../models/Categoria.php';

//instancia o objeto conexao
$db = new Conexao();

//recebe a conexao feita
$con = $db->getConexao();


//instancia o objeto categotia com a conexao como parametro
//passa a conexao
$data = json_decode(file_get_contents('php://input'), true);

$cat = new Categoria($con);
$cat->nome = $data['nome'];
$cat->descricao = $data['descricao'];
if ($cat->create()){
	http_response_code(201);
	echo json_encode(['mensagem'=>'Categoria criada']);
}else{
	echo json_encode(['mensagem'=>'Categoria não foi criada']);
}

