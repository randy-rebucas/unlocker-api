<?php
class Order extends CI_Model
{
    private $table              = 'orders';              
    private $pk                 = 'order_id';      

    function exists($id)
    {
        $this->db->from($this->table);   
        $this->db->where($this->pk,$id);
        $query = $this->db->get();
        
        return ($query->num_rows()==1);
    }

    function get_all(){

        $this->db->from($this->table);  
        $this->db->order_by('order_id', 'desc');
        return $this->db->get();
    }

    function get_my_order($user_id, $limit = 99999){
        $this->db->from($this->table);  
        $this->db->where('user_id',$user_id);
		$this->db->limit($limit);
        $this->db->order_by('order_id', 'desc');
        return $this->db->get();
    }

    function count_all($user_id = null, $status = null){
        $this->db->from($this->table);
        if (strlen($user_id)) 
        {
            $this->db->where('user_id', $user_id);
        }
        if (strlen($status)) 
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
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

    function update($feedback, $status, $order_id, $remote_order_id){
        $this->db->where($this->pk, $order_id);
        return $this->db->update($this->table,array('status' => $status, 'feedback' => $feedback , 'replied_date' => date('Y-m-d H:i:s'), 'remote_order_id' => $remote_order_id));
    }
}
?>
