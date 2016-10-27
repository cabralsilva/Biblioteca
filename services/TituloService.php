<?php
require_once '../util/Banco.php';

class TituloService {
	private $banco;
	function __construct() {
		$this->banco = new BancoDados ();
		try {
			$this->banco->connect ();
		} catch ( Exception $e ) {
			echo "Falha na Conexão com Base de Dados" . $e->getMessage ();
		}
	}
	public function searchTitulos($texto) {
		$sql = "SELECT DISTINCT Titulo.Codigo, Titulo.Titulo, Titulo.SubTitulo, Titulo.NumeroChamada, " 
				. "Titulo.PublicacaoLocal, Titulo.Edicao, Titulo.DescricaoFisica, Titulo.ISBN, Titulo.CodigoAutor, " 
				. "Titulo.CodigoEditora, Titulo.Volume, Titulo.Area, Titulo.CodigoTipoTitulo, Titulo.Periodicidade, Titulo.Parte, Titulo.CodigoIdioma, " 
				. "Titulo.NomeEditora, Titulo.NomeIdioma, Titulo.NomeTipoTitulo FROM Titulo" 
				. "\n\t WHERE " 
					. "(\n\t\tLOWER(Titulo.Titulo) like '%filosofia%'\n\t)" 
				. "\n ORDER BY Titulo.Codigo DESC";
		$consulta = $this->banco->getConexaoBanco()->query($sql);
		
		$_titulos = array();
		
		while($linha = $consulta->fetch_array(MYSQLI_ASSOC)){
			array_push($_titulos, $linha);
// 			$_SESSION["dados_empresa"]["cod_empresa"] = $linha["CODIGO"];
// 			$_SESSION["dados_empresa"]["nome_empresa"] = $linha["NOME"];
// 			$_SESSION["dados_empresa"]["host_banco_empresa"] = $linha["host_banco"];
// 			$_SESSION["dados_empresa"]["nome_banco_empresa"] = $linha["nome_banco"];
// 			$_SESSION["dados_empresa"]["user_banco_empresa"] = $linha["user_banco"];
// 			$_SESSION["dados_empresa"]["senha_banco_empresa"] = $linha["senha_banco"];
				
		}
		// Libera o result set
		$consulta->close();
		return $_titulos;
	}
}