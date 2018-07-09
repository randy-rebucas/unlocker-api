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

class Guest extends Guest_Controller {

    public function index()
    {
        $this->load->model('quotes/Mdl_quotes');
        $this->load->model('invoices/Mdl_invoices');

        $this->layout->set(
            array(
                'overdue_invoices' => $this->Mdl_invoices->is_overdue()->where_in('fi_invoices.patient_id', $this->user_patients)->get()->result(),
                'open_quotes'      => $this->Mdl_quotes->is_open()->where_in('fi_quotes.patient_id', $this->user_patients)->get()->result(),
                'open_invoices'    => $this->Mdl_invoices->is_open()->where_in('fi_invoices.patient_id', $this->user_patients)->get()->result()
            )
        );

        $this->layout->buffer('content', 'guest/index');
        $this->layout->render('layout_guest');
    }

}

?>