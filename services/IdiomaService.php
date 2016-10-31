<?php
require_once '../util/Banco.php';
class IdiomaService {
	private $banco;
	function __construct() {
		$this->banco = new BancoDados ();
		try {
			$this->banco->connect ();
		} catch ( Exception $e ) {
			echo "Falha na Conexão com Base de Dados" . $e->getMessage ();
		}
	}
	public function getListIdiomas() {
		
		$sql = "SELECT idioma.Codigo, idioma.Nome FROM idioma ORDER BY idioma.Codigo";
		$consulta = $this->banco->getConexaoBanco ()->query ( $sql );
		$lstIdiomas = array ();
		
		while ( $linha = $consulta->fetch_array ( MYSQLI_ASSOC ) ) {
			array_push ( $lstIdiomas, $linha );
		}
		$consulta->close ();
		return $lstIdiomas;
	}
	
}