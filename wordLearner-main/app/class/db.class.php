<?php 

Class DB {
	//Abre conexão com o banco de dados
	private function conectaDB(){
		$this->conn = mysqli_connect("localhost","kwebs732_db_2017","kwebs732_2017db$","kwebs732_db_2017");
		if (mysqli_connect_errno()) {
			echo "Falha na conexão com o banco: " . mysqli_connect_error();
		}
		else {
			return $this->conn;
		}
	}
	
	//Fecha conexão com os bancos de dados
	private function desconectaDB($conn){	
		mysqli_close($this->conn);
	}
	
	public function getPalavras($cod_usuario_logado, $dia_id){
		$query = "	SELECT
						A.*
					FROM
						palavras A,
						dias B
					WHERE
						A.dia_id = B.id
					AND
						B.id = '$dia_id'
					AND
						B.cod_usuario_dia = '$cod_usuario_logado'
					ORDER BY A.id ASC";
					
		$consulta = mysqli_query($this->conectaDB(), $query);
		if(mysqli_num_rows($consulta)){
			for($set = array (); $row = $consulta->fetch_assoc(); $set[] = $row);
			return $set;
		}
			else return null;
	}
	
	public function getPalavra($palavra_id){
		$query = "	SELECT
						*
					FROM
						palavras
					WHERE
						id = '$palavra_id'
					ORDER BY id ASC";
					
		$consulta = mysqli_query($this->conectaDB(), $query);
		if(mysqli_num_rows($consulta)){
			for($set = array (); $row = $consulta->fetch_assoc(); $set[] = $row);
			return $set;
		}
			else return null;
	}
	
	public function getPalavrasSearch($id_usuario, $english_word, $portuguese_word){
		if(empty($english_word)){
			$english_word = 'sbfjsdf5484sdfsdfsd4fgsd84gfsf4sd4gsdg4sd8f4sd';
		}
		if(empty($portuguese_word)){
			$portuguese_word = 'sbfjsdf5484sdfsdfsd4fgsd84gfsf4sd4gsdg4sd8f4sd';
		}
		
		$query = "	SELECT
						A.dia_id as 'id_dia_estudo',
						A.id as 'id_palavra',
						date_format(B.dia, '%d/%m/%Y') as 'dia',
						A.dsc_palavra as 'palavra',
						A.traducao_palavra as 'traducao',
						A.nota_observacao as 'nota'
					FROM
						palavras A,
						dias B
					WHERE
						(A.dsc_palavra LIKE '%$english_word%' OR A.traducao_palavra LIKE '%$portuguese_word%')
					AND
						A.dia_id = B.id
					AND
						B.cod_usuario_dia = '$id_usuario'
					ORDER BY dia ASC, palavra ASC;";
					
		$consulta = mysqli_query($this->conectaDB(), $query);
		if(mysqli_num_rows($consulta)){
			for($set = array (); $row = $consulta->fetch_assoc(); $set[] = $row);
			return $set;
		}
			else return null;
	}
	
	public function getDia($dia_id){
		$query = "	SELECT
						*
					FROM
						dias
					WHERE
						id = '$dia_id'
					ORDER BY id ASC";
					
		$consulta = mysqli_query($this->conectaDB(), $query);
		if(mysqli_num_rows($consulta)){
			for($set = array (); $row = $consulta->fetch_assoc(); $set[] = $row);
			return $set;
		}
			else return null;
	}
	
	public function getDiaPalavra($palavra_id){
		$query = "	SELECT
						B.*
					FROM
						palavras A,
						dias B
					WHERE
						A.dia_id = B.id
					AND
						A.id = '$palavra_id'
					ORDER BY B.id ASC";
					
		$consulta = mysqli_query($this->conectaDB(), $query);
		if(mysqli_num_rows($consulta)){
			for($set = array (); $row = $consulta->fetch_assoc(); $set[] = $row);
			return $set;
		}
			else return null;
	}
	
	public function getFrases($cod_usuario_logado, $palavra_id){
		$query = "	SELECT
						A.*
					FROM
						frases A,
						palavras B,
						dias C
					WHERE
						A.palavra_id = '$palavra_id'
					AND
						A.palavra_id = B.id
					AND
						B.dia_id = C.id
					AND
						C.cod_usuario_dia = '$cod_usuario_logado'
					ORDER BY A.id ASC;";
					
		$consulta = mysqli_query($this->conectaDB(), $query);
		if(mysqli_num_rows($consulta)){
			for($set = array (); $row = $consulta->fetch_assoc(); $set[] = $row);
			return $set;
		}
			else return null;
	}
	
	public function getFrase($frase_id){
		$query = "	SELECT
						*
					FROM
						frases
					WHERE
						id = '$frase_id'
					ORDER BY id ASC;";
					
		$consulta = mysqli_query($this->conectaDB(), $query);
		if(mysqli_num_rows($consulta)){
			for($set = array (); $row = $consulta->fetch_assoc(); $set[] = $row);
			return $set;
		}
			else return null;
	}
	
	public function totalPalavras($dia_id){
		$query = "	SELECT
						COUNT(id) AS 'total_palavras'
					FROM
						palavras
					WHERE
						dia_id = '$dia_id';";
					
		$consulta = mysqli_query($this->conectaDB(), $query);
		if(mysqli_num_rows($consulta)){
			for($set = array (); $row = $consulta->fetch_assoc(); $set[] = $row);
			return $set;
		}
			else return null;
	}
	
	public function totalFrases($dia_id){
		$query = "	SELECT
						COUNT(A.id) AS 'total_frases'
					FROM
						frases A,
						palavras B
					WHERE
						B.dia_id = '$dia_id'
					AND
						A.palavra_id = B.id;";
					
		$consulta = mysqli_query($this->conectaDB(), $query);
		if(mysqli_num_rows($consulta)){
			for($set = array (); $row = $consulta->fetch_assoc(); $set[] = $row);
			return $set;
		}
			else return null;
	}
	
}

?>