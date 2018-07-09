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

class Guest_Controller extends User_Controller {

    public $user_patients = array();

    public function __construct()
    {
        parent::__construct('user_type', 2);

        $this->load->model('users/Mdl_user_patients');

        $user_patients = $this->Mdl_user_patients->assigned_to($this->session->userdata('user_id'))->get()->result();

        if (!$user_patients)
        {
            die(lang('guest_account_denied'));
        }
        
        foreach ($user_patients as $user_patient)
        {
            $this->user_patients[$user_patient->patient_id] = $user_patient->patient_id;
        }
    }

}

?>