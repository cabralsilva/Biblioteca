<?php
	require_once '../services/TituloService.php';
	session_start();
	if(isset($_POST["redirectDetail"])){
		foreach ($_SESSION["minhaListaAcervo"] as $acervo){
			if ($acervo["Codigo"] == $_POST["redirectDetail"]){
				$ts = new TituloService();
				$acervo["AutoresSecundarios"] = $ts->getAutoresSecundarios($_POST["redirectDetail"]);
				$acervo["Assuntos"] = $ts->getAssuntosTitulo($_POST["redirectDetail"]);
				$acervo["Exemplares"] = $ts->getExemplares($_POST["redirectDetail"]);
				$_SESSION["acervoDetalhe"] = $acervo;
				echo json_encode($acervo);
			}
		}
// 		echo "{\"1\": \"Datniel\"}";
	}else{ 
		header("Location: ../views/index.php");
		exit();
	}
	