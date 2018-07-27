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

class Mdl_Custom_Fields extends MY_Model {

    public $table       = 'fi_custom_fields';
    public $primary_key = 'fi_custom_fields.custom_field_id';

    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
    }

    public function custom_tables()
    {
        return array(
            'fi_client_custom'  => lang('client'),
            'fi_invoice_custom' => lang('invoice'),
            'fi_payment_custom' => lang('payment'),
            'fi_quote_custom'   => lang('quote'),
            'fi_user_custom'    => lang('user')
        );
    }

    public function validation_rules()
    {
        return array(
            'custom_field_table' => array(
                'field' => 'custom_field_table',
                'label' => lang('table'),
                'rules' => 'required'
            ),
            'custom_field_label' => array(
                'field' => 'custom_field_label',
                'label' => lang('label'),
                'rules' => 'required|max_length[50]'
            )
        );
    }

    public function db_array()
    {
        // Get the default db array
        $db_array = parent::db_array();
        
        // Get the array of custom tables
        $custom_tables = $this->custom_tables();

        // Create the name for the custom field column
        $custom_field_column = strtolower($custom_tables[$db_array['custom_field_table']]) . '_custom_' . preg_replace('/[^a-zA-Z0-9_\s]/', '', strtolower(str_replace(' ', '_', $db_array['custom_field_label'])));

        // Add the custom field column to the db array
        $db_array['custom_field_column'] = $custom_field_column;

        // Return the db array
        return $db_array;
    }

    public function save($id = NULL, $db_array = NULL)
    {
        if ($id)
        {
            // Get the original record before saving
            $original_record = $this->get_by_id($id);
        }

        // Create the record
        $db_array = ($db_array) ? $db_array : $this->db_array();

        // Save the record to fi_custom_fields
        $id = parent::save($id, $db_array);

        if (isset($original_record))
        {
            if ($original_record->custom_field_column <> $db_array['custom_field_column'])
            {
                // The column name differs from the original - rename it
                $this->rename_column($db_array['custom_field_table'], $original_record->custom_field_column, $db_array['custom_field_column']);
            }
        }
        else
        {
            // This is a new column - add it
            $this->add_column($db_array['custom_field_table'], $db_array['custom_field_column']);
        }

        return $id;
    }

    private function add_column($table_name, $column_name)
    {
        $this->load->dbforge();

        $column = array(
            $column_name => array(
                'type'       => 'VARCHAR',
                'constraint' => 255
            )
        );

        $this->dbforge->add_column($table_name, $column);
    }

    private function rename_column($table_name, $old_column_name, $new_column_name)
    {
        $this->load->dbforge();
        
        $column = array(
            $old_column_name => array(
                'name'       => $new_column_name,
                'type'       => 'VARCHAR',
                'constraint' => 255
            )
        );

        $this->dbforge->modify_column($table_name, $column);
    }

    public function delete($id)
    {
        $custom_field = $this->get_by_id($id);

        if ($this->db->field_exists($custom_field->custom_field_column, $custom_field->custom_field_table))
        {
            $this->load->dbforge();
            $this->dbforge->drop_column($custom_field->custom_field_table, $custom_field->custom_field_column);
        }

        parent::delete($id);
    }

    public function by_table($table)
    {
        $this->filter_where('custom_field_table', $table);
        return $this;
    }

}

?>