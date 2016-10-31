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
		<form id="frm-pesquisa" name="frm-pesquisa" class="form-inline">
			<div class="row text-center">
				<label for="tipo">Tipo</label> <select id="tipo"
					class="form-control">
					<option value="0" selected="selected">Todos</option>
					<?php
					
foreach ( $_SESSION ["lstTipoTitulo"] as $value ) {
						echo "<option value=\"" . $value ["Codigo"] . "\">" . $value ["Nome"] . "</option>";
					}
					?>
				</select> <label for="campo">Campo</label> <select id="campo"
					class="form-control">
					<option value="0" selected="selected">Todos</option>
					<option value="1">Titulo</option>
					<option value="2">Autor</option>
					<option value="3">Editora</option>
					<option value="4">Área</option>
					<option value="5">Assunto</option>
				</select> <label for="idioma">Idioma</label> <select id="idioma"
					class="form-control">
					<option value="0" selected="selected">Todos</option>
					<?php
					
foreach ( $_SESSION ["lstIdiomas"] as $value ) {
						echo "<option value=\"" . $value ["Codigo"] . "\">" . $value ["Nome"] . "</option>";
					}
					?>
				</select> <br /> <br />
				<div class="text-center">
					<input minlength=3 required
						onkeydown="if (event.keyCode == 13) {document.frm-pesquisa.submit(); return false;}"
						class="form-control" style="width: 50%;"
						placeholder="O que procura?" id="texto" type="text">
					<!--					<button onclick="searchTitulo()" type="button"-->
					<!-- 						class="btn btn-default">Pesquisar</button> -->
					<button type="submit" class="btn btn-default">Pesquisar</button>
				</div>
			</div>

		</form>
		<hr />
		<div class="row paginacao">
			<div class="col-xs-12 col-md-12 col-sm-12 text-center">
				<nav aria-label="Page navigation">
					<ul class="pagination" id="paginator">
						<li onclick="changePage(this)" data-firs="0"
							class="disabled previous" id="first-page"><a
							href="javascript:void(0)"><span aria-hidden="true">&larr;</span>
								Primeiro</a></li>
						<li onclick="changePage(this)" data-prev="0" class="disabled"
							id="previous-page"><a href="javascript:void(0)"
							aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a></li>
						<li onclick="changePage(this)" data-page="1"
							class="active disabled"><a href="javascript:void(0)">1</a></li>
						<li onclick="changePage(this)" data-next="2" id="next-page"
							class="disabled"><a href="javascript:void(0)" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
						</a></li>
						<li onclick="changePage(this)" data-last="2" class="next disabled"
							id="last-page"><a href="javascript:void(0)">Último <span
								aria-hidden="true">&rarr;</span></a></li>

					</ul>
				</nav>
			</div>
		</div>

		<div class="row indices">
			<div class="col-xs-12 col-md-12 col-sm-12 text-center" id="indices"></div>
		</div>
		<div class="row">
			<table id="datatable-result" class="table table-hover">
				<thead>
					<tr>
						<th width="2%" class="middle"><input id="123" class="checkAll"
							type="checkbox" onchange="toggleCheckboxAll(this)" /></th>
						<th width="10%"><span class="glyphicon glyphicon-list-alt"
							aria-hidden="true"></span>0 item(ns)</th>
						<th width="80%" class="center">Acervo <span
							class="glyphicon glyphicon-book" aria-hidden="true"></span></th>
						<th width="10%"></th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody id="bodyResult">

					<!-- 					<tr> -->
					<!-- 						<td class="middle"><input id="123" class="check" type="checkbox" -->
					<!-- 							onchange="toggleCheckbox(this)" /></td> -->
					<!--						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala -
