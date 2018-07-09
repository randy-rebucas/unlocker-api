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

class Payment_Methods extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_payment_methods');
	}
	
	public function index($page = 0)
	{
        $this->mdl_payment_methods->paginate(site_url('payment_methods/index'), $page);
        $payment_methods = $this->mdl_payment_methods->result();
        
		$this->layout->set('payment_methods', $payment_methods);
		$this->layout->buffer('content', 'payment_methods/index');
		$this->layout->render();
	}
	
	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('payment_methods');
		}
		
		if ($this->mdl_payment_methods->run_validation())
		{
			$this->mdl_payment_methods->save($id);
			redirect('payment_methods');
		}
		
		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_payment_methods->prep_form($id))
            {
                show_404();
            }
		}
		
		$this->layout->buffer('content', 'payment_methods/form');
		$this->layout->render();
	}
	
	public function delete($id)
	{
		$this->mdl_payment_methods->delete($id);
		redirect('payment_methods');
	}

}

?>