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

class Mdl_Quote_Amounts extends CI_Model {

    /**
     * FI_QUOTE_AMOUNTS
     * quote_amount_id
     * quote_id
     * quote_item_subtotal	SUM(item_subtotal)
     * quote_item_tax_total	SUM(item_tax_total)
     * quote_tax_total
     * quote_total			quote_item_subtotal + quote_item_tax_total + quote_tax_total
     * 
     * FI_QUOTE_ITEM_AMOUNTS
     * item_amount_id
     * item_id
     * item_tax_rate_id
     * item_subtotal			item_quantity * item_price
     * item_tax_total			item_subtotal * tax_rate_percent
     * item_total				item_subtotal + item_tax_total
     * 
     */
    public function calculate($quote_id)
    {
        // Get the basic totals
        $query = $this->db->query("SELECT SUM(item_subtotal) AS quote_item_subtotal,	
		SUM(item_tax_total) AS quote_item_tax_total,
		SUM(item_subtotal) + SUM(item_tax_total) AS quote_total
		FROM fi_quote_item_amounts WHERE item_id IN (SELECT item_id FROM fi_quote_items WHERE quote_id = " . $this->db->escape($quote_id) . ")");

        $quote_amounts = $query->row();

        // Create the database array and insert or update
        $db_array = array(
            'quote_id'             => $quote_id,
            'quote_item_subtotal'  => $quote_amounts->quote_item_subtotal,
            'quote_item_tax_total' => $quote_amounts->quote_item_tax_total,
            'quote_total'          => $quote_amounts->quote_total
        );

        $this->db->where('quote_id', $quote_id);
        if ($this->db->get('fi_quote_amounts')->num_rows())
        {
            // The record already exists; update it
            $this->db->where('quote_id', $quote_id);
            $this->db->update('fi_quote_amounts', $db_array);
        }
        else
        {
            // The record does not yet exist; insert it
            $this->db->insert('fi_quote_amounts', $db_array);
        }

        // Calculate the quote taxes
        $this->calculate_quote_taxes($quote_id);
    }

    public function calculate_quote_taxes($quote_id)
    {
        // First check to see if there are any quote taxes applied
        $this->load->model('quotes/mdl_quote_tax_rates');
        $quote_tax_rates = $this->mdl_quote_tax_rates->where('quote_id', $quote_id)->get()->result();

        if ($quote_tax_rates)
        {
            // There are quote taxes applied
            // Get the current quote amount record
            $quote_amount = $this->db->where('quote_id', $quote_id)->get('fi_quote_amounts')->row();

            // Loop through the quote taxes and update the amount for each of the applied quote taxes
            foreach ($quote_tax_rates as $quote_tax_rate)
            {
                if ($quote_tax_rate->include_item_tax)
                {
                    // The quote tax rate should include the applied item tax
                    $quote_tax_rate_amount = ($quote_amount->quote_item_subtotal + $quote_amount->quote_item_tax_total) * ($quote_tax_rate->quote_tax_rate_percent / 100);
                }
                else
                {
                    // The quote tax rate should not include the applied item tax
                    $quote_tax_rate_amount = $quote_amount->quote_item_subtotal * ($quote_tax_rate->quote_tax_rate_percent / 100);
                }

                // Update the quote tax rate record
                $db_array = array(
                    'quote_tax_rate_amount' => $quote_tax_rate_amount
                );
                $this->db->where('quote_tax_rate_id', $quote_tax_rate->quote_tax_rate_id);
                $this->db->update('fi_quote_tax_rates', $db_array);
            }

            // Update the quote amount record with the total quote tax amount
            $this->db->query("UPDATE fi_quote_amounts SET quote_tax_total = (SELECT SUM(quote_tax_rate_amount) FROM fi_quote_tax_rates WHERE quote_id = " . $this->db->escape($quote_id) . ") WHERE quote_id = " . $this->db->escape($quote_id));

            // Get the updated quote amount record
            $quote_amount = $this->db->where('quote_id', $quote_id)->get('fi_quote_amounts')->row();

            // Recalculate the quote total
            $quote_total = $quote_amount->quote_item_subtotal + $quote_amount->quote_item_tax_total + $quote_amount->quote_tax_total;

            // Update the quote amount record
            $db_array = array(
                'quote_total' => $quote_total
            );

            $this->db->where('quote_id', $quote_id);
            $this->db->update('fi_quote_amounts', $db_array);
        }
        else
        {
            // No quote taxes applied

            $db_array = array(
                'quote_tax_total' => '0.00'
            );

            $this->db->where('quote_id', $quote_id);
            $this->db->update('fi_quote_amounts', $db_array);
        }
    }

    public function get_total_quoted($period = NULL)
    {
        switch ($period)
        {
            case 'month':
                return $this->db->query("
					SELECT SUM(quote_total) AS total_quoted 
					FROM fi_quote_amounts 
					WHERE quote_id IN 
					(SELECT quote_id FROM fi_quotes 
					WHERE MONTH(quote_date_created) = MONTH(NOW()) 
					AND YEAR(quote_date_created) = YEAR(NOW()))")->row()->total_quoted;
            case 'last_month':
                return $this->db->query("
					SELECT SUM(quote_total) AS total_quoted 
					FROM fi_quote_amounts 
					WHERE quote_id IN 
					(SELECT quote_id FROM fi_quotes 
					WHERE MONTH(quote_date_created) = MONTH(NOW() - INTERVAL 1 MONTH)
					AND YEAR(quote_date_created) = YEAR(NOW() - INTERVAL 1 MONTH))")->row()->total_quoted;
            case 'year':
                return $this->db->query("
					SELECT SUM(quote_total) AS total_quoted 
					FROM fi_quote_amounts 
					WHERE quote_id IN 
					(SELECT quote_id FROM fi_quotes WHERE YEAR(quote_date_created) = YEAR(NOW()))")->row()->total_quoted;
            case 'last_year':
                return $this->db->query("
					SELECT SUM(quote_total) AS total_quoted 
					FROM fi_quote_amounts 
					WHERE quote_id IN 
					(SELECT quote_id FROM fi_quotes WHERE YEAR(quote_date_created) = YEAR(NOW() - INTERVAL 1 YEAR))")->row()->total_quoted;
            default:
                return $this->db->query("SELECT SUM(quote_total) AS total_quoted FROM fi_quote_amounts")->row()->total_quoted;
        }
    }

    public function get_status_totals()
    {
        $this->db->select("quote_status_id, SUM(quote_total) AS sum_total, COUNT(*) AS num_total");
        $this->db->join('fi_quotes', 'fi_quotes.quote_id = fi_quote_amounts.quote_id');
        $this->db->group_by('quote_status_id');
        $results = $this->db->get('fi_quote_amounts')->result_array();

        $return = array();

        foreach ($this->mdl_quotes->statuses() as $key => $status)
        {
            $return[$key] = array(
                'quote_status_id' => $key,
                'class'             => $status['class'],
                'label'             => $status['label'],
                'href'              => $status['href'],
                'sum_total'       => 0,
                'num_total'       => 0
            );
        }

        foreach ($results as $result)
        {
            $return[$result['quote_status_id']] = array_merge($return[$result['quote_status_id']], $result);
        }

        return $return;
    }

}

?>