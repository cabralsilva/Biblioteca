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


</head>
<body>
	<div class="container">
		<div class="row paginacao">
			<div class="col-xs-12 col-md-12 col-sm-12 text-center">
				<nav aria-label="Page navigation">
					<ul class="pagination">
						<li onclick="changePage(this)" data-firs="0" class="disabled previous" id="first-page"><a href="javascript:void(0)"><span aria-hidden="true">&larr;</span> Primeiro</a></li>
    					<li onclick="changePage(this)" data-prev="0" class="disabled" id="previous-page"><a href="javascript:void(0)" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a></li>
						<li onclick="changePage(this)" data-page="1" class="active"><a href="javascript:void(0)">1</a></li>
						<li onclick="changePage(this)" data-page="2"><a href="javascript:void(0)">2</a></li>
						<li onclick="changePage(this)" data-page="3"><a href="javascript:void(0)">3</a></li>
						<li onclick="changePage(this)" data-page="4"><a href="javascript:void(0)">4</a></li>
						<li onclick="changePage(this)" data-page="5"><a href="javascript:void(0)">5</a></li>
						<li onclick="changePage(this)" data-next="6" id="next-page"><a href="javascript:void(0)" aria-label="Next"> <span aria-hidden="true">&raquo;</span>
						<li onclick="changePage(this)" data-last="100" class="next" id="last-page"><a href="javascript:void(0)">Último <span aria-hidden="true">&rarr;</span></a></li>
						</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="row indices">
			<div class="col-xs-12 col-md-12 col-sm-12 text-center">
				Exibindo de 1 a 25 de 123 acervos encontrados
			</div>
		</div>
		<div class="row">
			<table id="datatable-result" class="table table-hover">
				<thead>
					<tr>
						<th width="2%" class="middle"><input id="123" class="checkAll"
							type="checkbox" onchange="toggleCheckboxAll(this)" /></th>
						<th width="10%">
							<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>0 item(ns)
						</th>
						<th width="80%" class="center">Acervo <span class="glyphicon glyphicon-book"
							aria-hidden="true"></span></th>
						<th width="10%"></th>
						<th width="5%"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
					<tr>
						<td class="middle"><input id="123" class="check" type="checkbox"
							onchange="toggleCheckbox(this)" /></td>
						<td colspan="3"><b style="color: 0e4924;">Casa grande e senzala - formação da
								família brasileira sob o regime da economia patriarcal</b> - <b>Livro</b>
							- acervo - 5168<br> FREYRE, Gilberto <b>Casa grande e senzala
								formação da família brasileira sob o regime da economia
								patriarcal</b>. 36ed. São Paulo: Record, . 569p.<br> Número de
							Chamada: 981 F894c</td>
						<td class="middle"><span class="glyphicon glyphicon-search"
							aria-hidden="true"></span></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">
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
							if (next > 100){
								$(this).addClass("disabled");
							}
						}else if($(this).data("firs") != undefined){
							$(this).removeClass("disabled");
						}else if($(this).data("last") != undefined){
							if((parseInt($("#next-page").attr("data-next"))+1) > 100)
								$(this).addClass("disabled");
						}
					});
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
				}else if($(element).data("firs") != undefined){
					var parent = element.parentElement;
					var i = 1;
					$(parent).find("> li").each(function() {
						if($(this).data("prev") != undefined){
							console.log("prev");
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
							console.log($(element).data("firs"));
							$(this).addClass("disabled");
						}else if($(this).data("last") != undefined){
							$(this).removeClass("disabled");
						}
					});
				}else if($(element).data("last") != undefined){
					var parent = element.parentElement;
					var i = parseInt($("#last-page").attr("data-last")) - 5;
					$(parent).find("> li").each(function() {
						if($(this).data("prev") != undefined){
							console.log("prev");
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
							if ($(this).attr("data-page") == 100)
								$(this).addClass("active");
							else
								$(this).removeClass("active");
							i++;
						}else if($(this).data("next") != undefined){
							this.setAttribute("data-next", 101);
							$(this).addClass("disabled");
						}else if($(this).data("firs") != undefined){
							$(this).removeClass("disabled");
						}else if($(this).data("last") != undefined){
							$(this).addClass("disabled");
						}
					});
				}
				else if(!element.classList.contains("active")){
					var parent = element.parentElement;
					$(parent).find("> li").each(function() {
						if(this.classList.contains("active"))
							$(this).removeClass("active");
						else if ($(this).data("page") == $(element).data("page"))
							$(this).addClass("active");	
					});
				}
			}
		}

		$(document).ready(function(){
			console.log("iniciou");
			function search(){
				$.ajax({
					url: "demo_test.txt", 
					success: function(result){
			        	$("#div1").html(result);
			    	}
		    	});
			}
		});
	</script>
</body>
</html>