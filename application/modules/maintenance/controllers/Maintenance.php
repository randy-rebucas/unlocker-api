<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * MyClinicSoft
 * 
 * A web based clinical system
 *
 * @package     MyClinicSoft
 * @author      Randy Rebucas
 * @copyright   Copyright (c) 2016 - 2018 MyClinicSoft, LLC
 * @license     http://www.myclinicsoft.com/license.txt
 * @link        http://www.myclinicsoft.com
 * 
 */
class Maintenance extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		$this->output->set_status_header('503'); 
		$this->load->view('maintenance');
	}
	
}
