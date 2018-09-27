<?php

class Post{
	public $id;
	public $titulo;
	public $texto;
	public $id_categoria;
	public $autor;
	public $dt_criacao;
	private $conexao;

	/*
      Ao instanciar um objeto, pasaremos a conexao.
	  a conexao sera armazenada em $this->conexao
	  para uso aqui na Classe
	*/
	public function __construct($con){
		$this->conexao = $con;

	}

	/*
	  método read() deverá efetuar uma consula SQL
	  na tabela categoria, e retonar o resultado
	*/
	public function read($id=null){
		if (isset($id)){
			$consulta = "SELECT * from post where id=:id";
			$stmt = $this->conexao->prepare($consulta);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);

		}else{
			$consulta = "SELECT * from categoria order by nome";
			$stmt = $this->conexao->prepare($consulta);
			$stmt->execute();
			$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $resultado;
		}

		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		return $resultado;
	}

	public function create(){
		$consulta = "INSERT INTO post(titulo,texto,autor,dt_criacao,id_categoria) VALUES( :titulo,:texto,:autor,:dt_criacao,:id_categoria)";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':titulo', $this->titulo , PDO::PARAM_STR);
		$stmt->bindParam(':texto', $this->texto , PDO::PARAM_STR);
		$stmt->bindParam(':autor', $this->autor , PDO::PARAM_INT);
		$stmt->bindParam(':dt_criacao', $this->dt_criacao, PDO::PARAM_INT);
		$stmt->bindParam(':id_categoria', $this->id_categoria, PDO::PARAM_INT);
		if ($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function update(){
		// print_r($id);
		$consulta = "UPDATE post SET titulo = :titulo, texto = :texto, autor = :autor, dt_criacao = :dt_criacao , id_categoria = :id_categoria WHERE id = :id;";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':id', $this->id , PDO::PARAM_INT);
		$stmt->bindParam(':titulo', $this->titulo , PDO::PARAM_STR);
		$stmt->bindParam(':texto', $this->texto , PDO::PARAM_STR);
		$stmt->bindParam(':autor', $this->autor , PDO::PARAM_INT);
		$stmt->bindParam(':dt_criacao', $this->dt_criacao, PDO::PARAM_INT);
		$stmt->bindParam(':id_categoria', $this->id_categoria, PDO::PARAM_INT);
		try {
			$stmt->execute();
			if($stmt->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function delete(){
		$consulta = "DELETE FROM post WHERE id = :id";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam(':id', $this->id , PDO::PARAM_INT);
		try {
			$stmt->execute();
			if($stmt->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
}