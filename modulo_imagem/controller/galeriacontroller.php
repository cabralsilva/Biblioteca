<?php
	session_start();
	if(isset($_GET["pwd"])){
		if($_GET["pwd"] == "ibt3022"){
			$_SESSION["s_pasta"]        = $_GET['pasta'];
			$_SESSION["s_sub_pasta"]    = $_GET['sub_pasta'];
			$_SESSION['s_caminho'] = "../".$_SESSION["s_pasta"]."/".$_SESSION["s_sub_pasta"];
			$_SESSION["files"] = scandir($_SESSION['s_caminho']);
			$_SESSION["total_arquivos"] = count($_SESSION['files']);
			$_SESSION["diretorio"] = "../".$_SESSION["s_pasta"]."/".$_SESSION["s_sub_pasta"];
			header("Location: ../views/galeria.php");
		}else{
			echo "Not Authentication";
		}
	}else{
		echo "Fail Requisition";
	}