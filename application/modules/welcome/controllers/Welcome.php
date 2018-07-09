<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
class Welcome extends MX_Controller {

	public function index()
	{
		$this->layout
			->title('Welcome PRB') //$article->title
			// application/views/some_folder/header
			//->set_partial('header', 'includes/widgets') //third param optional $data
			// application/views/some_folder/header
			//->inject_partial('header', '<h1>Hello World!</h1>')  //third param optional $data
			->set_layout('one-column') // application/views/layouts/two_col.php
			->build('welcome_message'); // views/welcome_message
	}
}