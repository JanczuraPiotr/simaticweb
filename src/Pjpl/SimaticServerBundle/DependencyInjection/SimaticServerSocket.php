<?php
namespace Pjpl\SimaticServerBundle\DependencyInjection;

/**
 * @todo Description of SimaticScadaSocket
 *
 * @author Piotr Janczura <piotr@janczura.pl>
 */
class SimaticServerSocket {
	private $ip;
	private $port;
	private $timeout_sec;
	private $socket;
	private $scoket_connect;

	/**
	 * @param string $ip adres IP pod którym nasłuchuje aplikacja obsługująca proces
	 * @param int $port port IP
	 * @param long $timeout_sec
	 */
	public function __construct($ip, $port, $timeout_sec){
		$this->ip = $ip;
		$this->port = $port;
		$this->timeout_sec = $timeout_sec;

		$this->socket = socket_create(AF_INET, SOCK_STREAM,SOL_TCP);
		socket_set_option($this->socket,SOL_SOCKET, SO_RCVTIMEO, array("sec"=>$this->timeout_sec, "usec"=>0));
		$this->socket_connect = socket_connect($this->socket, $ip , $port);
	}
	public function getSocket(){
		return $this->socket;
	}
}
