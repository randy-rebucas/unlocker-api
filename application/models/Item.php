<?php
class Item extends CI_Model
{
    private $table              = 'items';              
    private $pk                 = 'item_id';      

    function exists($id)
    {
        $this->db->from($this->table);   
        $this->db->where($this->pk,$id);
        $query = $this->db->get();
        
        return ($query->num_rows()==1);
    }

    function get_all($service = null, $category = null){

        $this->db->from($this->table);  
        $this->db->order_by('service_id', 'asc');
        if (strlen($service)) 
        {
            $this->db->where('service_id',$service);
            $this->db->group_by('category_id');
        }  
        if (strlen($category)) 
        {
            $this->db->where('category_id',$category);
        }  

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

    function exists_override($id)
    {
        $this->db->from('override_items');   
        $this->db->where('o_remote_id',$id);
        $query = $this->db->get();
        
        return ($query->num_rows()==1);
    }

    function override($id, $price, $status){

        if (!$id or !$this->exists_override($id))
        {
            $this->db->set('o_remote_id', $id);
            $this->db->set('o_price', $price);
			$this->db->set('o_status', $status);
            return $this->db->insert('override_items');
        }

        $this->db->where('o_remote_id', $id);
        $this->db->set('o_price', $price);
		$this->db->set('o_status', $status);
        return $this->db->update('override_items');
         
    }

    function get_override_info($id)
    {
        $this->db->from('override_items');   
        $this->db->where('o_remote_id',$id);
        $query = $this->db->get();
        
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        else
        {

            $obj=new stdClass();

            $fields = $this->db->list_fields('override_items');
            
            foreach ($fields as $field)
            {
                $obj->$field='';
            }
            
            return $obj;
        }
    } 

    function delete($ids)
    {
        $success=false;
        $this->db->trans_start();

        $this->db->where_in($this->pk, $id);
        $success = $this->db->delete($this->table);

        $this->db->trans_complete();
        return $success;
    }

}
?>
