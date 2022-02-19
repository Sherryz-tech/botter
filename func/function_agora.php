<?php

class Agora {
	private $token;
	//"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJrb2tvMTExIiwiY3JlYXRlZCI6MTY0NDMzNzczMjUwNCwiYXBpIjoicHVibGljIiwiZXhwIjoxODAyMTI1NzMyLCJqdGkiOiJiMzBmNTQwNC02MzkxLTQ0MTgtOGE5OC04N2MwYTFmMzlhNTkifQ.qHTjDFajI1VbCEEPeBrHEBd-4aCSF9rYnTN7tRRPQi06MiUJG7-BXRK4bcYZuUDUVZCoqQN1AUDNjgDeuNxwWQ";
	private $url;
	//"https://agoradesk.com/api/v1/";
	
	public function __construct() {
		$this->token = "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJrb2tvMTExIiwiY3JlYXRlZCI6MTY0NDMzNzczMjUwNCwiYXBpIjoicHVibGljIiwiZXhwIjoxODAyMTI1NzMyLCJqdGkiOiJiMzBmNTQwNC02MzkxLTQ0MTgtOGE5OC04N2MwYTFmMzlhNTkifQ.qHTjDFajI1VbCEEPeBrHEBd-4aCSF9rYnTN7tRRPQi06MiUJG7-BXRK4bcYZuUDUVZCoqQN1AUDNjgDeuNxwWQ";
		$this->url = "https://agoradesk.com/api/v1/";
	}
	
	public function send_cmd(?string $post=null, ?string $get=null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url.$get);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'User-agent: KokoMaster1.0', 'Authorization: '.$this->token));
		curl_setopt($ch, CURLOPT_POST, $post);
		$data = curl_exec($ch);
		$curl_errno = curl_errno($ch);
		$curl_error = curl_error($ch);
		curl_close($ch);
		if ($curl_errno>0) {
		    return "cURL Error ($curl_errno): $curl_error\n";
		}else{
		    return $data;
		}
	}
	
}

?>