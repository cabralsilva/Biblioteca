<?php
require_once '../util/Banco.php';
class TipoTituloService{
	private $banco;
	function __construct() {
		$this->banco = new BancoDados ();
		try {
			$this->banco->connect ();
		} catch ( Exception $e ) {
			echo "Falha na Conexão com Base de Dados" . $e->getMessage ();
		}
	}
	public function getListTipo() {

		$sql = "SELECT tipotitulo.Codigo, tipotitulo.Nome FROM tipotitulo ORDER BY tipotitulo.Codigo";
		$consulta = $this->banco->getConexaoBanco ()->query ( $sql );
		$lstTipo = array ();

		while ( $linha = $consulta->fetch_array ( MYSQLI_ASSOC ) ) {
			array_push ( $lstTipo, $linha );
		}
		$consulta->close ();
		return $lstTipo;
	}
}