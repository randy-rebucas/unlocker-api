<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// define("REQUESTFORMAT", "JSON"); // we recommend json format (More information http://php.net/manual/en/book.json.php)
// define('DHRUFUSION_URL', "http://unlockedzpd.com/");
// define("USERNAME", "edzpd");
// define("API_ACCESS_KEY", "XVT-TZ1-JTX-OL7-PRV-TII-LID-A51");

class DhruFusion
{
    //private $error = array();

    private $xmlData;
    private $xmlResult;
    private $debug;
    private $action;

    public function __construct()
    {
        

        $this->xmlData = new DOMDocument();

    }

    function getResult()
    {
        return $this->xmlResult;
    }

    function action($action, $arr = array(), $apis)
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
                    'username'      => $apis['USERNAME'],
                    'apiaccesskey'  => $apis['API_ACCESS_KEY'],
                    'action'        => $action,
                    'requestformat' => 'xml',
                    'parameters'    => $this->xmlData->saveHTML());
                $crul = curl_init();
                curl_setopt($crul, CURLOPT_HEADER, false);
                curl_setopt($crul, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                //curl_setopt($crul, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($crul, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($crul, CURLOPT_URL, $apis['DHRUFUSION_URL'].'/api/index.php');
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

