<?php

	function encodeNameImageUrl($urlImage){
		$nomeImagem = str_replace(".","_dot_",$urlImage);
		$nomeImagem = str_replace(":","_pp_",$nomeImagem);
		$nomeImagem = str_replace("%","_p_",$nomeImagem);
		$nomeImagem = str_replace("/","_",$nomeImagem);		
		$nomeImagem = str_replace("?","+",$nomeImagem);
		
		return $nomeImagem;
	}

	function decodeNameImageUrl($nomeImage){

		$url = str_replace("_dot_",".",$nomeImage);
		$url = str_replace("_pp_",":",$url);
		$url = str_replace("_p_","%",$url);
		$url = str_replace("_","/",$url);
		$url = str_replace("+","?",$url);
		return $url;
	}

	function encodeNameImage($nomeImage){
		$nomeImagem = str_replace(":","_",$nomeImage);
		$nomeImagem = str_replace("%","_",$nomeImagem);
		$nomeImagem = str_replace("/","_",$nomeImagem);		
		$nomeImagem = str_replace("?","_",$nomeImagem);
		$nomeImagem = str_replace("!","_",$nomeImagem);
		$nomeImagem = str_replace("*","_",$nomeImagem);
		
		return $nomeImagem;
	}
?>