<?php
	session_start();
	if(isset($_POST["filtro"]) && isset($_POST["texto"])){
		$pesquisa["page"] = $_POST["pagina"];
		$_SESSION["formularioPesquisa"]["campo"] = $_POST["filtro"];
		$_SESSION["formularioPesquisa"]["texto"] = $_POST["texto"];
		$_SESSION["formularioPesquisa"]["new"] = FALSE;
		$_SESSION["formularioPesquisa"]["page"] = 1;
	}else{ 
		header("Location: ../views/index.php");
		exit();
	}
	