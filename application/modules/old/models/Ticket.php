<?php
class Ticket extends CI_Model
{
    private $table              = 'tickets';              
    private $pk                 = 'ticket_id';      

    function exists($id)
    {
        $this->db->from($this->table);   
        $this->db->where($this->pk,$id);
        $query = $this->db->get();
        
        return ($query->num_rows()==1);
    }

    function get_all(){

        $this->db->from($this->table);  
        $this->db->order_by('ticket_id', 'asc');
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
        $this->db->where($this->pk, $id);
        return $this->db->delete($this->table);
    }

}
?>
