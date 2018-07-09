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

	public function filter_invoices()
	{
		$this->load->model('invoices/Mdl_invoices');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->Mdl_invoices->like("CONCAT_WS('^',LOWER(invoice_number),invoice_date_created,invoice_date_due,LOWER(patient_name),invoice_total,invoice_balance)", $keyword);
			}
		}

		$data = array(
			'invoices' => $this->Mdl_invoices->get()->result(),
			'invoice_statuses' => $this->Mdl_invoices->statuses()
		);

		$this->layout->load_view('invoices/partial_invoice_table', $data);
	}
    
	public function filter_quotes()
	{
		$this->load->model('quotes/Mdl_quotes');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->Mdl_quotes->like("CONCAT_WS('^',LOWER(quote_number),quote_date_created,quote_date_expires,LOWER(patient_name),quote_total)", $keyword);
			}
		}

		$data = array(
			'quotes' => $this->Mdl_quotes->get()->result(),
			'quote_statuses' => $this->Mdl_quotes->statuses()
		);

		$this->layout->load_view('quotes/partial_quote_table', $data);
	}
	
	public function filter_patients()
	{
		$this->load->model('patients/Mdl_patients');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->Mdl_patients->like("CONCAT_WS('^',LOWER(patient_name),LOWER(patient_email),patient_phone,patient_active)", $keyword);
			}
		}

		$data = array(
			'records' => $this->Mdl_patients->with_total_balance()->get()->result()
		);

		$this->layout->load_view('clients/partial_client_table', $data);
	}
	
	public function filter_payments()
	{
		$this->load->model('payments/Mdl_payments');

		$query = $this->input->post('filter_query');

		$keywords	 = explode(' ', $query);
		$params		 = array();

		foreach ($keywords as $keyword)
		{
			if ($keyword)
			{
                $keyword = strtolower($keyword);
				$this->Mdl_payments->like("CONCAT_WS('^',payment_date,LOWER(invoice_number),LOWER(patient_name),payment_amount,LOWER(payment_method_name),LOWER(payment_note))", $keyword);
			}
		}

		$data = array(
			'payments' => $this->Mdl_payments->get()->result()
		);

		$this->layout->load_view('payments/partial_payment_table', $data);
	}

}

?>