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
			
// 			$var = $this->getAutorPrincipal($linha["Codigo"]);
// 			$linha["NomeAutorPrincipal"] = $var["Nome"];
// 			$var = $this->getTipoTitulo ( $linha ["CodigoTipoTitulo"] );
// 			$linha["NomeTipoTitulo"] =  $var["Nome"];
// 			$var = $this->getIdioma ( $linha ["CodigoIdioma"] );
// 			$linha["NomeIdioma"] =  $var["Nome"];
			if ($linha ["Codigo"] != null){
				$var = $this->getAutorPrincipal($linha["Codigo"]);
				$linha["NomeAutorPrincipal"] = $var["Nome"];
			}else $linha["NomeAutorPrincipal"] = "";
			
			if ($linha ["CodigoTipoTitulo"] != null){
				$var = $this->getAutorPrincipal($linha["CodigoTipoTitulo"]);
				$linha["NomeTipoTitulo"] = $var["Nome"];
			}else $linha["NomeTipoTitulo"] = "";
			
			if ($linha ["CodigoEditora"] != null){
				$var = $this->getEditora ( $linha ["CodigoEditora"] );
				$linha["NomeEditora"] =  $var["Nome"];
			}else $linha["NomeEditora"] =  "";
			
			if ($linha ["CodigoIdioma"] != null){
				$var = $this->getEditora ( $linha ["CodigoIdioma"] );
				$linha["NomeIdioma"] =  $var["Nome"];
			}else $linha["NomeIdioma"] =  "";
			
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
	public function getAutoresSecundarios($codigoTitulo) {
		$sql = "SELECT autor.Nome FROM autor"
				. " INNER JOIN autortitulo ON (autortitulo.CodigoAutor = autor.Codigo)"
				. " WHERE autortitulo.CodigoTitulo = " . $codigoTitulo . " AND autortitulo.AutorPrincipal IS NULL";
		$buscaAutores = $this->banco->getConexaoBanco ()->query ( $sql );
		$autores = array ();
		
		while ( $linha = $buscaAutores->fetch_array ( MYSQLI_ASSOC ) ) {
			array_push ( $autores, $linha );
		}
		$buscaAutores->close ();
		return $autores;
	}
	public function getAssuntosTitulo($codigoTitulo) {
		$sql = "SELECT assunto.Nome FROM assunto"
				. " INNER JOIN assuntotitulo ON assuntotitulo.CodigoAssunto = assunto.Codigo"
			. " WHERE assuntotitulo.CodigoTitulo = " . $codigoTitulo;
		
		$buscaAssuntos = $this->banco->getConexaoBanco ()->query ( $sql );
		$assuntos = array ();
		
		while ( $linha = $buscaAssuntos->fetch_array ( MYSQLI_ASSOC ) ) {
			array_push ( $assuntos, $linha );
		}
		$buscaAssuntos->close ();
		return $assuntos;
	}
	public function getExemplares($codigoTitulo) {
		$sql = "SELECT exemplar.Codigo, exemplar.Status FROM exemplar WHERE exemplar.CodigoTitulo = " . $codigoTitulo;
		$buscaExemplares = $this->banco->getConexaoBanco ()->query ( $sql );
		$exemplares = array ();
		
		while ( $linha = $buscaExemplares->fetch_array ( MYSQLI_ASSOC ) ) {
			array_push ( $exemplares, $linha );
		}
		$buscaExemplares->close ();
		return $exemplares;
	}
	private function getAutorPrincipal($codigoTitulo) {
		$sql = "SELECT autor.Nome FROM autor"
				. " INNER JOIN autortitulo ON (autortitulo.CodigoAutor = autor.Codigo)"
				. " WHERE autortitulo.CodigoTitulo = " . $codigoTitulo . " AND autortitulo.AutorPrincipal IS NOT NULL";
		$buscaAutor = $this->banco->getConexaoBanco ()->query ( $sql );
		if (! $buscaAutor)
			echo mysql_error ();
		$retorno = $buscaAutor->fetch_array ( MYSQLI_ASSOC );
		$buscaAutor->close ();
		return $retorno;
	}
	private function getTipoTitulo($codigoTipoTitulo) {
		$sql = "SELECT tipotitulo.Nome FROM tipotitulo WHERE tipotitulo.Codigo = " . $codigoTipoTitulo;
		$buscaTipo = $this->banco->getConexaoBanco ()->query ( $sql );
		if (! $buscaTipo)
			echo mysql_error ();
		$retorno = $buscaTipo->fetch_array ( MYSQLI_ASSOC );
		$buscaTipo->close ();
		return $retorno;
	}
	private function getEditora($codigoEditora) {
		$sql = "SELECT editora.Nome FROM editora WHERE editora.Codigo = " . $codigoEditora;
		$buscaEditora = $this->banco->getConexaoBanco ()->query ( $sql );
		if (! $buscaEditora)
			echo mysql_error ();
		$retorno = $buscaEditora->fetch_array ( MYSQLI_ASSOC );
		$buscaEditora->close ();
		return $retorno;
	}
	private function getIdioma($codigoIdioma) {
		$sql = "SELECT idioma.Nome FROM idioma WHERE idioma.Codigo = " . $codigoIdioma;
		$buscaIdioma= $this->banco->getConexaoBanco ()->query ( $sql );
		if (! $buscaIdioma)
			echo mysql_error ();
		$retorno = $buscaIdioma->fetch_array ( MYSQLI_ASSOC );
		$buscaIdioma->close ();
		return $retorno;
	}
	private function getSQLContagem($tipo, $campo, $idioma, $texto) {
		$sql = "SELECT COUNT(DISTINCT titulo.Codigo) AS TOTAL FROM titulo";
		$sql .= $this->getSQLCondicoes ( $tipo, $campo, $idioma, $texto );
		return $sql;
	}
	private function getSQLRegistros($tipo, $campo, $idioma, $texto, $pagina, $quantidade) {
		$sql = "SELECT DISTINCT titulo.Codigo, titulo.Titulo, titulo.SubTitulo, titulo.NumeroChamada, " 
				. "titulo.PublicacaoLocal, titulo.Edicao, titulo.DescricaoFisica, titulo.ISBN, titulo.CodigoAutor, " 
				. "titulo.CodigoEditora, titulo.Volume, titulo.Area, titulo.CodigoTipoTitulo, titulo.Periodicidade, titulo.Parte, titulo.CodigoIdioma, " 
				. "titulo.CodigoEditora, titulo.CodigoTipoTitulo, titulo.PublicacaoData FROM titulo";
		
		$sql .= $this->getSQLCondicoes ( $tipo, $campo, $idioma, $texto );
		$sql .= "\n ORDER BY titulo.Codigo";
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
					$joins .= "\n\tINNER JOIN autortitulo ON autortitulo.CodigoTitulo = titulo.Codigo" 
							. "\n\tINNER JOIN autor ON autor.Codigo = autortitulo.CodigoAutor";
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(autor.Nome) like '%" . $texto . "%'\n)";
					$previous = true;
					break;
				
				case "Editora" :
					$joins .= "\n\tINNER JOIN editora ON titulo.CodigoEditora = editora.Codigo";
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\tLOWER(editora.Nome) like '%" . $texto . "%'\n)";
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
					$joins .= "\n\tINNER JOIN assuntotitulo ON assuntotitulo.CodigoTitulo = titulo.Codigo" 
							. "\n\tINNER JOIN assunto ON assunto.Codigo = assuntotitulo.CodigoAssunto";
					if ($previous)
						$where .= " AND ";
					else
						$where .= "\n\t WHERE ";
					$where .= "(\n\t\t(LOWER(assunto.Nome) like '%" . $texto . "%')\n\t)";
					$previous = true;
					break;
				default :
					break;
			}
		} else {
			$joins .= "\n\tINNER JOIN assuntotitulo ON assuntotitulo.CodigoTitulo = titulo.Codigo" 
					. "\n\tINNER JOIN autortitulo ON autortitulo.CodigoTitulo = titulo.Codigo" 
					. "\n\tINNER JOIN assunto ON assunto.Codigo = assuntotitulo.CodigoAssunto" 
					. "\n\tINNER JOIN autor ON autor.Codigo = autortitulo.CodigoAutor"
					. "\n\tINNER JOIN editora ON editora.Codigo = titulo.CodigoEditora";
			
			if ($previous)
				$where .= " AND ";
			else
				$where .= "\n\t WHERE ";
			$where .= "\n\t\t((LOWER(titulo.Area) like '%" . $texto . "%') or" 
					. "\n\t\t(LOWER(titulo.Titulo) like '%" . $texto . "%') or" 
					. "\n\t\t(LOWER(editora.Nome) like '%" . $texto . "%') or" 
					. "\n\t\t(LOWER(assunto.Nome) like '%" . $texto . "%') or" 
					. "\n\t\t(LOWER(autor.Nome) like '%" . $texto . "%'))";
			
			$previous = true;
		}
		
		return $joins . $where;
	}
	public function getSQL($tipo, $campo, $idioma, $texto, $pagina, $quantidade) {
		$sql = "SELECT DISTINCT titulo.Codigo, titulo.Titulo, titulo.SubTitulo, titulo.NumeroChamada, " . "titulo.PublicacaoLocal, titulo.Edicao, titulo.DescricaoFisica, titulo.ISBN, titulo.CodigoAutor, " . "titulo.CodigoEditora, titulo.Volume, titulo.Area, titulo.CodigoTipoTitulo, titulo.Periodicidade, titulo.Parte, titulo.CodigoIdioma, " . "titulo.NomeEditora, titulo.NomeIdioma, titulo.NomeTipoTitulo, autortitulo.NomeAutor AS AutorPrincipal, titulo.PublicacaoData FROM titulo";
		
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