<?php
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dhrufusionapi {

    private $xmlData;
    private $xmlResult;
    private $debug;
    private $action;
    private $CI;
    private $username;
    private $api_key;
    private $dhru_url;
    private $format;

    public function __construct($params = array())
    {
        // Do something with $params
        $CI =& get_instance();
        $this->xmlData = new DOMDocument();
        $this->username = $params['USERNAME'];
        $this->api_key = $params['API_ACCESS_KEY'];
        $this->dhru_url = $params['DHRUFUSION_URL'];
        $this->format = $params['REQUESTFORMAT'];

    }

    function getResult()
    {
        return $this->xmlResult;
    }

    function action($action, $arr = array())
    {
        if (is_string($action))
        {
            if (is_array($arr))
            {
                if (count($arr))
                {
                    $request = $this->xmlData->createElement("PARAMETERS");
                    $this->xmlData->appendChild($request);
                    foreach ($arr as $key => $val)
                    {
                        $key = strtoupper($key);
                        $request->appendChild($this->xmlData->createElement($key, $val));
                    }
                }
                $posted = array(
                    'username' => $this->username,
                    'apiaccesskey' => $this->api_key,
                    'action' => $action,
                    'requestformat' => $this->format,
                    'parameters' => $this->xmlData->saveHTML());
                $crul = curl_init();
                curl_setopt($crul, CURLOPT_HEADER, false);
                curl_setopt($crul, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                //curl_setopt($crul, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($crul, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($crul, CURLOPT_URL, $this->dhru_url.'/api/index.php');
                curl_setopt($crul, CURLOPT_POST, true);
                curl_setopt($crul, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($crul, CURLOPT_POSTFIELDS, $posted);
                $response = curl_exec($crul);
                if (curl_errno($crul) != CURLE_OK)
                {
                    echo curl_error($crul);
                    curl_close($crul);
                }
                else
                {
                    curl_close($crul);
                    // $response = XMLtoARRAY(trim($response));
                    if ($this->debug)
                    {
                        echo "<textarea rows='20' cols='200'> ";
                        print_r($response);
                        echo "</textarea>";
                    }
                    return (json_decode($response, true));
                }
            }
        }
        return false;
    }
	
	function XMLtoARRAY($rawxml)
	{
		$xml_parser = xml_parser_create();
		xml_parse_into_struct($xml_parser, $rawxml, $vals, $index);
		xml_parser_free($xml_parser);
		$params = array();
		$level = array();
		$alreadyused = array();
		$x = 0;
		foreach ($vals as $xml_elem)
		{
			if ($xml_elem['type'] == 'open')
			{
				if (in_array($xml_elem['tag'], $alreadyused))
				{
					++$x;
					$xml_elem['tag'] = $xml_elem['tag'].$x;
				}
				$level[$xml_elem['level']] = $xml_elem['tag'];
				$alreadyused[] = $xml_elem['tag'];
			}
			if ($xml_elem['type'] == 'complete')
			{
				$start_level = 1;
				$php_stmt = '$params';
				while ($start_level < $xml_elem['level'])
				{
					$php_stmt .= '[$level['.$start_level.']]';
					++$start_level;
				}
				$php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
				eval($php_stmt);
				continue;
			}
		}
		return $params;
	}

}


?>



