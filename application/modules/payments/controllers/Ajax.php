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

    public function add()
    {
        $this->load->model('payments/Mdl_payments');

        if ($this->Mdl_payments->run_validation())
        {
            $this->Mdl_payments->save();

            $response = array(
                'success' => 1
            );
        }
        else
        {
            $this->load->helper('json_error');
            $response = array(
                'success'           => 0,
                'validation_errors' => json_errors()
            );
        }

        echo json_encode($response);
    }

    public function modal_add_payment()
    {
        $this->load->module('layout');
        $this->load->model('payments/Mdl_payments');
        $this->load->model('payment_methods/Mdl_payment_methods');

        $data = array(
            'payment_methods' => $this->Mdl_payment_methods->get()->result(),
            'invoice_id'      => $this->input->post('invoice_id'),
            'invoice_balance' => $this->input->post('invoice_balance')
        );

        $this->layout->load_view('payments/modal_add_payment', $data);
    }

}

?>