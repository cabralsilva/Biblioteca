<?php
	require_once '../models/Titulo.php';
	require_once '../services/TituloService.php';
	require_once '../services/IdiomaService.php';
	require_once '../services/TipoTituloService.php';
	session_start();
	if(isset($_POST["tipo"]) && isset($_POST["campo"]) && isset($_POST["idioma"]) && isset($_POST["texto"])){
		$ts = new TituloService();
		$pesquisa = array(
			"tipo" => $_POST["tipo"],
			"campo" => $_POST["campo"],
			"idioma" => $_POST["idioma"],
			"texto" => $_POST["texto"],
			"new" => FALSE
		);
		$_SESSION["formularioPesquisa"] = $pesquisa;
		if(isset($_POST["pagina"]) && isset($_POST["qtde_linhas"])){
			echo  json_encode($ts->searchTitulos($_POST["tipo"], $_POST["campo"], $_POST["idioma"], $_POST["texto"], $_POST["pagina"], $_POST["qtde_linhas"]));
		} else {
			$totalRegistros = $ts->getTotalRegistros($_POST["tipo"], $_POST["campo"], $_POST["idioma"], $_POST["texto"]);
			$_SESSION["totalRegistros"] = $totalRegistros;
			echo $totalRegistros;
		}
		
	}else{
		$pesquisa = array(
			"new" => TRUE
		);
		$_SESSION["formularioPesquisa"] = $pesquisa;
		$is = new IdiomaService();
		$tts = new TipoTituloService();
		$_SESSION["lstIdiomas"] = $is->getListIdiomas();
		$_SESSION["lstTipoTitulo"] = $tts->getListTipo();
		header("Location: ../views/index.php");
		exit();
	}
	