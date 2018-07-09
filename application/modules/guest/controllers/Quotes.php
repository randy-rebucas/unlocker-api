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

class Quotes extends Guest_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('quotes/Mdl_quotes');
    }

    public function index()
    {
        // Display open quotes by default
        redirect('guest/quotes/status/open');
    }

    public function status($status = 'open', $page = 0)
    {
        redirect_to_set();
        
        // Determine which group of quotes to load
        switch ($status)
        {
            case 'approved':
                $this->Mdl_quotes->is_approved()->where_in('fi_quotes.patient_id', $this->user_patients);
                break;
            case 'rejected':
                $this->Mdl_quotes->is_rejected()->where_in('fi_quotes.patient_id', $this->user_patients);
                $this->layout->set('show_invoice_column', TRUE);
                break;
            default:
                $this->Mdl_quotes->is_open()->where_in('fi_quotes.patient_id', $this->user_patients);
                break;
        }

        $this->Mdl_quotes->paginate(site_url('guest/quotes/status/' . $status), $page);
        $quotes = $this->Mdl_quotes->result();

        $this->layout->set('quotes', $quotes);
        $this->layout->set('status', $status);
        $this->layout->buffer('content', 'guest/quotes_index');
        $this->layout->render('layout_guest');
    }

    public function view($quote_id)
    {
        redirect_to_set();
        
        $this->load->model('quotes/Mdl_quote_items');
        $this->load->model('quotes/Mdl_quote_tax_rates');

        $quote = $this->Mdl_quotes->guest_visible()->where('fi_quotes.quote_id', $quote_id)->where_in('fi_quotes.patient_id', $this->user_patients)->get()->row();

        if (!$quote)
        {
            show_404();
        }

        $this->Mdl_quotes->mark_viewed($quote->quote_id);

        $this->layout->set(
            array(
                'quote'           => $quote,
                'items'           => $this->Mdl_quote_items->where('quote_id', $quote_id)->get()->result(),
                'quote_tax_rates' => $this->Mdl_quote_tax_rates->where('quote_id', $quote_id)->get()->result(),
                'quote_id'        => $quote_id
            )
        );

        $this->layout->buffer('content', 'guest/quotes_view');
        $this->layout->render('layout_guest');
    }

    public function generate_pdf($quote_id, $stream = TRUE, $quote_template = NULL)
    {
        $this->load->helper('pdf');

        $this->Mdl_quotes->mark_viewed($quote_id);

        $quote = $this->Mdl_quotes->guest_visible()->where('fi_quotes.quote_id', $quote_id)->where_in('fi_quotes.patient_id', $this->user_patients)->get()->row();

        if (!$quote)
        {
            show_404();
        }
        else
        {
            generate_quote_pdf($quote_id, $stream, $quote_template);
        }
    }

    public function approve($quote_id)
    {
        $this->load->model('quotes/Mdl_quotes');
        $this->Mdl_quotes->approve_quote_by_id($quote_id);
        redirect_to('guest/quotes');
    }

    public function reject($quote_id)
    {
        $this->load->model('quotes/Mdl_quotes');
        $this->Mdl_quotes->reject_quote_by_id($quote_id);
        redirect_to('guest/quotes');
    }

}

?>