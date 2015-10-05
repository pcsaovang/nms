<?php
class Xml_tool
{
	private $_folder = '';
	
	public function __construct()
	{
		
	}
	
	public function Create_table($table, $field = array())
	{
		global $_folder;
		$xml = new DOMDocument('1.0', 'utf-8');
		$r = $xml->createElement('data');
		$xml->appendChild($r);
		
		foreach($field as $db)
		{
			$b = $xml->createElement('field');
			$name = $xml->createElement('name');
			$name->appendChild($xml->createTextNode($db));
			$b->appendChild($name);
			$r->appendChild($b);
		}
		$xml = $xml->save($_folder.$table.'.xml');
	}
	
	public function Get_data($table, $field, $where='', $limit='0,0')
	{ 
		global $_folder; 
		$where = explode(',', $where); 
		$limit = explode(',', $limit); 
		$doc = new DOMDocument('1.0', 'utf-8'); 
		$doc->load( $_folder . $table . ".xml" ); 
		
		// Load field 
		$tags = $doc->getElementsByTagName("field"); 
		$tagname = array(); 
		foreach($tags as $tag)
		{
			$names = $tag->getElementsByTagName("name"); 
			$name = $names->item(0)->nodeValue; 
			$tagname[] = $name; 
		} 
		
		// Start get data 
		$a = $doc->getElementsByTagName($table); 
		$data = array(); 
		if(in_array($field, $tagname) || $field=="*")
		{
			$f=0;$c=0;
			if(!$where[0])
			{
				foreach($a as $b)
				{
					if($c == $limit[1] & $limit[1] != 0) break;
					if($limit[0] <= $f)
					{
						if($field == "*")
						{
							for($i = 0; $i < count($tagname); $i++)
							{
								$d[$i] = $b->getElementsByTagName($tagname[$i]);
								$e[$i] = $d[$i]->item(0)->nodeValue;
								$data[$c][$tagname[$i]] = $e[$i];
							} 
						} 
						else
						{
							$d = $b->getElementsByTagName($field);
							$e = $d->item(0)->nodeValue;
							$data[$c][$field] = $e;
						} 
						$c++;
					}
					$f++;
				}
			}
			else
			{ 
				foreach($a as $b)
				{  
					if ($c == $limit[1] & $limit[1] != 0) break; 
					$checks = $b->getElementsByTagName($where[0]); 
					$check = $checks->item(0)->nodeValue; 
					switch($where[1])
					{ 
						case "<":  
							$check < $where[2] ? $check = true : $check = false; 
							break;
						case ">": 
							$check > $where[2] ? $check = true : $check = false; 
							break;
						case "<=":
							$check <= $where[2] ? $check = true : $check = false; 
							break;
						case ">=":
							$check >= $where[2] ? $check = true : $check = false; 
							break;
						case "=":
							$check == $where[2] ? $check = true : $check = false; 
							break;
						case "!=":
							$check != $where[2] ? $check = true : $check = false; 
							break;
					}
					if($check == true)
					{
						if($limit[0] <= $f)
						{   
							if($field == "*")
							{
								for($i = 0; $i < count($tagname); $i++)
								{
									$d[$i] = $b->getElementsByTagName($tagname[$i]);
									$e[$i] = $d[$i]->item(0)->nodeValue;
									$data[$c][$tagname[$i]] = $e[$i];
								}
							}
							else
							{
								$d = $b->getElementsByTagName($field); 
								$e = $d->item(0)->nodeValue;
								$data[$c][$field] = $e;
							}
							$c++;
						} 
						$f++;
					}
				}
			}
		}
		// If field not found 
		else
		{
			$data[0][$field] = "Eror: Can't Select " . $field . " From " . $table;
			break;
		}
		return $data;
	}

	public function Del_data($table, $field, $del=array())
	{
		global $_folder; 
		$doc = new DOMDocument('1.0', 'utf-8'); 
		$doc->load($_folder . $table . ".xml");
		// Load field 
		$tags = $doc->getElementsByTagName("field");
		$tagname = array();
		foreach($tags as $tag)
		{
			$names = $tag->getElementsByTagName("name"); 
			$name = $names->item(0)->nodeValue; 
			$tagname[] = $name; 
		} 
		// Start delete data 
		$a = $doc->getElementsByTagName($table);
		$data = array();
		$c=0;
		foreach($a as $b)
		{  
			$checks = $b->getElementsByTagName($field); 
			$check = $checks->item(0)->nodeValue; 
			if(!in_array($check, $del))
			{ 
				for($i = 0; $i<count($tagname); $i++)
				{
					$d[$i] = $b->getElementsByTagName($tagname[$i]); 
					$e[$i] = $d[$i]->item(0)->nodeValue; 
					$data[$c][$tagname[$i]] = $e[$i]; 
				} 
				$c++; 
			} 
		} 

		$xml = new DOMDocument('1.0','utf-8');

		$r = $xml->createElement("data");
		$xml->appendChild($r);

		foreach($data as $db)
		{
			$b = $xml->createElement($table);

			for($i = 0; $i<count($tagname); $i++)
			{
				$name = $xml->createElement($tagname[$i]);
				$name->appendChild($xml->createTextNode($db[$tagname[$i]]));
				$b->appendChild($name);
			}

			$r->appendChild($b);
		}
		foreach($tagname as $db)
		{
			$b = $xml->createElement('field');

			$name = $xml->createElement('name');
			$name->appendChild($xml->createTextNode($db));
			$b->appendChild($name);

			$r->appendChild($b);
		}

		$xml = $xml->save( $_folder . $table . ".xml");
	} 

