<?php
/**
Classe que contem os parametros para conexao e o metodo que retorna
**/
class Conexao{
	//credenciais de acesso ao BD
	private $host = 'localhost';
	private $dbname = 'my_blog';
	private $user = 'root';
	private $pass = '';
	//variavel para conexao
	private $conexao;

	public function getConexao(){
		//estabelecer uma conexao e retornar uma variavel com a conexao
		$this->conexao = null;

		try{ //tenta fazer a conexao
			$this->conexao = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->pass);
			$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Erro na conexão: ".$e->getMessage();
		}

		return $this->conexao;
	}
}
