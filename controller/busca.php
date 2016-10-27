<?php
	require_once '../models/Titulo.php';
	require_once '../services/TituloService.php';
	
	$ts = new TituloService();
	print_r($ts->searchTitulos("teste")) ;