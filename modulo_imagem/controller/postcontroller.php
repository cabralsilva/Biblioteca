<?php
require_once ("../util/funcoes.php");
// Configura o tempo limite para ilimitado
set_time_limit ( 0 );

/*
 * -----------------------------------------------------------------------------*
 * Parte 1: Configurações do Envio de arquivos
 * /*----------------------------------------------------------------------------
 */
session_start ();
$pasta = $_SESSION ["s_pasta"];
$sub_pasta = $_SESSION ["s_sub_pasta"];

if ($pasta == "banners") {
	$url = $_POST ["url"];
	$nome_arquivo = tirarAcentosER ( $url );
	$nome_arquivo = encodeNameImageUrl ( $nome_arquivo );
} else {
	$nome_inicial = $_SESSION ["s_nome_inicial"];
	$nome_arquivo = tirarAcentosER ( $_SESSION ["s_nome_inicial"] );
	$nome_arquivo = encodeNameImage ( $nome_arquivo );
}

$diretorio = "../" . $pasta . "/" . $sub_pasta;

$caminho = $_SESSION ['s_caminho'];
// Extensçoes de arquivos permitidas
$extensoes_autorizadas = array (
		'.jpg' 
);

/*
 * Se quiser limitar o tamanho dos arquivos, basta colocar o tamanho máximo
 * em bytes. Zero ├ر ilimitado
 */
// $limitar_tamanho = 0;

/*
 * Qualquer valor diferente de 0 (zero) ou false, permite que o arquivo seja
 * sobrescrito
 */
// $sobrescrever = 0;

/*
 * -----------------------------------------------------------------------------*
 * Parte 2: Configuracoes do arquivo
 * /*----------------------------------------------------------------------------
 */

// Verifica se o arquivo nao foi enviado. Se nao; termina o script.
// if ( ! isset( $_FILES['arquivo'] ) ) {
// exit('Nenhum arquivo enviado!');
// }

// Aqui o arquivo foi enviado e vamos configurar suas variaveis
$arquivo = $_FILES ['arquivo'];

// Nome do arquivo enviado
$nome_arquivo_post = $arquivo ['name'];

// Tamanho do arquivo enviado
$tamanho_arquivo = $arquivo ['size'];

// Nome do arquivo temporario
$arquivo_temp = $arquivo ['tmp_name'];

// Extensao do arquivo enviado
$extensao_arquivo = strrchr ( $nome_arquivo_post, '.' );

$contents = scandir ( $diretorio );

$total = count ( $contents ) + 1;
$ini_img = count ( $contents );
$nome = substr ( $nome_arquivo, 0, - 4 );

$str = "abcdefghijklmnopqrstuvxzABCDEFGHIJKLMNOPQRSTUVXZ";
$codigo = str_shuffle ( $str );
$tmp = substr ( $codigo, 0, 1 );

// $nome_arquivo = tirarAcentosER($nome);

$contents = array ();
$files = scandir ( $diretorio );
foreach ( $files as $file ) {
	if (is_file ( $diretorio . "/" . $file )) {
		array_push ( $contents, $file );
	}
}
sort ( $contents );

if ($pasta == "produtos" || $pasta == "arquivos") {
	$nome_arquivo = $nome_arquivo . (count ( $contents ) + 1) . $extensao_arquivo;
	$destino = $caminho . "/" . $nome_arquivo;
} else {
	// $destino = $caminho ."/". $tmp."".$nome_arquivo.".jpg";
	$nome_arquivo = (count ( $contents ) + 1) . "_$nome_arquivo" . $extensao_arquivo;
	$destino = $caminho . "/" . $nome_arquivo;
}

$destino = dirname ( __FILE__ ) . "/" . $destino;

/*
 * -----------------------------------------------------------------------------*
 * Parte 3: Verificações do arquivo enviado
 * /*----------------------------------------------------------------------------
 */

/*
 * -----------------------------------------------------------------------------*
 * Parte 4: Envio do arquivo
 * /*-----------------------------------------------------------------------------
 */
// Envia o arquivo
// move o arquivo para o diretorio $destino
if (move_uploaded_file ( $_FILES ['arquivo'] ['tmp_name'], $destino )) {
	// Se for enviado, mostra essa mensagem
	header ( "Location: fotoscontroller.php" );
} else {
	// Se nao for enviado, mostra essa mensagem
	echo 'Erro ao enviar arquivo! -> ' . $destino;
}
function tirarAcentosER($p_paramento) {
	$p_paramento = str_replace ( " ", "_", $p_paramento );
	$p_paramento = str_replace ( "á", "a", $p_paramento );
	$p_paramento = str_replace ( "à", "a", $p_paramento );
	$p_paramento = str_replace ( "ã", "a", $p_paramento );
	$p_paramento = str_replace ( "é", "e", $p_paramento );
	$p_paramento = str_replace ( "ê", "e", $p_paramento );
	$p_paramento = str_replace ( "í", "i", $p_paramento );
	$p_paramento = str_replace ( "ó", "o", $p_paramento );
	$p_paramento = str_replace ( "ô", "o", $p_paramento );
	$p_paramento = str_replace ( "õ", "o", $p_paramento );
	$p_paramento = str_replace ( "ú", "u", $p_paramento );
	$p_paramento = str_replace ( "ç", "c", $p_paramento );
	$p_paramento = str_replace ( "Á", "A", $p_paramento );
	$p_paramento = str_replace ( "À", "A", $p_paramento );
	$p_paramento = str_replace ( "Ã", "A", $p_paramento );
	$p_paramento = str_replace ( "É", "E", $p_paramento );
	$p_paramento = str_replace ( "Ê", "E", $p_paramento );
	$p_paramento = str_replace ( "Í", "I", $p_paramento );
	$p_paramento = str_replace ( "Ó", "O", $p_paramento );
	$p_paramento = str_replace ( "Ô", "O", $p_paramento );
	$p_paramento = str_replace ( "Õ", "O", $p_paramento );
	$p_paramento = str_replace ( "Ú", "U", $p_paramento );
	$p_paramento = str_replace ( "Ç", "C", $p_paramento );
	// $p_paramento = str_replace("-","",$p_paramento);
	// $p_paramento = str_replace("/","",$p_paramento);
	$p_paramento = str_replace ( "'", "", $p_paramento );
	$p_paramento = str_replace ( "´", "", $p_paramento );
	$p_paramento = str_replace ( "`", "", $p_paramento );
	$p_paramento = str_replace ( "^", "", $p_paramento );
	$p_paramento = str_replace ( "~", "", $p_paramento );
	$p_paramento = str_replace ( "!", "", $p_paramento );
	$p_paramento = str_replace ( "@", "", $p_paramento );
	$p_paramento = str_replace ( "#", "", $p_paramento );
	$p_paramento = str_replace ( "$", "", $p_paramento );
	$p_paramento = str_replace ( "%", "", $p_paramento );
	$p_paramento = str_replace ( "¨", "", $p_paramento );
	// $p_paramento = str_replace("&","",$p_paramento);
	$p_paramento = str_replace ( "*", "", $p_paramento );
	$p_paramento = str_replace ( "(", "", $p_paramento );
	$p_paramento = str_replace ( ")", "", $p_paramento );
	$p_paramento = str_replace ( ";", "", $p_paramento );
	// $p_paramento = str_replace(":","",$p_paramento);
	$p_paramento = str_replace ( ",", "", $p_paramento );
	// $p_paramento = str_replace(".","",$p_paramento);
	// $p_paramento = str_replace("?","",$p_paramento);
	return $p_paramento;
}
?>