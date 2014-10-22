<?php

class cloudflareDomain {
	
	//Define your Cloudflare email
	private $cfmail = "email@example.com";
	
	//Define your Cloudflare token
	private $cftoken = "21bc183765vnxkf0375nxbnxodn0d0dc";
	
	//Define your Cloudflare domain
	public $cfdomain = "example.com";
	
	//Define your sitename
	public $site_name = "Example.com";
	
	//MySQL host ip
	private $mHost = "127.0.0.1";
	
	//MySQL username
	private $mUser = "user";
	
	//MySQL password
	private $mPass = "password";
	
	//MySQL database
	private $mDb   = "database";
	
	private $mysqli;	
	
	public function __construct(){

		
		$mConnection = new mysqli($this->mHost, $this->mUser, $this->mPass, $this->mDb);
		
		$this->mysqli = $mConnection;
		
		if ($this->mysqli->connect_errno) {
			return false;
		}else{
			return true;
		}
		
	}
	
	public function existsInMysql($name, $ip, $port){
			
		$query="SELECT name FROM records WHERE name='" . $name . "'";
		$result = $this->mysqli->query($query);

		$row_count = $result->num_rows;
		
		$x = 0;
	
		if($row_count > 0){
		
			$x = 1;
			
		}
		
		$query="SELECT * FROM records WHERE ip='" . $ip . ":" . $port . "'";
		$result = $this->mysqli->query($query);
		$row_count = $result->num_rows;
		
		if($row_count > 0){
		
			$x = 2;
			
		}
		
		return $x;
		
	}
	
	public function addInMysql($name, $ip, $port){
				
		$query="INSERT INTO records(name, ip) VALUES ('" . $name . "', '" . $ip . ":" . $port ."')";
		$result = $this->mysqli->query($query);
		return true;
		
	}
	
	public function safe($var){
		
			$notAllowed = array("=","<", ">", "/","\"","`","~","'","$","%","#");
			$var = str_replace($notAllowed, "", $var);
			$var = htmlentities($var, ENT_QUOTES);
			return $var;
		
	}
	
	public function validateIp($var){
		
		return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $var);
		
	}
		
	public function createRecord($name, $ip, $port){
	
		$w = 0;
		
		$dataA = array(
			'a'			=> 'rec_new',
			'tkn'		=> $this->cftoken,
			'email'		=> $this->cfmail,
			'z'			=> $this->cfdomain,
			'type'		=> 'A',
			'name'		=> $name,
			'content'	=> $ip,
			'ttl'		=> '1');
			
		$dataSrv = array(
			'a'			=> 'rec_new',
			'tkn'		=> $this->cftoken,
			'email'		=> $this->cfmail,
			'z'			=> $this->cfdomain,
			'type'		=> 'SRV',
			'name'		=> $name,
			'content'	=> $ip,
			'ttl'		=> '1',
			'service'	=> '_minecraft',
			'srvname'	=> $name,
			'protocol'	=> '_tcp',
			'weight'	=> '1',
			'port'		=> $port,
			'target'	=> $name . "." . $this->cfdomain);
			
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.cloudflare.com/api_json.html"); 
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataA);
        $resultA = curl_exec($ch);
		if(curl_errno($ch)){
	        $w = 1;
        }
        curl_close($ch);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.cloudflare.com/api_json.html");
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataSrv);
        $resultSrv = curl_exec($ch);
        if(curl_errno($ch)){
	        $w = 1;
        }
        curl_close($ch);
        
       
        
        if($w > 0){
	        return false;
        }else{
	        return true;
        }
		
		
	}
	
}