<!-- 								formação da família brasileira sob o regime da economia -->
					<!-- 								patriarcal</b> - <b>Livro</b> - acervo - 5168<br> FREYRE, -->
					<!-- 							Gilberto <b>Casa grande e senzala formação da família brasileira -->
					<!-- 								sob o regime da economia patriarcal</b>. 36ed. São Paulo: -->
					<!-- 							Record, . 569p.<br> Número de Chamada: 981 F894c</td> -->
					<!-- 						<td class="middle"><span class="glyphicon glyphicon-search" -->
					<!-- 							aria-hidden="true"></span></td> -->
					<!-- 					</tr> -->
					<!-- 					<tr> -->
					<!-- 						<td class="middle"><input id="123" class="check" type="checkbox" -->
					<!-- 							onchange="toggleCheckbox(this)" /></td> -->
					<!--						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala -
<!-- 								formação da família brasileira sob o regime da economia -->
					<!-- 								patriarcal</b> - <b>Livro</b> - acervo - 5168<br> FREYRE, -->
					<!-- 							Gilberto <b>Casa grande e senzala formação da família brasileira -->
					<!-- 								sob o regime da economia patriarcal</b>. 36ed. São Paulo: -->
					<!-- 							Record, . 569p.<br> Número de Chamada: 981 F894c</td> -->
					<!-- 						<td class="middle"><span class="glyphicon glyphicon-search" -->
					<!-- 							aria-hidden="true"></span></td> -->
					<!-- 					</tr> -->
				</tbody>
			</table>
			<div class="progress hidden">
				<div class="progress-bar progress-bar-striped active"
					role="progressbar" aria-valuenow="100" aria-valuemin="0"
					aria-valuemax="100" style="width: 100%">Carregando...</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var page = 1;
		var totalRegistos = 0;
		var totalPaginas = 0;
		var firstRegisterPage = 1;
		var lastRegisterPage = 1;
		var novaPesquisa = true;

		var tipo;
		var campo;
		var idioma;
		var texto;
		
		function getLast(){
			return totalRegistos;
		}
		function marcarLinha(parent){
			$(parent).removeClass("linha");
			$(parent).addClass("linha-marcada");
		}
		function desmarcarLinha(parent){
			$(parent).removeClass("linha-marcada");
			$(parent).addClass("linha");
			$(".checkAll").prop("checked", false);
		}
		
		function toggleCheckbox(element){
 			var parent = element.parentElement.parentNode;
			if (element.checked)
				marcarLinha(parent);
			else
				desmarcarLinha(parent);
		}
		
		function toggleCheckboxAll(element){
			if(element.checked){
				$(".check").each(function(){
					$(this).prop("checked", true);
					var parent = $(this).parent().parent();
					marcarLinha(parent);
				});
			}else{
				$(".check").each(function(){
					$(this).prop("checked", false);
					var parent = $(this).parent().parent();
					desmarcarLinha(parent);
				});
			}
		}

		function changePage(element){
			var pageAnterior = page;
			if(!element.classList.contains("disabled")){
				if($(element).data("next") != undefined){
					var parent = element.parentElement;
					$(parent).find("> li").each(function() {
						if($(this).data("prev") != undefined){
							var previous = parseInt($(element).attr("data-next")) - 5;
							this.setAttribute("data-prev", previous);
							if (previous < 1)
								$(this).addClass("disabled");
							else
								$(this).removeClass("disabled");		
						}else if($(this).data("page") != undefined){
							var link = "<a href=\"javascript:void(0)\">" + (parseInt($(this).attr("data-page")) + 1) + "</a>";
							this.setAttribute("data-page", (parseInt($(this).attr("data-page")) + 1));
							this.innerHTML = link;
							if ($(this).attr("data-page") == parseInt($(element).attr("data-next")))
								$(this).addClass("active");
							else
								$(this).removeClass("active");
						}else if($(this).data("next") != undefined){
							var next = parseInt($(element).attr("data-next")) + 1;
							this.setAttribute("data-next", next);
							if (next > totalPaginas){
								$(this).addClass("disabled");
							}
						}else if($(this).data("firs") != undefined){
							$(this).removeClass("disabled");
						}else if($(this).data("last") != undefined){
							if((parseInt($("#next-page").attr("data-next"))+1) > totalPaginas)
								$(this).addClass("disabled");
						}
					});
					page = parseInt($(element).attr("data-next")) - 1;
				}else if($(element).data("prev") != undefined){
					var parent = element.parentElement;
					$(parent).find("> li").each(function() {
						if($(this).data("prev") != undefined){
							var previous = parseInt($(element).attr("data-prev")) - 1;
							this.setAttribute("data-prev", previous);
							if (previous < 1)
								$(this).addClass("disabled");
							else
								$(this).removeClass("disabled");		
						}else if($(this).data("page") != undefined){
							var link = "<a href=\"javascript:void(0)\">" + (parseInt($(this).attr("data-page")) - 1) + "</a>";
							this.setAttribute("data-page", (parseInt($(this).attr("data-page")) - 1));
							this.innerHTML = link;
							if ($(this).attr("data-page") == parseInt($(element).attr("data-prev"))+1)
								$(this).addClass("active");
							else
								$(this).removeClass("active");
						}else if($(this).data("next") != undefined){
							var next = parseInt($(this).attr("data-next")) - 1;
							this.setAttribute("data-next", next);
							$(this).removeClass("disabled");
						}else if($(this).data("firs") != undefined){
							if((parseInt($("#previous-page").attr("data-prev"))-1) < 1)
								$(this).addClass("disabled");
						}else if($(this).data("last") != undefined){
							$(this).removeClass("disabled");
						}
					});
					page = parseInt($(element).attr("data-prev")) + 1;
				}else if($(element).data("firs") != undefined){
					var parent = element.parentElement;
					var i = 1;
					$(parent).find("> li").each(function() {
						if($(this).data("prev") != undefined){
							var previous = 0;
							this.setAttribute("data-prev", previous);
							if (previous < 1)
								$(this).addClass("disabled");
							else
								$(this).removeClass("disabled");		
						}else if($(this).data("page") != undefined){
							var link = "<a href=\"javascript:void(0)\">" + i + "</a>";
							this.setAttribute("data-page", i);
							this.innerHTML = link;
							if ($(this).attr("data-page") == 1)
								$(this).addClass("active");
							else
								$(this).removeClass("active");
							i++;
						}else if($(this).data("next") != undefined){
							var next = 6;
							this.setAttribute("data-next", next);
							$(this).removeClass("disabled");
						}else if($(this).data("firs") != undefined){
							$(this).addClass("disabled");
						}else if($(this).data("last") != undefined){
							$(this).removeClass("disabled");
						}
					});
					page = parseInt($(element).attr("data-firs")) + 1;
				}else if($(element).data("last") != undefined){
					var parent = element.parentElement;
					var i = parseInt($("#last-page").attr("data-last")) - 5;
					$(parent).find("> li").each(function() {
						if($(this).data("prev") != undefined){
							var previous = i;
							this.setAttribute("data-prev", previous);
							if (previous < 1)
								$(this).addClass("disabled");
							else
								$(this).removeClass("disabled");		
						}else if($(this).data("page") != undefined){
							var link = "<a href=\"javascript:void(0)\">" + (i+1) + "</a>";
							this.setAttribute("data-page", (i+1));
							this.innerHTML = link;
							if ($(this).attr("data-page") == totalPaginas)
								$(this).addClass("active");
							else
								$(this).removeClass("active");
							i++;
						}else if($(this).data("next") != undefined){
							this.setAttribute("data-next", (totalPaginas + 1));
							$(this).addClass("disabled");
						}else if($(this).data("firs") != undefined){
							$(this).removeClass("disabled");
						}else if($(this).data("last") != undefined){
							$(this).addClass("disabled");
						}
					});
					page = $(element).attr("data-last");
				}else if(!element.classList.contains("active")){
					var parent = element.parentElement;
					$(parent).find("> li").each(function() {
						if(this.classList.contains("active"))
							$(this).removeClass("active");
						else if ($(this).data("page") == $(element).data("page")){
							$(this).addClass("active");	
						}
					});
					page = $(element).attr("data-page");
				}

				if(pageAnterior != page) {
					search();
				}
			}
			
		}

		$("#frm-pesquisa").submit(function(e){
			count();
		    return false;
		});

		function count(){
			var elementTipo = document.getElementById("tipo");
			tipo = elementTipo.options[elementTipo.selectedIndex].value;
			var elementCampo = document.getElementById("campo");
			campo = elementCampo.options[elementCampo.selectedIndex].text;
			var elementIdioma = document.getElementById("idioma");
			idioma = elementIdioma.options[elementIdioma.selectedIndex].value;
			texto = document.getElementById("texto").value;
			novaPesquisa = true;
			page = 1;
			firstRegisterPage = (page * 10) - (10 - 1);
			lastRegisterPage = (page * 10);
			$.ajax({
				url: "../controller/indexcontroller.php", 
				type: "POST",
				data:{
					tipo: tipo,
					campo: campo,
					idioma: idioma,
					texto: texto,
				},
				beforeSend: function() {
					$(".progress").removeClass("hidden");
					$("#bodyResult").empty();
			  	},
				success: function(total){
					totalRegistos = total;
					totalPaginas = (Math.ceil(totalRegistos / 10));
					if (lastRegisterPage > totalRegistos) lastRegisterPage = totalRegistos;
					var lastPageHTML = document.getElementById("last-page"); 
					lastPageHTML.setAttribute("data-last", totalPaginas);
					$(".pagination").each(function(){
						var numberChildren = this.children.length;
						if(totalPaginas > 5){
							for(var i = (numberChildren - 4); i < 5; i++){
								$("#paginator li:eq(" + (i+1) + ")").after("<li onclick=\"changePage(this)\" data-page=\"" + (i+1) + "\" class=\"\"><a href=\"javascript:void(0)\">" + (i+1) + "</a></li>");
							}
							var i = 1;
							$(this).find("> li").each(function() {
								if($(this).data("next") != undefined){
									this.setAttribute("data-next", 6);
								}else if($(this).data("page") != undefined){

									var link = "<a href=\"javascript:void(0)\">" + i + "</a>";
									this.setAttribute("data-page", i);
									this.innerHTML = link;
									if ($(this).attr("data-page") == 1)
										$(this).addClass("active");
									else
										$(this).removeClass("active");
									i++;
								}else if($(this).data("prev") != undefined){
									this.setAttribute("data-prev", 1);
									$(this).addClass("disabled");
								}else if($(this).data("firs") != undefined){
									$(this).addClass("disabled");
								}
								
							});
						}else{ 
							$(this).find("> li").each(function() {
								if($(this).data("page") != undefined){
									$(this).remove();
								}
							});
							for(var i = 1; i <= totalPaginas; i++){
								if(i == 1){
									$("#paginator li:eq(" + i + ")").after("<li onclick=\"changePage(this)\" data-page=\"" + i + "\" class=\"active\"><a href=\"javascript:void(0)\">" + i + "</a></li>");
								}
								else{
									$("#paginator li:eq(" + i + ")").after("<li onclick=\"changePage(this)\" data-page=\"" + i + "\" class=\"\"><a href=\"javascript:void(0)\">" + i + "</a></li>");
								}
								$(this).find("> li").each(function() {
									if($(this).data("next") != undefined){
										this.setAttribute("data-next", totalPaginas);
										$(this).addClass("disabled");
									}else if($(this).data("last") != undefined){
										this.setAttribute("data-last", totalPaginas);
										$(this).addClass("disabled");
									}
								});
							}
								
						}
						
					});
					search();
 		        	$(".pagination").find("> li").each(function() {
 		        		if($(this).data("page") != undefined){
 	 		        		$(this).removeClass("disabled");	
 	 		        	}else if($(this).data("next") != undefined){
 	 	 		        	if (totalPaginas > 5) $(this).removeClass("disabled");	
 	 		        	}else if($(this).data("last") != undefined){
 	 	 		        	if (totalPaginas > 5) $(this).removeClass("disabled");	
 	 		        	}
 		        	});
 		        	
							 			
		    	}
	    	});
		}
		
		function search(){
			var elementTipo = document.getElementById("tipo");
			tipo2 = elementTipo.options[elementTipo.selectedIndex].value;
			var elementCampo = document.getElementById("campo");
			campo2 = elementCampo.options[elementCampo.selectedIndex].text;
			var elementIdioma = document.getElementById("idioma");
			idioma2 = elementIdioma.options[elementIdioma.selectedIndex].value;
			texto2 = document.getElementById("texto").value;

			if(tipo2 != tipo || campo2 != campo || idioma2 != idioma || texto2 != texto)
				count();
			else{
			
				var firstRegisterPage = (page * 10) - (10 - 1);
				var lastRegisterPage = (page * 10);
				
				$.ajax({
	 				url: "../controller/indexcontroller.php", 
	 				type: "POST",
	 				data:{
	 					tipo: tipo,
	 					campo: campo,
	 					idioma: idioma,
	 					texto: texto,
	 					pagina: page,
	 					qtde_linhas: 10
	 				},
	 				beforeSend: function() {
	 					if (!novaPesquisa){
		 					$(".progress").removeClass("hidden");
		 					$("#bodyResult").empty();
	 					}
	 			  	},
	 				success: function(listaJson){
						
	 					var listArray = JSON.parse(listaJson);
	 					var tabela = document.getElementById("datatable-result").getElementsByTagName('tbody')[0];
	 					if(listArray.length > 0){
	 						for (var titulo in listArray) {
								
	 			        		var linha = tabela.insertRow(titulo);
	 			        		var coluna_checkbox = linha.insertCell(0);
	 							var coluna_acervo = linha.insertCell(1);
	 							var coluna_detalhe = linha.insertCell(2);
	 							coluna_checkbox.className = "middle";
	 							coluna_acervo.setAttribute("colspan", 3);
	 							coluna_detalhe.className = "middle";
	 							coluna_checkbox.innerHTML = "<input id=\"" + listArray[titulo]["Codigo"] + "\" class=\"check\" type=\"checkbox\" onchange=\"toggleCheckbox(this)\" />";
	 							coluna_acervo.innerHTML = "<b style=\"color: 0e4924;\">" + listArray[titulo]["Titulo"]
	 										+ ((listArray[titulo]["SubTitulo"] != null ) ? " - " + listArray[titulo]["SubTitulo"] : "") + "</b>"
	 										+ " - <b>" + listArray[titulo]["NomeTipoTitulo"] + "</b>"
	 										+ " - acervo - " + listArray[titulo]["Codigo"] 
	 										+ "<br> " + listArray[titulo]["NomeAutorPrincipal"] + "."
	 										+ "<b> " + listArray[titulo]["Titulo"] 
	 										+ ((listArray[titulo]["SubTitulo"] != null ) ? " - " + listArray[titulo]["SubTitulo"] : "") + "</b>."
	 										+ ((listArray[titulo]["Edicao"] != null ) ? " " + listArray[titulo]["Edicao"] + "ed." : "")
	 										+ listArray[titulo]["PublicacaoLocal"] + ": " + listArray[titulo]["NomeEditora"]
	 										+ ", " + listArray[titulo]["PublicacaoData"]
	 										+ ". " + listArray[titulo]["DescricaoFisica"] + "p."
	 										+ "<br> Número de Chamada: " + listArray[titulo]["NumeroChamada"];
	 							coluna_detalhe.innerHTML = "<span class=\"glyphicon glyphicon-search\" aria-hidden=\"true\"></span>";
	 		        		}
	 					}else{
	 						var linha = tabela.insertRow(0);
	 						var coluna_unica = linha.insertCell(0);
	 						coluna_unica.className = "text-center";
	 						coluna_unica.setAttribute("colspan", 6);
	 						coluna_unica.innerHTML = "Nenhum acervo encontrado";
	 						firstRegisterPage = 0;
	 						lastRegisterPage = 0;
	 					}
						
	 					$("#bodyResult").fadeIn();
	 		        	$(".progress").addClass("hidden");
	
	 		        	var indices = document.getElementById("indices");
	 		        	if (lastRegisterPage > totalRegistos) lastRegisterPage = totalRegistos;
						indices.innerHTML = "Exibindo de " + firstRegisterPage + " a " + lastRegisterPage + " de " + totalRegistos + " acervos encontrados";
						novaPesquisa = false;
	 		    	}
	 	    	});
			}
			
		}
		
		$(document).ready(function(){
			
		});
	</script>
</body>
</html>