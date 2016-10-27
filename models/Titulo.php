<?php
require_once 'Assunto.php';
require_once 'Autor.php';
require_once 'Campo.php';
require_once 'Editora.php';
require_once 'Exemplar.php';
require_once 'Idioma.php';
require_once 'TipoTitulo.php';

class Titulo{
	private $codigo;
	private $titulo;
	private $subTitulo;
	private $localPublicacao;
	private $numeroChamada;
	private $numeroEdicao;
	private $anoPublicacao;
	private $descricaoFisica;
	private $isbn;
	private $data;
	private $serie;
	private $numeroClasse;
	private $autorTitulo;
	private $autorNumero;
	private $editoraTitulo;
	private $numeroVolume;
	private $referencia;
	private $tomo;
	private $area;
	private $parte;
	private $quantidadeAssunto;
	private $quantidadeAutoresSecundarios;
	private $quantidadeExemplares;
	private $idiomaTitulo;
	private $tipoTitulo;
	private $textoPesquisa;
	private $periodicidade;
	private $lstAssunto = array();
	private $lstExemplar = array();
	private $lstAutores = array();
	
	//VARIÁVEL UTILIZADA EXCLUSIVAMENTO PARA PESQUISA
	private $campo;
	
	function __construct(){
		$this->autorTitulo = new Autor();
		$this->editoraTitulo = new Editora();
		$this->idiomaTitulo = new Idioma();
		$this->tipoTitulo = new TipoTitulo();
		$this->campo = new Campo();
	}
	
	public function getCodigo() {
		return $this->codigo;
	}
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}
	public function getData() {
		return $this->data;
	}
	public function setData($data) {
		$this->data = $data;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getSubTitulo() {
		return $this->subTitulo;
	}
	public function setSubTitulo($subTitulo) {
		$this->subTitulo = $subTitulo;
	}
	public function getLocalPublicacao() {
		return $this->localPublicacao;
	}
	public function setLocalPublicacao($localPublicacao) {
		$this->localPublicacao = $localPublicacao;
	}
	public function getNumeroChamada() {
		return $this->numeroChamada;
	}
	public function setNumeroChamada($numeroChamada) {
		$this->numeroChamada = $numeroChamada;
	}
	public function getNumeroEdicao() {
		return $this->numeroEdicao;
	}
	public function setNumeroEdicao($numeroEdicao) {
		$this->numeroEdicao = $numeroEdicao;
	}
	public function getAnoPublicacao() {
		return $this->anoPublicacao;
	}
	public function setAnoPublicacao($anoPublicacao) {
		$this->anoPublicacao = $anoPublicacao;
	}
	public function getDescricaoFisica() {
		return $this->descricaoFisica;
	}
	public function setDescricaoFisica($descricaoFisica) {
		$this->descricaoFisica = $descricaoFisica;
	}
	public function getIsbn() {
		return $this->isbn;
	}
	public function setIsbn($isbn) {
		$this->isbn = $isbn;
	}
	public function getSerie() {
		return $this->serie;
	}
	public function setSerie($serie) {
		$this->serie = $serie;
	}
	public function getNumeroClasse() {
		return $this->numeroClasse;
	}
	public function setNumeroClasse($numeroClasse) {
		$this->numeroClasse = $numeroClasse;
	}
	public function  getAutorTitulo() {
		return $this->autorTitulo;
	}
	public function setAutorTitulo($autorTitulo) {
		$this->autorTitulo = $autorTitulo;
	}
	public function getAutorNumero() {
		return $this->autorNumero;
	}
	public function setAutorNumero($autorNumero) {
		$this->autorNumero = $autorNumero;
	}
	public function  getEditoraTitulo() {
		return $this->editoraTitulo;
	}
	public function setEditoraTitulo($editoraTitulo) {
		$this->editoraTitulo = $editoraTitulo;
	}
	public function getNumeroVolume() {
		return $this->numeroVolume;
	}
	public function setNumeroVolume($numeroVolume) {
		$this->numeroVolume = $numeroVolume;
	}
	public function getReferencia() {
		return $this->referencia;
	}
	public function setReferencia($referencia) {
		$this->referencia = $referencia;
	}
	public function getTomo() {
		return $this->tomo;
	}
	public function setTomo($tomo) {
		$this->tomo = $tomo;
	}
	public function getArea() {
		return $this->area;
	}
	public function setArea($area) {
		$this->area = $area;
	}
	public function getParte() {
		return $this->parte;
	}
	public function setParte($parte) {
		$this->parte = $parte;
	}
	public function getQuantidadeAssunto() {
		return $this->quantidadeAssunto;
	}
	public function setQuantidadeAssunto($quantidadeAssunto) {
		$this->quantidadeAssunto = $quantidadeAssunto;
	}
	public function getQuantidadeAutoresSecundarios() {
		return $this->quantidadeAutoresSecundarios;
	}
	public function setQuantidadeAutoresSecundarios($quantidadeAutoresSecundarios) {
		$this->quantidadeAutoresSecundarios = $quantidadeAutoresSecundarios;
	}
	public function getQuantidadeExemplares() {
		return $this->quantidadeExemplares;
	}
	public function setQuantidadeExemplares($quantidadeExemplares) {
		$this->quantidadeExemplares = $quantidadeExemplares;
	}
	public function getIdiomaTitulo() {
		return $this->idiomaTitulo;
	}
	public function setIdiomaTitulo($idiomaTitulo) {
		$this->idiomaTitulo = $idiomaTitulo;
	}
	public function  getCampo() {
		return $this->campo;
	}
	public function setCampo($campo) {
		$this->campo = campo;
	}
	public function getTipoTitulo() {
		return $this->tipoTitulo;
	}
	public function setTipoTitulo($tipoTitulo) {
		$this->tipoTitulo = $tipoTitulo;
	}
	public function getTextoPesquisa() {
		return $this->textoPesquisa;
	}
	public function setTextoPesquisa($textoPesquisa) {
		$this->textoPesquisa = $textoPesquisa;
	}
	
	public function getPeriodicidade() {
		return $this->periodicidade;
	}
	public function setPeriodicidade($periodicidade) {
		$this->periodicidade = $periodicidade;
	}
	
	
	public function getLstAssunto() {
		return $this->lstAssunto;
	}
	public function setLstAssunto($lstAssunto) {
		$this->lstAssunto = $lstAssunto;
	}
	
	
	public function getLstExemplar() {
		return $this->lstExemplar;
	}
	public function setLstExemplar($lstExemplar) {
		$this->lstExemplar = $lstExemplar;
	}
	
	
	public function getLstAutores() {
		return $this->$thislstAutores;
	}
	public function setLstAutores($lstAutores) {
		$this->lstAutores = $lstAutores;
	}
}