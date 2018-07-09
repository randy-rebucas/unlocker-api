<?php
class Source extends CI_Model
{
    private $table              = 'sources_API';              
    private $pk                 = 'source_id';      

    function exists($id)
    {
        $this->db->from($this->table);   
        $this->db->where($this->pk,$id);
        $query = $this->db->get();
        
        return ($query->num_rows()==1);
    }

    function get_all(){

        $this->db->from($this->table);  
        $this->db->order_by($this->pk, 'asc');
        return $this->db->get();
    }

    function get_info($id)
    {
        $this->db->from($this->table);   
        $this->db->where($this->pk,$id);
        $query = $this->db->get();
        
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        else
        {

            $obj=new stdClass();

            $fields = $this->db->list_fields($this->table);
            
            foreach ($fields as $field)
            {
                $obj->$field='';
            }
            
            return $obj;
        }
    } 
    
    function save(&$data,$id=false)
    {
        if (!$id or !$this->exists($id))
        {
            if($this->db->insert($this->table,$data))
            {
                $data[$this->pk]=$this->db->insert_id();
                return true;
            }
            return false;
        }

        $this->db->where($this->pk, $id);
        return $this->db->update($this->table,$data);
    }

    function delete($id)
    {
        
        $success=false;
        $this->db->trans_start();

        $this->db->where_in($this->pk, $id);
        $success = $this->db->delete($this->table);

        $this->db->trans_complete();
        return $success;
    }
    function _push_data($action, $dhru_url, $username, $api_key){
        
        $posted = array(
            'username' => $username,
            'apiaccesskey' => $api_key,
            'action' => $action,
            'requestformat' => 'xml');
        $crul = curl_init();
        curl_setopt($crul, CURLOPT_HEADER, false);
        curl_setopt($crul, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        //curl_setopt($crul, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($crul, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crul, CURLOPT_URL, $dhru_url.'/api/index.php');
        curl_setopt($crul, CURLOPT_POST, true);
        curl_setopt($crul, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($crul, CURLOPT_POSTFIELDS, $posted);
        $response = curl_exec($crul);
        curl_close($crul);

        return $this->xmlstr_to_array($response);
    }
    /**
     * convert xml string to php array - useful to get a serializable value
     *
     * @param string $xmlstr 
     * @return array
     * @author Adrien aka Gaarf
     */
    function xmlstr_to_array($xmlstr) {
      $doc = new DOMDocument();
      $doc->loadXML($xmlstr);
      return $this->domnode_to_array($doc->documentElement);
    }
    function domnode_to_array($node) {
      $output = array();
      switch ($node->nodeType) {
       case XML_CDATA_SECTION_NODE:
       case XML_TEXT_NODE:
        $output = trim($node->textContent);
       break;
       case XML_ELEMENT_NODE:
        for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) { 
         $child = $node->childNodes->item($i);
         $v = $this->domnode_to_array($child);
         if(isset($child->tagName)) {
           $t = $child->tagName;
           if(!isset($output[$t])) {
            $output[$t] = array();
           }
           $output[$t][] = $v;
         }
         elseif($v) {
          $output = (string) $v;
         }
        }
        if(is_array($output)) {
         if($node->attributes->length) {
          $a = array();
          foreach($node->attributes as $attrName => $attrNode) {
           $a[$attrName] = (string) $attrNode->value;
          }
          $output['@attributes'] = $a;
         }
         foreach ($output as $t => $v) {
          if(is_array($v) && count($v)==1 && $t!='@attributes') {
           $output[$t] = $v[0];
          }
         }
        }
       break;
      }
      return $output;
    }
}
?>
