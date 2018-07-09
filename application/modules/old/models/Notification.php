<?php
class Notification extends CI_Model
{
    private $table              = 'notification';              
    private $pk                 = 'id';      

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

    function count_all($user_id){
        $this->db->from('notifications');
        $this->db->where('notification_to', $user_id);
        $this->db->where('seen', 0);
        return $this->db->count_all_results();
    }

    function seen($id){
        $this->db->where('notification_id', $id);
        return $this->db->update('notifications',array('seen'=>1));
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

    function save_notifications($notification_data)
    {

        return $this->db->insert('notifications', $notification_data);
               
    }

    function update($id){
        $this->db->where('id', $id);
        return $this->db->update('notification',array('send_occurance' => +1));
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

}
?>
