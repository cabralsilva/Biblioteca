<?php
	require_once '../models/Titulo.php';
	require_once '../services/TituloService.php';
	require_once '../services/IdiomaService.php';
	require_once '../services/TipoTituloService.php';
	session_start();
	if(isset($_POST["tipo"]) && isset($_POST["campo"]) && isset($_POST["idioma"]) && isset($_POST["texto"])){ //REALIZAR CONTAGEM DE REGISTROS
		$ts = new TituloService();
		$pesquisa = array(
			"tipo" => $_POST["tipo"],
			"campo" => $_POST["campo"],
			"idioma" => $_POST["idioma"],
			"texto" => $_POST["texto"],
			"new" => FALSE
		);
		
		if(isset($_POST["pagina"]) && isset($_POST["qtde_linhas"])){ //BUSCA DE REGISTROS
			$listaRetorno = $ts->searchTitulos($_POST["tipo"], $_POST["campo"], $_POST["idioma"], $_POST["texto"], $_POST["pagina"], $_POST["qtde_linhas"]);
			$_SESSION["listaAcervo"] = array();
			foreach ($listaRetorno as $key => $acervo){
				$acervo["marcado"] = FALSE;
				foreach ($_SESSION["minhaListaAcervo"] as $meuAcervo){
					if ($meuAcervo["Codigo"] == $acervo["Codigo"]){
						$acervo["marcado"] = TRUE;
						break;
					}
				}
				$listaRetorno[$key]["marcado"] = $acervo["marcado"];
				array_push($_SESSION["listaAcervo"], $acervo);
			}
			$pesquisa["page"] = $_POST["pagina"];
			$_SESSION["formularioPesquisa"] = $pesquisa;
			$listaRetorno["formularioPesquisa"] = $_SESSION["formularioPesquisa"];
			echo json_encode($listaRetorno);
		} else { //REALIZAR CONTAGEM DE REGISTROS
			$totalRegistros = $ts->getTotalRegistros($_POST["tipo"], $_POST["campo"], $_POST["idioma"], $_POST["texto"]);
			$_SESSION["totalRegistros"] = $totalRegistros;
			
			echo $totalRegistros;
		}
		
	}elseif (isset($_POST["tipo"]) && isset($_POST["codigoAcervo"])){  //ADD/REMOVER MINHA LISTA
		if ($_POST["tipo"] == "addMinhaLista"){
			foreach ($_SESSION["listaAcervo"] as $acervo){
				if ($acervo["Codigo"] == $_POST["codigoAcervo"]){
					$existe = false;
					foreach ($_SESSION["minhaListaAcervo"] as $meuAcervo){
						if ($meuAcervo["Codigo"] == $_POST["codigoAcervo"]){
							$existe = true;
							break;
						}	
					}
					if(!$existe) 
						array_push($_SESSION["minhaListaAcervo"], $acervo);
					break;
				}
			}
		}elseif ($_POST["tipo"] == "removeMinhaLista"){
			foreach ($_SESSION["minhaListaAcervo"] as $key => $meuAcervo){
				if ($meuAcervo["Codigo"] == $_POST["codigoAcervo"]){
					unset($_SESSION["minhaListaAcervo"][$key]);
					break;
				}
			}
		}
		echo json_encode($_SESSION["minhaListaAcervo"]);
	}elseif(isset($_POST["isNew"])){
		echo json_encode($_SESSION["formularioPesquisa"]);
	}elseif(isset($_POST["redirectDetail"])){
		foreach ($_SESSION["listaAcervo"] as $acervo){
			if ($acervo["Codigo"] == $_POST["redirectDetail"]){
				$ts = new TituloService();
				
				$acervo["AutoresSecundarios"] = $ts->getAutoresSecundarios($_POST["redirectDetail"]);
				$acervo["Assuntos"] = $ts->getAssuntosTitulo($_POST["redirectDetail"]);
				$acervo["Exemplares"] = $ts->getExemplares($_POST["redirectDetail"]);
				$_SESSION["acervoDetalhe"] = $acervo;
				$_SESSION["diretorio"] = "../modulo_imagem/arquivos/".$acervo["Codigo"];
				$_SESSION["files"] = scandir($_SESSION["diretorio"]);
				$_SESSION["total_arquivos"] = count($_SESSION['files']);
				$_SESSION["diretorio"] = str_replace("..", "/fasbam", $_SESSION["diretorio"]);
				echo json_encode($acervo);
			}
		}
	}else{ //LIMPAR FORMULÁRIO PARA NOVA BUSCA
		$_SESSION["acervoDetalhe"] = null;
		$pesquisa = array(
			"new" => TRUE
		);
		$_SESSION["formularioPesquisa"] = $pesquisa;
		$is = new IdiomaService();
		$tts = new TipoTituloService();
		$_SESSION["lstIdiomas"] = $is->getListIdiomas();
		$_SESSION["lstTipoTitulo"] = $tts->getListTipo();
		
		if(count($_SESSION["minhaListaAcervo"]) == 0) $_SESSION["minhaListaAcervo"] = array();
		header("Location: /fasbam/busca");
		exit();
	}
	