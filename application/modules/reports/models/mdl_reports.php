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

class Mdl_Reports extends CI_Model {

	public function sales_by_client($from_date = NULL, $to_date = NULL)
	{
		$this->db->select('client_name');

		if ($from_date and $to_date)
		{
            $from_date = date_to_mysql($from_date);
            $to_date = date_to_mysql($to_date);
            
			$this->db->select("(SELECT COUNT(*) FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id and invoice_date_created >= " . $this->db->escape($from_date) . " and invoice_date_created <= " . $this->db->escape($to_date) . ") AS invoice_count");
			$this->db->select("(SELECT SUM(invoice_item_subtotal) FROM fi_invoice_amounts WHERE fi_invoice_amounts.invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id and invoice_date_created >= " . $this->db->escape($from_date) . " and invoice_date_created <= " . $this->db->escape($to_date) . ")) AS sales");
			$this->db->select("(SELECT SUM(invoice_total) FROM fi_invoice_amounts WHERE fi_invoice_amounts.invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id and invoice_date_created >= " . $this->db->escape($from_date) . " and invoice_date_created <= " . $this->db->escape($to_date) . ")) AS sales_with_tax");
			$this->db->where('client_id IN (SELECT client_id FROM fi_invoices WHERE invoice_date_created >=' . $this->db->escape($from_date) . ' and invoice_date_created <= ' . $this->db->escape($to_date) . ')');
		}
		else
		{
			$this->db->select('(SELECT COUNT(*) FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id) AS invoice_count');
			$this->db->select('(SELECT SUM(invoice_item_subtotal) FROM fi_invoice_amounts WHERE fi_invoice_amounts.invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id)) AS sales');
			$this->db->select('(SELECT SUM(invoice_total) FROM fi_invoice_amounts WHERE fi_invoice_amounts.invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id)) AS sales_with_tax');
			$this->db->where('client_id IN (SELECT client_id FROM fi_invoices)');
		}

		$this->db->order_by('client_name');

		return $this->db->get('fi_clients')->result();
	}

	public function payment_history($from_date = NULL, $to_date = NULL)
	{
		$this->load->model('payments/mdl_payments');

		if ($from_date and $to_date)
		{
            $from_date = date_to_mysql($from_date);
            $to_date = date_to_mysql($to_date);
            
			$this->mdl_payments->where('payment_date >=', $from_date);
			$this->mdl_payments->where('payment_date <=', $to_date);
		}

		return $this->mdl_payments->get()->result();
	}

	public function invoice_aging()
	{
		$this->db->select('client_name');
		$this->db->select('(SELECT SUM(invoice_balance) FROM fi_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id AND invoice_date_due <= DATE_SUB(NOW(),INTERVAL 1 DAY) AND invoice_date_due >= DATE_SUB(NOW(), INTERVAL 15 DAY))) AS range_1', FALSE);
		$this->db->select('(SELECT SUM(invoice_balance) FROM fi_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id AND invoice_date_due <= DATE_SUB(NOW(),INTERVAL 16 DAY) AND invoice_date_due >= DATE_SUB(NOW(), INTERVAL 30 DAY))) AS range_2', FALSE);
		$this->db->select('(SELECT SUM(invoice_balance) FROM fi_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id AND invoice_date_due <= DATE_SUB(NOW(),INTERVAL 31 DAY))) AS range_3', FALSE);
		$this->db->select('(SELECT SUM(invoice_balance) FROM fi_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM fi_invoices WHERE fi_invoices.client_id = fi_clients.client_id AND invoice_date_due <= DATE_SUB(NOW(), INTERVAL 1 DAY))) AS total_balance', FALSE);
		$this->db->having('range_1 >', 0);
        $this->db->or_having('range_2 >', 0);
        $this->db->or_having('range_3 >', 0);
        $this->db->or_having('total_balance >', 0);
        
        
		return $this->db->get('fi_clients')->result();
	}

}

?>