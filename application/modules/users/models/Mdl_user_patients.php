<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 * 
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013 FusionInvoice, LLC
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.com
 * 
 */

class Mdl_User_Patients extends MY_Model {
    
    public $table = 'fi_user_patients';
    public $primary_key = 'fi_user_patients.user_patient_id';
    
    public function default_select()
    {
        $this->db->select('fi_user_patients.*, fi_users.user_name, fi_patients.patient_name');
    }
    
    public function default_join()
    {
        $this->db->join('fi_users', 'fi_users.user_id = fi_user_patients.user_id');
        $this->db->join('fi_patients', 'fi_patients.patient_id = fi_user_patients.patient_id');
    }
    
    public function default_order_by()
    {
        $this->db->order_by('fi_patients.patient_name');
    }
    
    public function assigned_to($user_id)
    {
        $this->filter_where('fi_user_patients.user_id', $user_id);
        return $this;
    }
    
}

?>