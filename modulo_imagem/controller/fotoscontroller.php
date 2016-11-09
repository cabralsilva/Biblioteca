<?php
	session_start();
	$_SESSION["files"] = scandir($_SESSION['s_caminho']);
	$_SESSION["total_arquivos"] = count($_SESSION['files']);
	header("Location: ../views/fotos.php");