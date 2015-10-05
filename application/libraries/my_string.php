<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_string{
	private $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function random($leng = 10, $char = false)
	{
		if($char = false) $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
		else $s = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		mt_srand((double)microtime() * 1000000);
		$salt = '';
		for($i = 0; $i < $leng; $i++)
		{
			$salt = $salt . substr($s, (mt_rand() % (strlen($s))), 1);
		}
		return $salt;
	}
	
	public function encode_cookie($cookie)
	{
		return $this->random(100).base64_encode($cookie);
	}
	
	public function decode_cookie($cookie)
	{
		return base64_decode(substr($cookie, 100));
	}
	
	public function php_redirect($url)
	{
		header('Location: '.$url);
		die;
	}
}
?>