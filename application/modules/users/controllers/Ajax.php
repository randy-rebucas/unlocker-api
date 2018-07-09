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

class Ajax extends Admin_Controller {

    public $ajax_controller = TRUE;

    public function save_user_patient()
    {
        $user_id     = $this->input->post('user_id');
        $patient_name = $this->input->post('patient_name');

        $this->load->model('patients/Mdl_patients');
        $this->load->model('users/Mdl_user_patients');

        $patient = $this->Mdl_patients->where('patient_name', $patient_name)->get();

        if ($patient->num_rows() == 1)
        {
            $patient_id = $patient->row()->patient_id;

            // Is this a new user or an existing user?
            if ($user_id)
            {
                // Existing user - go ahead and save the entries

                $user_patient = $this->Mdl_user_patients->where('fi_user_patients.user_id', $user_id)->where('fi_user_patients.patient_id', $patient_id)->get();

                if (!$user_patient->num_rows())
                {
                    $this->Mdl_user_patients->save(NULL, array('user_id'   => $user_id, 'patient_id' => $patient_id));
                }
            }
            else
            {
                // New user - assign the entries to a session variable until user record is saved
                $user_patients = ($this->session->userdata('user_patients')) ? $this->session->userdata('user_patients') : array();

                $user_patients[$patient_id] = $patient_id;

                $this->session->set_userdata('user_patients', $user_patients);
            }
        }
    }

    public function load_user_patient_table()
    {
        if ($session_user_patients = $this->session->userdata('user_patients'))
        {
            $this->load->model('patients/Mdl_patients');
            
            $data = array(
                'id'           => NULL,
                'user_patients' => $this->Mdl_patients->where_in('fi_patients.patient_id', $session_user_patients)->get()->result()
            );
        }
        else
        {
            $this->load->model('users/Mdl_user_patients');
            
            $data = array(
                'id'           => $this->input->post('user_id'),
                'user_patients' => $this->Mdl_user_patients->where('fi_user_patients.user_id', $this->input->post('user_id'))->get()->result()
            );
        }

        $this->layout->load_view('users/partial_user_client_table', $data);
    }

}

?>