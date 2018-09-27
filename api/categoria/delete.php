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
$cat = new Categoria($con);

$data = json_decode(file_get_contents('php://input'), true);

	$res = array('status', 'ok');
if ($cat->delete($data)){
}else{
	$res = array('status', 'falha na alteracao');
}

echo json_encode($res);