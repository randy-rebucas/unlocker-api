<?php
class User_list extends CI_Model
{
    private $table              = 'users';              
    private $pk                 = 'id';      

    function exists($id)
    {
        $this->db->from($this->table);   
        $this->db->where($this->pk,$id);
        $query = $this->db->get();
        
        return ($query->num_rows()==1);
    }
    
    function exists_user($id)
    {
        $this->db->from('users');   
        $this->db->where('users.id',$id);
        $query = $this->db->get();
        
        return ($query->num_rows()==1);
    }

    function exists_profile($id)
    {
        $this->db->from('user_profiles');   
        $this->db->join('users','users.id = user_profiles.user_id');    
        $this->db->where('user_profiles.user_id',$id);
        $query = $this->db->get();
        
        return ($query->num_rows()==1);
    }

    function get_all(){

        $this->db->select("(SELECT SUM(amount) FROM funds WHERE user_id = up.user_id) as bal, u.username, u.email, u.activated, u.last_ip as ip, u.created, u.id, up.user_id, up.first_name, up.last_name", false);  
		$this->db->from('users as u');  
        $this->db->join('user_profiles as up','u.id = up.user_id'); 
        $this->db->order_by('bal', 'desc');
        return $this->db->get();
    }

    function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_user_info($id)
    {
        $query = $this->db->get_where('users', array('id' => $id), 1);
        
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        else
        {
            //create object with empty properties.
            $fields = $this->db->list_fields('users');
            $obj = new stdClass;
            
            foreach ($fields as $field)
            {
                $obj->$field='';
            }
            
            return $obj;
        }
    }

    function get_info($id)
    {
        $this->db->from('user_profiles'); 
        $this->db->join('users','users.id = user_profiles.user_id');  
        $this->db->where('user_profiles.user_id',$id);
        $query = $this->db->get();
        
        if($query->num_rows()==1)
        {
            return $query->row();
        }
        else
        {
            $obj=$this->get_user_info($id);
            
            $fields = $this->db->list_fields('user_profiles');
            
            foreach ($fields as $field)
            {
                $obj->$field='';
            }
            
            return $obj;
        }
    }
    
    function _save(&$user_data,$id=false)
    {       
        if (!$id or !$this->exists_user($id))
        {
            if ($this->db->insert('users',$user_data))
            {
                $user_data['id']=$this->db->insert_id();
                return true;
            }
            
            return false;
        }
        
        $this->db->where('id', $id);
        return $this->db->update('users',$user_data);
    }

    function save(&$user_data, &$profile_data, $id=false)
    {
        $success=false;

        $this->db->trans_start();
        
        if($this->_save($user_data,$id))
        {
            if (!$id or !$this->exists_profile($id))
            {
                $profile_data['user_id'] = $user_data['id'];
                $success = $this->db->insert('user_profiles',$profile_data);                
            }
            else
            {
                $this->db->where('user_id', $id);
                $success = $this->db->update('user_profiles',$profile_data);
            }
            
        }
        
        $this->db->trans_complete();        
        return $success;
    }

    // function save($profile_data,$id)
    // {
    //     $this->db->where('user_id', $id);
    //     return $this->db->update('user_profiles',$profile_data);
    // }

    function add_funds($fund_data)
    {
        return $this->db->insert('funds',$fund_data);
    }
    
    function bal_funds($user_id){

        $this->db->select('sum(amount) as out_bal');
        $this->db->from('funds');
        $this->db->where('user_id', $user_id);
        $qry = $this->db->get();

        if ($qry->num_rows() === 0)
        {
          return FALSE;
        }

        return $qry->row('out_bal');
    }

    function delete($id)
    {
        $this->db->where($this->pk, $id);
        return $this->db->delete($this->table);
    }

}
?>
