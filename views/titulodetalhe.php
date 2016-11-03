<?php session_start();?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="../resources/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet"
	href="../resources/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
<link rel="stylesheet"
	href="../resources/bootstrap-3.3.7-dist/css/equal-height-columns.css">
<link rel="stylesheet" href="../resources/css/style.css">
<script src="../resources/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>
<script src="../resources/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script
	src="../resources/bootstrap-3.3.7-dist/js/bootstrap-waitingfor.js"></script>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-3 col-sm-3 vcenter text-center ">
				<img src="../resources/images/logo.png">
			</div>
			<div class="col-xs-12 col-md-8 col-sm-8 vcenter">
				<img class="bannerheader" src="../resources/images/cabecalho.jpg">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
				<div class="btn-group btn-group-justified" role="group">
					<div class="btn-group" role="group">
						<a href="index.php" class="btn btn-default" role="button"><span aria-hidden="true">&larr;</span> voltar</a>
					</div>
					<div class="btn-group" role="group">
						<a href="../controller/indexcontroller.php" class="btn btn-default" role="button"><span class="glyphicon glyphicon-search"></span> nova busca</a>
					</div>
					<div class="btn-group" role="group">
						<a href="minhalista.php" class="btn btn-default" role="button">minha lista <span aria-hidden="true">&rarr;</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-5 col-sm-5">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<b>Detalhes do livro</b>
					</div>
					<div class="panel-body">
						<div class="text-center row">
							<img class="foto-livro" src="../resources/images/sem-foto.gif">
						</div>
						<table class="table table-hover">
							<tr>
								<td class="text-rigth "><b>Número de chamada:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["NumeroChamada"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Número do acervo:</b></td>
								<td class="largura60"><?= str_pad($_SESSION["acervoDetalhe"]["Codigo"], 6, '0', STR_PAD_LEFT)  ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Autor principal:</b></td>
								<td class="largura60"><a href="javascript:void(0)"
									onclick="novaBuscaComFiltro(this);" data-filtro="Autor"
									data-nome="<?= $_SESSION["acervoDetalhe"]["NomeAutorPrincipal"] ?>"><?= $_SESSION["acervoDetalhe"]["NomeAutorPrincipal"] ?></a></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Autor(es) secundários:</b></td>
								<td class="largura60"><?php foreach ($_SESSION["acervoDetalhe"]["AutoresSecundarios"] as $autorS){ ?>
						  			<a href="javascript:void(0)"
									onclick="novaBuscaComFiltro(this);" data-filtro="Autor"
									data-nome="<?= $autorS["NomeAutor"] ?>"><?= $autorS["NomeAutor"]; ?></a><br />
						  		<?php }?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Título:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["Titulo"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Subtítulo:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["SubTitulo"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Publicação:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["PublicacaoLocal"] ?> / <?= $_SESSION["acervoDetalhe"]["PublicacaoData"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Edição:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["Edicao"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Tipo:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["NomeTipoTitulo"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Editora:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["NomeEditora"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Número de páginas:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["DescricaoFisica"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Idioma:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["NomeIdioma"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Periodicidade:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["Periodicidade"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>ISBN:</b></td>
								<td class="largura60"><?= $_SESSION["acervoDetalhe"]["ISBN"] ?></td>
							</tr>
							<tr>
								<td class="text-rigth"><b>Assuntos:</b></td>
								<td class="largura60"><?php foreach ($_SESSION["acervoDetalhe"]["Assuntos"] as $assuntos){ ?>
						  			<a href="javascript:void(0)"
									onclick="novaBuscaComFiltro(this);" data-filtro="Assunto"
									data-nome="<?= $assuntos["NomeAssunto"] ?>"><?= $assuntos["NomeAssunto"]; ?></a><br />
						  		<?php }?></td>
							</tr>

						</table>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-7 col-sm-7">
				<div class="panel panel-default">
					<div class="panel-heading tabstitulo">
						<ul class="nav nav-tabs">
							<li class="active"><a class="tabslinkmenu" data-toggle="tab"
								href="#home">Referências</a></li>
							<li><a class="tabslinkmenu" data-toggle="tab" href="#menu1">Exemplares</a></li>
							<li><a class="tabslinkmenu" data-toggle="tab" href="#menu2">Reservas</a></li>
						</ul>
					</div>
					<div class="panel-body">
						<div class="tab-content">
							<div id="home" class="tab-pane fade in active">
								<br /> <?= $_SESSION["acervoDetalhe"]["NomeAutorPrincipal"]?>.
								<b> <?= $_SESSION["acervoDetalhe"]["Titulo"]?><?= (($_SESSION["acervoDetalhe"]["SubTitulo"] != null) ? " - " . $_SESSION["acervoDetalhe"]["SubTitulo"] : "") ?></b>. 
								<?= (($_SESSION["acervoDetalhe"]["Edicao"] != null) ? " " . $_SESSION["acervoDetalhe"]["Edicao"] . "ed." : "")?>
								<?= $_SESSION["acervoDetalhe"]["PublicacaoLocal"] . ": " . $_SESSION["acervoDetalhe"]["NomeEditora"] . ", " . $_SESSION["acervoDetalhe"]["PublicacaoData"] . ". " . $_SESSION["acervoDetalhe"]["DescricaoFisica"] . "p."?>
								
							</div>
							<div id="menu1" class="tab-pane fade">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Código</th>
											<th>Volume</th>
											<th>Tipo Emprest.</th>
											<th>Localização</th>
											<th>Empréstimo</th>
											<th>Devolução</th>
											<th>Artigos</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($_SESSION["acervoDetalhe"]["Exemplares"] as $exemplar){ ?>
								  			<tr>
											<td class="text-center"><?= str_pad($exemplar["Codigo"], 6, '0', STR_PAD_LEFT) ?></td>
											<td class="text-center"></td>
											<td class="text-center"></td>
											<td class="text-center"><?= $exemplar["Status"]?></td>
											<td class="text-center"></td>
											<td class="text-center"></td>
											<td class="text-center"></td>
										</tr>
								  		<?php }?>
									</tbody>

								</table>
							</div>
							<div id="menu2" class="tab-pane fade">
								<p>Função de reserva em breve disponível</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="footer">
		<div class="col-xs-12 col-md-12 col-sm-12 text-center">
			<a href="http://www.fasbam.edu.br/biblioteca/periodicos.php"
				target="_blank"><img
				src="../resources/images/biblioteca-virtual.png"></a>
		</div>
	</div>
	<script type="text/javascript">
	function novaBuscaComFiltro(element){
		$.ajax({
			url: "../controller/titulocontroller.php", 
			async: false,
			type: "POST",
			data:{
				filtro: $(element).attr("data-filtro"),
				texto: $(element).attr("data-nome")
			},
			success: function(success){
				window.location.href = "index.php";
	    	}
    	});
	}
	</script>
</body>
</html>