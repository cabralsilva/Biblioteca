<?php	
	/************************/
	require_once("../util/funcoes.php");
	session_start(); 
	$pasta        = $_SESSION["s_pasta"];

	function tirarAcentosER($string){
	    return preg_replace(array("/(Ã¡|Ã |Ã£|Ã¢|Ã¤)/","/(Ã|Ã€|Ãƒ|Ã‚|Ã„)/","/(Ã©|Ã¨|Ãª|Ã«)/","/(Ã‰|Ãˆ|ÃŠ|Ã‹)/","/(Ã­|Ã¬|Ã®|Ã¯)/","/(Ã|ÃŒ|ÃŽ|Ã)/","/(Ã³|Ã²|Ãµ|Ã´|Ã¶)/","/(Ã“|Ã’|Ã•|Ã”|Ã–)/","/(Ãº|Ã¹|Ã»|Ã¼)/","/(Ãš|Ã™|Ã›|Ãœ)/","/(Ã±)/","/(Ã‘)/","/(Ã§)/"),
			explode(" ","a A e E i I o O u U n N c"),$string);
    }

	$sub_pasta = $_SESSION["s_sub_pasta"]; 
	$nome_inicial = $_SESSION["s_nome_inicial"];
	//Caminho da pasta 
	if($pasta == "produtos" || $pasta == "arquivos"){
		$caminho = "../".$pasta."/".$sub_pasta;
		$_SESSION['s_caminho'] = $caminho;
		$nome_inicial = encodeNameImage($nome_inicial);
	}elseif($pasta == "banners"){
		$caminho = "../".$pasta."/".$sub_pasta;
		$_SESSION['s_caminho'] = $caminho;
	}
	
	$diretorio = "../".$pasta."/".$sub_pasta."/";
	$contents = array();
	$files = scandir($diretorio); 
	foreach($files as $file)
	{
	    if(is_file($diretorio."/".$file)){
	        array_push($contents, $file);
	    }
	}
	sort($contents);
	$total = count($contents);	

	//quando for produto entra nessas condicoes
	if($pasta == "produtos" || $pasta == "arquivos"){
		$contents_actual = array();
		$files = scandir($caminho); 
		foreach($files as $file)
		{
		    if(is_file($caminho."/".$file)){
		        array_push($contents_actual, $file);
		    }
		}
		$total = count($contents_actual);
		for($_i=0; $_i<$total; $_i++){
			$cont_img = $_i;
			//nome inicial que foi definido + o contador que com isso vai ser o nome da nova imagem
			$_images2[$cont_img] = "$nome_inicial" . $_i . ".jpg";
			//lista o arquivo antigo para ser alterado
			$contents = scandir($diretorio);	
			$old_file = $caminho."/".$_REQUEST['ordem'][$_i];
			$new_file = $caminho."/temp_".$_i.".jpg";
			rename($old_file, $new_file);		
		}
		//renomeia os temporarios
		for ($_iii=0; $_iii<$total; $_iii++){
			$old_files = "$caminho/temp_".$_iii.".jpg";  
			$jjj = $_iii+1;
			$new_files = "$caminho/{$nome_inicial}".$jjj.".jpg";  
			$new_files = tirarAcentosER($new_files);		
			rename($old_files, $new_files);				
		}
	}
	
	//quando for banner entra nessa condicao	
	if($pasta == "banners"){
		$contents_actual = array();
		$files = scandir($caminho); 
		foreach($files as $file)
		{
		    if(is_file($caminho."/".$file)){
		    	//echo "$file<br/>";
		        array_push($contents_actual, $file);
		    }
		}
		$total = count($contents_actual);	

		for ($_i=0; $_i<$total; $_i++){			
			
			$old_files = $_REQUEST['ordem'][$_i];	
			$old_files = str_replace($caminho, '', $old_files); 			
			
			$under = substr($old_files, 1, 1);
			if($under == "_"){
				$new_files = $caminho."/".($_i + 1)."_".substr($old_files, 2);
			}else{
				$new_files = $caminho."/".($_i + 1)."_".$old_files;  
			}
			$old_files = $caminho."/".$old_files;
			$new_files = tirarAcentosER($new_files);
			foreach($contents_actual as $file){
				$ordem = substr($file, 0, 1);
				if ($ordem == (int)($_i+1)){
					$atual = $caminho."/".$file;
					if ($new_files != $atual){
						if(! rename($old_files, $new_files)){
							echo "Falha ao renomear<br>";
						}
					}
				}
			}
		}
	}

?>  
<script type="text/javascript">
	window.location.reload(true);
</script>