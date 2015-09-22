<?php
require_once('class/sourceString.class.php');
/**
* @author: Victor L. Santos
* @see: Classe responsavel por pegar cidade e estado de um determinado IP
*/
class ConsultaIp extends sourceString{

	private $url = 'http://www.localizaip.com.br/localizar-ip.php?ip=';
	private $conteudo = null;

	/**
	* @param: Ip que deseja rastrear
	*/
   	function __construct($ip) {

       	$this->startCurl($ip);
   	}

   	/**
	* @see: Inicia e busca atravez do site setado no atributo URL, utilizando cURL nativo do PHP
	* @param: IP de consulta
   	*/
	private function startCurl($ip) {

		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $this->url.$ip);  
		curl_setopt($ch, CURLOPT_HEADER, 1); 
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$this->conteudo = curl_exec ($ch);  
		curl_close ($ch);
   	}

   	/**
	* @return: cidade correspondente ao IP
   	*/
   	public function getCidade() {
   		return $this->between('Estado:', 'Cidade:', $this->conteudo);
   	}

   	/**
	* @return: Estado correspondente ao IP
   	*/
   	public function getEstado() {
   		return $this->between('Cidade:', 'Provedor:', $this->conteudo);
   	}

}


/*
|================|
| Example of use |
|================|
*/
$consulta = new ConsultaIp('129.168.0.2');

echo $estado = $consulta->getCidade();
echo $cidade = $consulta->getEstado();
