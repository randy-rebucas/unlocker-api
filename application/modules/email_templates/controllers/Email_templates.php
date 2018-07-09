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

class Email_Templates extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Mdl_email_templates');
    }

    public function index($page = 0)
    {
        $this->Mdl_email_templates->paginate(site_url('email_templates/index'), $page);
        $email_templates = $this->Mdl_email_templates->result();

        $this->layout->set('email_templates', $email_templates);
        $this->layout->buffer('content', 'email_templates/index');
        $this->layout->render();
    }

    public function form($id = NULL)
    {
        if ($this->input->post('btn_cancel'))
        {
            redirect('email_templates');
        }

        if ($this->Mdl_email_templates->run_validation())
        {
            $this->Mdl_email_templates->save($id);
            redirect('email_templates');
        }

        if ($id and !$this->input->post('btn_submit'))
        {
            if (!$this->Mdl_email_templates->prep_form($id))
            {
                show_404();
            }
        }

        $this->load->model('custom_fields/Mdl_custom_fields');

        foreach (array_keys($this->Mdl_custom_fields->custom_tables()) as $table)
        {
            $custom_fields[$table] = $this->Mdl_custom_fields->by_table($table)->get()->result();
        }
        
        $this->layout->set('custom_fields', $custom_fields);
        $this->layout->buffer('content', 'email_templates/form');
        $this->layout->render();
    }

    public function delete($id)
    {
        $this->Mdl_email_templates->delete($id);
        redirect('email_templates');
    }

}

?>