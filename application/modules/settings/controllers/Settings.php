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

class Settings extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Mdl_settings');
    }

    public function index()
    {
        if ($this->input->post('settings'))
        {
            $settings = $this->input->post('settings');

            // Only execute if the setting is different
            if ($settings['tax_rate_decimal_places'] <> $this->Mdl_settings->setting('tax_rate_decimal_places'))
            {
                $this->db->query("ALTER TABLE `fi_tax_rates` CHANGE `tax_rate_percent` `tax_rate_percent` DECIMAL( 5, {$settings['tax_rate_decimal_places']} ) NOT NULL");
            }

            // Save the submitted settings
            foreach ($settings as $key => $value)
            {
                // Don't save empty passwords
                if ($key == 'smtp_password' or $key == 'merchant_password')
                {
                    if ($value <> '')
                    {
                        $this->load->library('encrypt');
                        $this->Mdl_settings->save($key, $this->encrypt->encode($value));
                    }
                }
                else
                {
                    $this->Mdl_settings->save($key, $value);
                }
            }

            $upload_config = array(
                'upload_path'   => './uploads/',
                'allowed_types' => '*',
                'max_size'      => '9999',
                'max_width'     => '9999',
                'max_height'    => '9999'
            );

            // Check for invoice logo upload
            if ($_FILES['invoice_logo']['name'])
            {
                $this->load->library('upload', $upload_config);

                if (!$this->upload->do_upload('invoice_logo'))
                {
                    $this->session->set_flashdata('alert_error', $this->upload->display_errors());
                    redirect('settings');
                }

                $upload_data = $this->upload->data();

                $this->Mdl_settings->save('invoice_logo', $upload_data['file_name']);
            }

            // Check for login logo upload
            if ($_FILES['login_logo']['name'])
            {
                $this->load->library('upload', $upload_config);

                if (!$this->upload->do_upload('login_logo'))
                {
                    $this->session->set_flashdata('alert_error', $this->upload->display_errors());
                    redirect('settings');
                }

                $upload_data = $this->upload->data();

                $this->Mdl_settings->save('login_logo', $upload_data['file_name']);
            }

            $this->session->set_flashdata('alert_success', lang('settings_successfully_saved'));

            redirect('settings');
        }

        // Load required resources
        $this->load->model('invoice_groups/Mdl_invoice_groups');
        $this->load->model('tax_rates/Mdl_tax_rates');
        $this->load->model('email_templates/Mdl_email_templates');
        $this->load->model('settings/Mdl_versions');
        $this->load->model('payment_methods/Mdl_payment_methods');
        $this->load->model('invoices/Mdl_templates');

        $this->load->helper('directory');
        $this->load->library('merchant');

        // Collect the list of templates
        $pdf_invoice_templates    = $this->Mdl_templates->get_invoice_templates('pdf');
        $public_invoice_templates = $this->Mdl_templates->get_invoice_templates('public');
        $pdf_quote_templates    = $this->Mdl_templates->get_quote_templates('pdf');
        $public_quote_templates = $this->Mdl_templates->get_quote_templates('public');

        // Collect the list of languages
        $languages = directory_map(APPPATH . 'language', TRUE);
        sort($languages);

        // Get the current version
        $current_version = $this->Mdl_versions->limit(1)->where('version_sql_errors', 0)->get()->row()->version_file;
        $current_version = str_replace('.sql', '', substr($current_version, strpos($current_version, '_') + 1));

        // Set data in the layout
        $this->layout->set(
            array(
                'invoice_groups'           => $this->Mdl_invoice_groups->get()->result(),
                'tax_rates'                => $this->Mdl_tax_rates->get()->result(),
                'payment_methods'          => $this->Mdl_payment_methods->get()->result(),
                'public_invoice_templates' => $public_invoice_templates,
                'pdf_invoice_templates'    => $pdf_invoice_templates,
                'public_quote_templates'   => $public_quote_templates,
                'pdf_quote_templates'      => $pdf_quote_templates,
                'languages'                => $languages,
                'date_formats'             => date_formats(),
                'current_date'             => new DateTime(),
                'email_templates'          => $this->Mdl_email_templates->get()->result(),
                'merchant_drivers'         => $this->merchant->valid_drivers(),
                'merchant_currency_codes'  => Merchant::$NUMERIC_CURRENCY_CODES,
                'current_version'          => $current_version
            )
        );

        $this->layout->buffer('content', 'settings/index');
        $this->layout->render();
    }

    public function remove_logo($type)
    {
        unlink('./uploads/' . $this->Mdl_settings->setting($type . '_logo'));

        $this->Mdl_settings->save($type . '_logo', '');

        $this->session->set_flashdata('alert_success', lang($type . '_logo_removed'));

        redirect('settings');
    }

}

?>