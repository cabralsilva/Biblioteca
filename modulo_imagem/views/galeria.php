<?php 
	require_once '../util/constantes.php';
	session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Upload de Arquivos</title>
<link rel="stylesheet"
	href="../resources/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet"
	href="../resources/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="../resources/css/style.css">
<script
	src="../resources/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script>
<script src="../resources/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script
	src="../resources/bootstrap-3.3.7-dist/js/bootstrap-waitingfor.js"></script>
</head>

<body>
	<div class="container text-center">
		<div class="row">
			<div class="col-xs-12 col-md-offset-4 col-md-4 col-sm-12">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php for ($_i=0; $_i<$_SESSION["total_arquivos"]; $_i++){?>
							<?php if ($_SESSION["files"][$_i] != '.' && $_SESSION["files"][$_i] != '..'){?>
								<li data-target="#myCarousel" data-slide-to="<?= $_i?>" class="<?= ($_i == 2)? "active":null?>"></li>
							<?php }?>
						<?php }?>
					</ol>
					<div class="carousel-inner" role="listbox">
						<?php if ($_SESSION["total_arquivos"] > 2){?>
							<?php for ($_i=0; $_i<$_SESSION["total_arquivos"]; $_i++){?>
								<?php if ($_SESSION["files"][$_i] != '.' && $_SESSION["files"][$_i] != '..'){?>
									<div class="item <?= ($_i == 2)? "active":null?>">
										<img class="foto-livro"
											src="<?= $_SESSION["diretorio"]?>/<?= $_SESSION["files"][$_i]?>?<?= time()?>"
											alt="Titulo">
									</div>
								<?php }?>
							<?php }?>
						<?php }else {?>
							<div class="item active">
								<img class="foto-livro"
									src="<?= BaseProjeto ?>/resources/images/sem-foto.gif"
									alt="Sem foto">
							</div>
						<?php }?>
					</div>

					<a class="left carousel-control" href="#myCarousel"
						role="button" data-slide="prev"> <span
						class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Anterior</span>
					</a> <a class="right carousel-control" href="#myCarousel"
						role="button" data-slide="next"> <span
						class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Próxima</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
