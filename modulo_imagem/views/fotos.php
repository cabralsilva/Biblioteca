<?php session_start();?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Upload de Arquivos</title>
<link rel="stylesheet"
	href="../resources/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet"
	href="../resources/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
<link rel="stylesheet"
	href="../resources/bootstrap-3.3.7-dist/css/equal-height-columns.css">
<link rel="stylesheet" href="../resources/css/style.css">
<link rel="stylesheet" href="../resources/css/style-upload-files.css">
<script src="../resources/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>
<script src="../resources/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>


<script src="../resources/js/jquery-1.7.2.js"></script>
<script src="../resources/js/jquery-ui-1.8.22.js"></script>
<script src="../resources/js/jquery.dialogextend.js"></script>
</head>

<body>
	<div class="container text-center">
		<div class="row">
			<form class="form-inline" action="../controller/postcontroller.php"
				method="post" name="formulario" enctype="multipart/form-data">
				<div class="form-group">
					<label for="exampleInputName2"><b>Arquivo Externo:</b></label> <input
						type="file" class="form-control" id="arquivo" name="arquivo"
						required data-max-size="450000"
						accept="image/x-png, image/gif, image/jpeg">
				</div>
				<button type="submit" class="btn btn-default">Enviar</button>
			</form>
		</div>
		<div class="row">
			<div id="divOP"></div>
			<div class="bodyfiles">
				<ul id="sortable_banner" class="sortable">
					<?php for ($_i=0; $_i<$_SESSION["total_arquivos"]; $_i++){?>
						<?php if ($_SESSION["files"][$_i] != '.' && $_SESSION["files"][$_i] != '..'){?>
							<li class="ui-state-default" id="<?=$_SESSION["files"][$_i]; ?>">
						<img
						src="<?= $_SESSION['s_caminho']?>/<?= $_SESSION["files"][$_i]?>?<?= time()?>">
						<p></p> <a href="javascript:void(0)"
						onclick="remove('../controller/removecontroller.php',{remove:'<?=$_SESSION["files"][$_i]?>'});">
							<img class="remover" src='../resources/img/remover.png'
							width="25px" height="25px" title="Excluir a Imagem" />
					</a>
					</li>
						<?php }?>
					<?php }?>
				</ul>
			</div>
		</div>
	</div>
	<script type="text/javascript"> 
		$('#sortable_banner').sortable({
			stop: function(event, ui) {
				$('#divOP').load('../controller/reordenacontroller.php', { 
					'ordem': $('#sortable_banner').sortable('toArray') 
				});						
			}
		});
		$('#sortable_banner').disableSelection();
		
		//EXCLUI A IMAGEM
		function remove(url, obj){
			//Define o formulário
			var myForm = document.createElement("form");
			myForm.action = url;
			myForm.method = "post";
		
			for(var key in obj) {
				 var input = document.createElement("input");
				 input.type = "hidden";
				 input.value = obj[key];
				 input.name = key;
				 myForm.appendChild(input);            
			}

			//Adiciona o form ao corpo do documento
			document.body.appendChild(myForm);

			//Envia o formulário
			if(confirm('Confirma Exclusão ?')) 
				myForm.submit();
		}
	</script>
</body>
</html>
