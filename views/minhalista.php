<?php  
	require_once '../util/constantes.php';
	session_start();?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="<?= BaseProjeto ?>/resources/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet"
	href="<?= BaseProjeto ?>/resources/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<?= BaseProjeto ?>/resources/css/style.css">
<script src="<?= BaseProjeto ?>/resources/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>
<script src="<?= BaseProjeto ?>/resources/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script
	src="<?= BaseProjeto ?>/resources/bootstrap-3.3.7-dist/js/bootstrap-waitingfor.js"></script>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-3 col-sm-3 vcenter text-center ">
				<img src="<?= BaseProjeto ?>/resources/images/logo.png">
			</div>
			<div class="col-xs-12 col-md-8 col-sm-8 vcenter">
				<img class="bannerheader" src="<?= BaseProjeto ?>/resources/images/cabecalho.jpg">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
				<div class="btn-group btn-group-justified" role="group">
					<div class="btn-group" role="group">
						<a href="<?= BaseProjeto ?>/busca" class="btn btn-default" role="button"><span aria-hidden="true">&larr;</span> voltar</a>
					</div>
					<div class="btn-group" role="group">
						<a href="<?= BaseProjeto ?>/nova-busca" class="btn btn-default" role="button"><span class="glyphicon glyphicon-search"></span> nova busca</a>
					</div>
				</div>
			</div>
		</div>
		<div class="rowspace"></div>
		<div class="rowspace"></div>
		<div class="row impressao" id="tabela">
			<table id="datatable-result" class="table table-hover">
				<thead>
					<tr>
						<th width="2%" class="middle"><input id="123"
							class="checkAll noimpression" type="checkbox"
							onchange="toggleCheckboxAll(this)" <?= (count($_SESSION ["minhaListaAcervo"]) > 0) ? "checked" : null ?> /></th>
						<th width="10%"></th>
						<th width="80%" class="center">Minha Lista <span
							class="glyphicon glyphicon-book" aria-hidden="true"></span></th>
						<th width="10%"><button type="button"
								class="btn btn-default noimpression" onclick="imprimirTabela()">
								<span class="glyphicon glyphicon-print"></span> Imprimir
							</button></th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody id="bodyResult">
					<?php foreach ( $_SESSION ["minhaListaAcervo"] as $acervos ) {?>
						<tr>
							<td class="middle">
								<input id="<?= $acervos["Codigo"] ?>" class="check noimpression" type="checkbox" onchange="toggleCheckbox(this)" checked="checked" />
							</td>
							<td colspan="3">
								<b style="color: 0e4924;"> <?= $acervos["Titulo"] ?> <?= (($acervos["SubTitulo"] != null) ? " - " . $acervos["SubTitulo"] : "") ?></b>
								<b> - <?= $acervos["NomeTipoTitulo"] ?></b> - acervo <?= str_pad($acervos["Codigo"], 6, '0', STR_PAD_LEFT) ?>
								
								<br/> <?= $acervos["NomeAutorPrincipal"]?>.
								<b> <?= $acervos["Titulo"]?><?= (($acervos["SubTitulo"] != null) ? " - " . $acervos["SubTitulo"] : "") ?></b>. 
								<?= (($acervos["Edicao"] != null) ? " " . $acervos["Edicao"] . "ed." : "") ?>
								<?= $acervos["PublicacaoLocal"] . ": " . $acervos["NomeEditora"] . ", " . $acervos["PublicacaoData"] . (($acervos["DescricaoFisica"] != null ) ? ". " . $acervos["DescricaoFisica"] . "p." : "")?>
								<br/> Número de chamada: <?= $acervos["NumeroChamada"]?>
							</td>
							<td class="middle redirect">
								<a href="javascript:void(0)" onclick="redirectDetail(this);" data-codigo="<?= $acervos["Codigo"]?>"><span class="glyphicon glyphicon-forward noimpression" aria-hidden="true"></span></a>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
			<div class="progress hidden">
				<div class="progress-bar progress-bar-striped active"
					role="progressbar" aria-valuenow="100" aria-valuemin="0"
					aria-valuemax="100" style="width: 100%">Carregando...</div>
			</div>
		</div>
		<div class="footer">
			<div class="col-xs-12 col-md-12 col-sm-12 text-center">
				<a href="http://www.fasbam.edu.br/biblioteca/periodicos.php" target="_blank"><img
					src="<?= BaseProjeto ?>/resources/images/biblioteca-virtual.png"></a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function desmarcarLinha(parent, element){
			$.ajax({
				url: "<?= BaseProjeto ?>/controller/indexcontroller.php", 
				async: false,
				type: "POST",
				data:{
					tipo: "removeMinhaLista",
					codigoAcervo: $(element).attr("id")
				},
				success: function(success){
					console.log(success);
// 					console.log(JSON.parse(success));
		    	}
	    	});
		}
		
		function toggleCheckbox(element){
 			var parent = element.parentElement.parentNode;
			if (!element.checked)
				desmarcarLinha(parent, element);
			location.reload();
		}
		
		function toggleCheckboxAll(element){
			if(!element.checked){
				$(".check").each(function(){
					console.log("Eliminando");
					$(this).prop("checked", false);
					var parent = $(this).parent().parent();
					desmarcarLinha(parent, this);
				});
				location.reload();
			}
		}

		function imprimirTabela(){
			var conteudo = "";
			var html = "<!DOCTYPE html>"
						+ "<html lang=\"pt\">";
			html += document.getElementsByTagName('head')[0].innerHTML;
			html += "<body>";
			
			$(".impressao").each(function(){
				conteudo += this.innerHTML;
			});
			
			var conteudohtml = document.createElement("div");
			conteudohtml.innerHTML = conteudo;

			$(conteudohtml).find(".noimpression").each(function(){
				this.parentNode.removeChild(this);
			});

			conteudo = conteudohtml.outerHTML;			
			html += conteudo;
			html += "</body>";
			html += "</html>";
			
		 	tela_impressao = window.open('Resultado_busca');
            tela_impressao.document.write(html);
            
            tela_impressao.window.print();
            tela_impressao.window.close();
		}

		function redirectDetail(element){
			$.ajax({
				url: "<?= BaseProjeto ?>/controller/minhalistacontroller.php",
				type: "POST",
				async: false,
				data:{
					redirectDetail: $(element).attr("data-codigo")
				},
				success: function(retorno){
					window.location.href = "<?= BaseProjeto ?>/detalhamento";
		    	}
	    	});
		}
		
		$(document).ready(function(){
			
		});
	</script>
</body>
</html>