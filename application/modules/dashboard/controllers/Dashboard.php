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

class Dashboard extends Admin_Controller {

    public function index()
    {
        $this->load->model('invoices/Mdl_invoice_amounts');
        $this->load->model('quotes/Mdl_quote_amounts');
        $this->load->model('invoices/Mdl_invoices');
        $this->load->model('quotes/Mdl_quotes');

        $this->layout->set(
            array(
                'invoice_status_totals' => $this->Mdl_invoice_amounts->get_status_totals(),
                'quote_status_totals'   => $this->Mdl_quote_amounts->get_status_totals(),
                'invoices'              => $this->Mdl_invoices->limit(10)->get()->result(),
                'quotes'                => $this->Mdl_quotes->limit(10)->get()->result(),
                'invoice_statuses'      => $this->Mdl_invoices->statuses(),
                'quote_statuses'        => $this->Mdl_quotes->statuses(),
                'overdue_invoices'      => $this->Mdl_invoices->is_overdue()->limit(10)->get()->result()
            )
        );
        
        $this->layout->buffer('content', 'dashboard/index');
        $this->layout->render();
    }

}