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

class Mdl_Patient_Custom extends MY_Model {
    
    public $table = 'fi_patient_custom';
    public $primary_key = 'fi_patient_custom.patient_custom_id';
    
    public function save_custom($patient_id, $db_array)
    {
        $patient_custom_id = NULL;
        
        $db_array['patient_id'] = $patient_id;
        
        $patient_custom = $this->where('patient_id', $patient_id)->get();
        
        if ($patient_custom->num_rows())
        {
            $patient_custom_id = $patient_custom->row()->patient_custom_id;
        }

        parent::save($patient_custom_id, $db_array);
    }
    
}

?>