<?php 
	require_once '../util/constantes.php';
	session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Galeria de fotos</title>
<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
<link rel="stylesheet" type="text/css" href="../resources/galeria/style.css" />
<script type="text/javascript" src="../resources/galeria/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->

<!-- <link rel="stylesheet" -->
<!-- 	href="../resources/bootstrap-3.3.7-dist/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" -->
<!-- 	href="../resources/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css"> -->
<!-- <link rel="stylesheet" href="../resources/css/style.css"> -->
<!-- <script -->
<!-- 	src="../resources/bootstrap-3.3.7-dist/js/jquery-3.1.1.min.js"></script> -->
<!-- <script src="../resources/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> -->
<!-- <script -->
<!-- 	src="../resources/bootstrap-3.3.7-dist/js/bootstrap-waitingfor.js"></script> -->
</head>
<body style="/*background-color:#d7d7d7*/;margin:auto">
	<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container1">
		<div class="ws_images">
			<ul>	
				<?php for ($_i=0; $_i<$_SESSION["total_arquivos"]; $_i++){?>
					<?php if ($_SESSION["files"][$_i] != '.' && $_SESSION["files"][$_i] != '..'){?>
						<li style="text-align: center;">
							<img style="max-height: 200px; width: auto;" src="<?= $_SESSION["diretorio"]?>/<?= $_SESSION["files"][$_i]?>" alt="Titulo" title="" id="wow1_<?= (($_i-2) + 1)?>">
						</li>
					<?php }?>
				<?php }?>
			</ul>
		</div>
		<div class="ws_bullets">
			<div>
				<?php for ($_i=0; $_i<$_SESSION["total_arquivos"]; $_i++){?>
					<?php if ($_SESSION["files"][$_i] != '.' && $_SESSION["files"][$_i] != '..'){?>
						<a href="#" title="<?= ($_i-1)?>"><span><?= ($_i-1)?></span></a>
					<?php }?>
				<?php }?>
			</div>
		</div>
		<div class="ws_script" style="/*position:absolute;left:-99%*/"><a href="http://wowslider.com">wowslider.com</a> by WOWSlider.com v8.7</div>
		<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="../resources/galeria/wowslider.js"></script>
	<script type="text/javascript" src="../resources/galeria/script.js"></script>
	<!-- End WOWSlider.com BODY section -->

</body>


</html>
