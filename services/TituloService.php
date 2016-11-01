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
	public function searchTitulos($tipo, $campo, $idioma, $texto, $pagina, $quantidade) {
		$texto = strtolower ( $texto );
		$sql = $this->getSQLRegistros ( $tipo, $campo, $idioma, $texto, $pagina, $quantidade );
		$consulta = $this->banco->getConexaoBanco ()->query ( $sql );
		
		$_titulos = array ();
		
		while ( $linha = $consulta->fetch_array ( MYSQLI_ASSOC ) ) {
			$linha["NomeAutorPrincipal"] = $this->getAutorPrincipal($linha["Codigo"])["NomeAutor"];
			array_push ( $_titulos, $linha );
		}
		$consulta->close ();
		return $_titulos;
	}
	public function getTotalRegistros($tipo, $campo, $idioma, $texto) {
		$texto = strtolower ( $texto );
		$sql = $this->getSQLContagem ( $tipo, $campo, $idioma, $texto );
		$consulta = $this->banco->getConexaoBanco ()->query ( $sql );
		if (! $consulta)
			echo mysql_error ();
		$total = $consulta->fetch_array ( MYSQLI_NUM );
		$consulta->close ();
		return ( int ) $total [0];
	}
	private function getAutorPrincipal($codigoTitulo){
		$sql = "SELECT autortitulo.NomeAutor FROM autortitulo WHERE autortitulo.CodigoTitulo = " . $codigoTitulo . " AND autortitulo.AutorPrincipal IS NOT NULL";
		$buscaAutor = $this->banco->getConexaoBanco()->query( $sql);
		if (! $buscaAutor)
			echo mysql_error ();
		$retorno = $buscaAutor->fetch_array(MYSQLI_ASSOC);
		$buscaAutor->close();
		return $retorno;
	}
	
	private function getSQLContagem($tipo, $campo, $idioma, $texto) {
		$sql = "SELECT COUNT(DISTINCT Titulo.Codigo) AS TOTAL FROM Titulo";
		$sql .= $this->getSQLCondicoes ( $tipo, $campo, $idioma, $texto );
		return $sql;
	}
	private function getSQLRegistros($tipo, $campo, $idioma, $texto, $pagina, $quantidade) {
		$sql = "SELECT DISTINCT titulo.Codigo, titulo.Titulo, titulo.SubTitulo, titulo.NumeroChamada, " . "titulo.PublicacaoLocal, titulo.Edicao, titulo.DescricaoFisica, titulo.ISBN, titulo.CodigoAutor, " . "titulo.CodigoEditora, titulo.Volume, titulo.Area, titulo.CodigoTipoTitulo, titulo.Periodicidade, titulo.Parte, titulo.CodigoIdioma, " . "titulo.NomeEditora, titulo.NomeIdioma, titulo.NomeTipoTitulo, titulo.PublicacaoData FROM Titulo";
		
		$sql .= $this->getSQLCondicoes ( $tipo, $campo, $idioma, $texto );
		$sql .= "\n ORDER BY Titulo.Codigo";
		$sql .= "\n LIMIT " . $quantidade . " OFFSET " . (($quantidade * $pagina) - $quantidade);
		return $sql;
	}
	private function getSQLCondicoes($tipo, $campo, $idioma, $texto) {
		$where = "";
		$joins = "";
		$whereIdioma = "";
		$whereTipoTitulo = "";
		$previous = false;
		
		if ($idioma != 0) {
			if ($previous)
				$whereIdioma .= " AND ";
			else
				$whereIdioma .= "\n\tWHERE ";
			$previous = true;
			$whereIdioma .= " (titulo.CodigoIdioma = " . $idioma . ")";
			$where .= $whereIdioma;
		}
		
		if ($tipo != 0) {
			if ($previous)
				$whereTipoTitulo .= " AND ";
			else
				$whereTipoTitulo .= "\n\tWHERE ";
			$previous = true;
			$whereTipoTitulo .= "(titulo.CodigoTipoTitulo = " . $tipo . ")";
			$where .= $whereTipoTitulo;
		}
		
		if ($campo != "Todos") {
			switch ($campo) {
				case "Titulo" :
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(titulo.Titulo) like '%" . $texto . "%'\n\t)";
					$previous = true;
					break;
				case "Autor" :
					$joins .= "\n\tINNER JOIN autortitulo ON (autortitulo.CodigoTitulo = titulo.Codigo)";
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(autorTitulo.NomeAutor) like '%" . $texto . "%'\n)";
					$previous = true;
					break;
				
				case "Editora" :
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(titulo.NomeEditora) like '%" . $texto . "%'\n)";
					$previous = true;
					break;
				case "Área" :
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(titulo.Area) like '%" . $texto . "%'\n)";
					$previous = true;
					break;
				case "Assunto" :
					$joins .= "\n\tINNER JOIN assuntotitulo ON assuntotitulo.CodigoTitulo = titulo.Codigo";
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\t(LOWER(assuntotitulo.NomeAssunto) like '%" . $texto . "%')\n\t)";
					$previous = true;
					break;
				default :
					break;
			}
		} else {
			$joins .= "\n\tINNER JOIN assuntoTitulo ON AssuntoTitulo.CodigoTitulo = Titulo.Codigo" . "\n\tINNER JOIN autorTitulo ON (autorTitulo.CodigoTitulo = titulo.Codigo)";
			
			if ($previous)
				$where .= " AND ";
			else
				$where .= "\n\t WHERE ";
			$where .= "\n\t\t((LOWER(titulo.Area) like '%" . $texto . "%') or" . "\n\t\t(LOWER(titulo.Titulo) like '%" . $texto . "%') or" . "\n\t\t(LOWER(titulo.NomeEditora) like '%" . $texto . "%') or" . "\n\t\t(LOWER(assuntotitulo.NomeAssunto) like '%" . $texto . "%') or" . "\n\t\t(LOWER(autorTitulo.NomeAutor) like '%" . $texto . "%'))";
			
			$previous = true;
		}
		
		return $joins . $where;
	}
	public function getSQL($tipo, $campo, $idioma, $texto, $pagina, $quantidade) {
		$sql = "SELECT DISTINCT Titulo.Codigo, Titulo.Titulo, Titulo.SubTitulo, Titulo.NumeroChamada, " . "Titulo.PublicacaoLocal, Titulo.Edicao, Titulo.DescricaoFisica, Titulo.ISBN, Titulo.CodigoAutor, " . "Titulo.CodigoEditora, Titulo.Volume, Titulo.Area, Titulo.CodigoTipoTitulo, Titulo.Periodicidade, Titulo.Parte, Titulo.CodigoIdioma, " . "Titulo.NomeEditora, Titulo.NomeIdioma, Titulo.NomeTipoTitulo, AutorTitulo.NomeAutor AS AutorPrincipal, Titulo.PublicacaoData FROM Titulo";
		
		$where = "";
		$joins = "";
		$whereIdioma = "";
		$whereTipoTitulo = "";
		$previous = false;
		
		if ($idioma != 0) {
			if ($previous)
				$whereIdioma .= " AND ";
			else
				$whereIdioma .= "\n\tWHERE ";
			$previous = true;
			$whereIdioma .= " (Titulo.CodigoIdioma = " . idioma . getCodigoIdioma () . ")";
			$where .= $whereIdioma;
		}
		
		if ($tipo != 0) {
			if ($previous)
				$whereTipoTitulo .= " AND ";
			else
				$whereTipoTitulo .= "\n\tWHERE ";
			$previous = true;
			$whereTipoTitulo .= "(Titulo.CodigoTipoTitulo = " . $tipo . ")";
			$where .= whereTipoTitulo;
		}
		
		if ($campo != 0) {
			switch ($campo) {
				case "Titulo" :
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(Titulo.Titulo) like '%" . $texto . "%'\n\t)";
					$previous = true;
					break;
				case "Autor" :
					$joins .= "\n\tLEFT OUTER JOIN AutorTitulo ON AutorTitulo.CodigoTitulo = Titulo.Codigo" . "\n\tLEFT OUTER JOIN Autor ON Autor.Codigo = AutorTitulo.CodigoAutor";
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(Autor.Nome) like '%" . $texto . "%'\n)";
					$previous = true;
					break;
				
				case "Editora" :
					$joins .= "\n\tLEFT OUTER join Editora ON Editora.Codigo = Titulo.CodigoEditora";
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(Editora.Nome) like '%" . $texto . "%'\n)";
					$previous = true;
					break;
				case "Área" :
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(Titulo.Area) like '%" . $texto . "%'\n)";
					$previous = true;
					break;
				case "Assunto" :
					$joins .= "\n\tLEFT OUTER JOIN AssuntoTitulo ON AssuntoTitulo.CodigoTitulo = Titulo.Codigo" . "\n\tLEFT OUTER JOIN Assunto ON Assunto.Codigo = AssuntoTitulo.CodigoAssunto";
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\t(LOWER(Assunto.Nome) like '%" . $texto . "%')\n\t)";
					$previous = true;
					break;
				default :
					break;
			}
		} else {
			$joins .= "\n\tLEFT OUTER join Editora ON Editora.Codigo = Titulo.CodigoEditora" . "\n\tLEFT OUTER JOIN AutorTitulo ON (AutorTitulo.CodigoTitulo = Titulo.Codigo AND AutorTitulo.AutorPrincipal IS NOT NULL)" . "\n\tLEFT OUTER JOIN Autor ON Autor.Codigo = AutorTitulo.CodigoAutor" . "\n\tLEFT OUTER JOIN AssuntoTitulo ON AssuntoTitulo.CodigoTitulo = Titulo.Codigo" . "\n\tLEFT OUTER JOIN Assunto ON Assunto.Codigo = AssuntoTitulo.CodigoAssunto";
			
			if ($previous)
				$where .= " AND ";
			else
				$where .= "\n\t WHERE ";
			$where .= "(\n\t\t(LOWER(Assunto.Nome) like '%" . $texto . "%') or\n\t\t(LOWER(Autor.Nome) like '%" . $texto . "%') or\n\t\t(LOWER(Titulo.Area) like '%" . $texto . "%') or" . "\n\t\t(LOWER(Titulo.Titulo) like '%" . $texto . "%') or\n\t\t(LOWER(Editora.Nome) like '%" . $texto . "%')\n)";
			$previous = true;
		}
		
		$sql .= $joins . $where;
		$sql .= "\n ORDER BY Titulo.Codigo";
		$sql .= "\n LIMIT " . $quantidade . " OFFSET " . (($quantidade * $pagina) - $quantidade);
		return $sql;
	}
}