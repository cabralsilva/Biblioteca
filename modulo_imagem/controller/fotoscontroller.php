<?php
	session_start();
	$_SESSION["files"] = scandir($_SESSION['s_caminho']);
	$_SESSION["total_arquivos"] = count($_SESSION['files']);
	$_SESSION["hasaction"] = 1;
 	header("Location: ../views/fotos.php");