	public function Add_data($table, $add = array())
	{
		global $_folder;
		$doc = new DOMDocument('1.0', 'utf-8');
		$doc->load( $_folder . $table . ".xml");
		// Load field 
		$tags = $doc->getElementsByTagName("field"); 
		$tagname = array();
		foreach($tags as $tag)
		{
			$names = $tag->getElementsByTagName("name");
			$name = $names->item(0)->nodeValue;
			$tagname[] = $name;
		} 
		// Start add data 
		$a = $doc->getElementsByTagName($table);
		$data = array();
		$c=1;
		for($i = 0; $i<count($tagname); $i++)
		{
			$data[0][$tagname[$i]] = $add[$i];
		}
		foreach($a as $b)
		{
			for($i = 0; $i < count($tagname); $i++)
			{ 
				$d[$i] = $b->getElementsByTagName($tagname[$i]);
				$e[$i] = $d[$i]->item(0)->nodeValue;
				$data[$c][$tagname[$i]] = $e[$i];
			}
			$c++;
		}

		$xml = new DOMDocument('1.0', 'utf-8');

		$r = $xml->createElement("data");
		$xml->appendChild($r);

		foreach($data as $db)
		{ 
			$b = $xml->createElement($table);
			for($i=0; $i < count($tagname); $i++)
			{
				$name = $xml->createElement($tagname[$i]);
				$name->appendChild($xml->createTextNode( $db[$tagname[$i]]));
				$b->appendChild($name);
			}

			$r->appendChild($b);
		}
		foreach($tagname as $db)
		{
			$b = $xml->createElement('field');

			$name = $xml->createElement('name');
			$name->appendChild($xml->createTextNode($db));
			$b->appendChild($name);

			$r->appendChild($b);
		}
		$xml= $xml->save($_folder . $table . ".xml");
	} 

	public function Update_data($table, $field=array(), $update=array())
	{
		global $_folder;
		$doc = new DOMDocument('1.0', 'utf-8');
		$doc->load( $_folder . $table . ".xml");
		// Load field 
		$tags = $doc->getElementsByTagName("field");
		$tagname = array();
		foreach($tags as $tag)
		{
			$names = $tag->getElementsByTagName("name");
			$name = $names->item(0)->nodeValue;
			$tagname[] = $name;
		} 
		// Start update data 
		$a = $doc->getElementsByTagName($table);
		$data = array();
		$c=0;
		foreach($a as $b)
		{
			$checks = $b->getElementsByTagName($field[0]);
			$check = $checks->item(0)->nodeValue;
			if($check != $field[1])
			{
				for($i = 0; $i < count($tagname); $i++)
				{
					$d[$i] = $b->getElementsByTagName($tagname[$i]);
					$e[$i] = $d[$i]->item(0)->nodeValue;
					$data[$c][$tagname[$i]] = $e[$i];
				} 
				$c++;
			}
			else
			{
				for($i = 0; $i < count($tagname); $i++)
				{
					$data[$c][$tagname[$i]] = $update[$i];
				}
				$c++;
			}
		}

		$xml = new DOMDocument('1.0', 'utf-8');

		$r = $xml->createElement("data");
		$xml->appendChild($r);

		foreach($data as $db)
		{
			$b = $xml->createElement($table);

			for($i = 0; $i < count($tagname); $i++)
			{
				$name = $xml->createElement($tagname[$i]);
				$name->appendChild($xml->createTextNode($db[$tagname[$i]]));
				$b->appendChild($name);
			}
			$r->appendChild($b);
		}
		foreach($tagname as $db)
		{ 
			$b = $xml->createElement('field');

			$name = $xml->createElement('name');
			$name->appendChild($xml->createTextNode($db));
			$b->appendChild($name);

			$r->appendChild($b);
		} 
		$xml= $xml->save($_folder . $table . ".xml");
	}
}
?>