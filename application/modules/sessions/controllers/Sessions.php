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

class Sessions extends Base_Controller {

    public function index()
    {
        redirect('auth');
    }

    public function login()
    {
        if ($this->input->post('btn_login'))
        {
            $this->load->library('sessions/my_crypt');
            if ($this->authenticate($this->input->post('email'), $this->input->post('password')))
            {
                if ($this->session->userdata('user_type') == 1)
                {
                    redirect('dashboard');
                }
                elseif ($this->session->userdata('user_type') == 2)
                {
                    redirect('guest');
                }
            }
        }

        $data = array(
            'login_logo' => $this->Mdl_settings->setting('login_logo')
        );

        $this->load->view('session_login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('auth');
    }

    public function authenticate($email_address, $password)
    {
        $this->load->model('Mdl_sessions');

        if ($this->Mdl_sessions->auth($email_address, $password))
        {
            return TRUE;
        }

        return FALSE;
    }

}

?>