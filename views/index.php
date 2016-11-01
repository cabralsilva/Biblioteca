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
				</select>
			</div>
			<div class="row text-center">
				<input minlength=3 required
					onkeydown="if (event.keyCode == 13) {document.frm-pesquisa.submit(); return false;}"
					class="form-control" placeholder="O que procura?" id="texto"
					type="text">
				<button type="submit" class="btn btn-default">Pesquisar</button>
			</div>
		</form>
		<div class="row impressao hide">
			<div id="infobusca" class="alert alert-info text-center" role="alert"></div>
		</div>
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

		<div class="row indices impressao">
			<div class="col-xs-12 col-md-12 col-sm-12 text-center" id="indices"></div>
		</div>
		<div class="row impressao" id="tabela">
			<table id="datatable-result" class="table table-hover">
				<thead>
					<tr>
						<th width="2%" class="middle"><input id="123"
							class="checkAll noimpression" type="checkbox"
							onchange="toggleCheckboxAll(this)" /></th>
						<th width="10%"><span
							class="glyphicon glyphicon-list-alt noimpression"
							aria-hidden="true"></span> <span id="totalMinhaLista"
							class="noimpression">0</span> <span class="noimpression">item(ns)</span></th>
						<th width="80%" class="center">Acervos <span
							class="glyphicon glyphicon-book" aria-hidden="true"></span></th>
						<th width="10%"><button type="button"
								class="btn btn-default noimpression" onclick="imprimirTabela()">
								<span class="glyphicon glyphicon-print"></span> Imprimir
							</button></th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody id="bodyResult">
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
		function marcarLinha(parent, element){
			$.ajax({
				url: "../controller/indexcontroller.php", 
				async: false,
				type: "POST",
				data:{
					tipo: "addMinhaLista",
					codigoAcervo: $(element).attr("id")
				},
				success: function(success){
					var objJson = JSON.parse(success);
					var minhaLista = [];
					for(var i in objJson)
						minhaLista.push([i, objJson [i]]);
					$(parent).removeClass("linha");
					$(parent).addClass("linha-marcada");
					var span = document.getElementById("totalMinhaLista");
					span.innerText = minhaLista.length;
		    	}
	    	});
	    	
		}
		function desmarcarLinha(parent, element){
			$.ajax({
				url: "../controller/indexcontroller.php", 
				async: false,
				type: "POST",
				data:{
					tipo: "removeMinhaLista",
					codigoAcervo: $(element).attr("id")
				},
				success: function(success){
					var objJson = JSON.parse(success);
					var minhaLista = [];
					for(var i in objJson)
						minhaLista.push([i, objJson [i]]);
					$(parent).removeClass("linha-marcada");
					$(parent).addClass("linha");
					$(".checkAll").prop("checked", false);
					var span = document.getElementById("totalMinhaLista");
					span.innerText = minhaLista.length;
		    	}
	    	});
		}
		
		function toggleCheckbox(element){
 			var parent = element.parentElement.parentNode;
			if (element.checked)
				marcarLinha(parent, element);
			else
				desmarcarLinha(parent, element);
		}
		
		function toggleCheckboxAll(element){
			if(element.checked){
				$(".check").each(function(){
					$(this).prop("checked", true);
					var parent = $(this).parent().parent();
					marcarLinha(parent, this);
				});
			}else{
				$(".check").each(function(){
					$(this).prop("checked", false);
					var parent = $(this).parent().parent();
					desmarcarLinha(parent, this);
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
	 					var objJson = JSON.parse(listaJson);
	 					var formPesquisa = JSON.parse(listaJson)["formularioPesquisa"];
						var listArray = [];
						for(var i in objJson){
							if (i != "formularioPesquisa")
								listArray.push([i, objJson [i]]);
						}
	 					var tabela = document.getElementById("datatable-result").getElementsByTagName('tbody')[0];
	 					if(listArray.length > 0){
	 						for (var titulo in listArray) {
	 			        		var linha = tabela.insertRow(titulo);
	 			        		var coluna_checkbox = linha.insertCell(0);
	 							var coluna_acervo = linha.insertCell(1);
	 							var coluna_detalhe = linha.insertCell(2);
	 							coluna_checkbox.className = "middle";
	 							coluna_acervo.setAttribute("colspan", 3);
	 							coluna_detalhe.className = "middle redirect";
	 							coluna_checkbox.innerHTML = "<input id=\"" + listArray[titulo][1]["Codigo"] + "\" class=\"check noimpression\" type=\"checkbox\" onchange=\"toggleCheckbox(this)\" />";
	 							coluna_acervo.innerHTML = "<b style=\"color: 0e4924;\">" + listArray[titulo][1]["Titulo"]
	 										+ ((listArray[titulo][1]["SubTitulo"] != null ) ? " - " + listArray[titulo][1]["SubTitulo"] : "") + "</b>"
	 										+ " - <b>" + listArray[titulo][1]["NomeTipoTitulo"] + "</b>"
	 										+ " - acervo - " + listArray[titulo][1]["Codigo"] 
	 										+ "<br> " + listArray[titulo][1]["NomeAutorPrincipal"] + "."
	 										+ "<b> " + listArray[titulo][1]["Titulo"] 
	 										+ ((listArray[titulo][1]["SubTitulo"] != null ) ? " - " + listArray[titulo][1]["SubTitulo"] : "") + "</b>."
	 										+ ((listArray[titulo][1]["Edicao"] != null ) ? " " + listArray[titulo][1]["Edicao"] + "ed." : "")
	 										+ listArray[titulo][1]["PublicacaoLocal"] + ": " + listArray[titulo][1]["NomeEditora"]
	 										+ ", " + listArray[titulo][1]["PublicacaoData"]
	 										+ ". " + listArray[titulo][1]["DescricaoFisica"] + "p."
	 										+ "<br> Número de Chamada: " + listArray[titulo][1]["NumeroChamada"];
	 							coluna_detalhe.innerHTML = "<a href=\"javascript:void(0)\" onclick=\"redirectDetail(this);\" data-codigo=\"" + listArray[titulo][1]["Codigo"] + "\"><span class=\"glyphicon glyphicon-forward noimpression\" aria-hidden=\"true\"></span></a>";

								if (listArray[titulo]["marcado"] == true){//MARCAR OS QUE JÁ ESTÃO NA MINHA LISTA
									var check = $("#" + listArray[titulo][1]["Codigo"]);
	 								check.prop("checked", true);
	 								var parent = check.parent().parent();
	 								marcarLinha(parent, check);
								}
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

						var filtros = "Busca por";
						if ((formPesquisa["texto"] != "") && (formPesquisa["texto"] != undefined) && (formPesquisa["texto"] != null))
							filtros += " \"<b>" + formPesquisa["texto"] + "</b>\"";
						if ((formPesquisa["idioma"] != "0") && (formPesquisa["idioma"] != undefined) && (formPesquisa["idioma"] != null))
							filtros += " no idioma \"<b>" + $("#idioma option[value='" + formPesquisa["idioma"] + "']").text() + "</b>\"";
						if ((formPesquisa["campo"] != "Todos") && (formPesquisa["campo"] != undefined) && (formPesquisa["campo"] != null))
							filtros += " no campo \"<b>" + formPesquisa["campo"] + "</b>\"";
						else
							filtros += " em todos os campos";
						if ((formPesquisa["tipo"] != "0") && (formPesquisa["tipo"] != undefined) && (formPesquisa["tipo"] != null))
							filtros += " do tipo \"<b>" + $("#tipo option[value='" + formPesquisa["tipo"] + "']").text() + "</b>\"";
							
						var info = document.getElementById("infobusca");
						var pai = info.parentElement;
						$(pai).removeClass("hide");
						info.innerHTML = filtros;
	 				}
	 	    	});
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
			
		}
		$(document).ready(function(){
			$.ajax({
				url: "../controller/indexcontroller.php",
				type: "POST",
				async: false,
				data:{
					isNew: ""
				},
				success: function(retorno){
					var retornoJson = JSON.parse(retorno);
					if (retornoJson["new"] == false){
						document.getElementById("tipo").value = retornoJson["tipo"];
						var elementCampo = document.getElementById("campo");
						for (var i = 0; i < elementCampo.options.length; i++) {
						    if (elementCampo.options[i].text === retornoJson["campo"]) {
						    	elementCampo.selectedIndex = i;
						        break;
						    }
						}
						document.getElementById("idioma").value = retornoJson["idioma"];
						document.getElementById("texto").value = retornoJson["texto"];
						search();
					}
		    	}
	    	});			
		});
	</script>
</body>
</html>