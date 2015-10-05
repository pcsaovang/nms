<?php
class Test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		/*
		$out = '';
		$pattern = '$my_config[\'test\']';
		$new_value = 'root';
		$filename = 'application/config/my_config.php';
		if(file_exists($filename))
		{
			$file = fopen($filename, 'r+');
			while(!feof($file))
			{
				$line = fgets($file);
				if(strpos($line, $pattern) !== false)
				{
					$out .= $pattern." = '".$new_value."'\r\n";
				}
				else
				{
					$out .= $line."\r\n";
				}
			}
			echo $out;
			file_put_contents($filename, $out);
			fclose($file);
		}
		*/
		
		$this->config->load('my_config');
		print_r($this);
		//$this->config->set_item('prize', 'thucoisao');
		//echo $this->config->item('prize');
		
	}
}
?>