<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail {
  //$this->send_email('change_email', $data['new_email'], $data);
   function send_email($type, $email, &$data){
      $CI =& get_instance();
      $CI->load->library('email');
      $CI->email->from($CI->config->item('webmaster_email', 'tank_auth'), $CI->config->item('website_name', 'tank_auth'));
      $CI->email->reply_to($CI->config->item('webmaster_email', 'tank_auth'), $CI->config->item('website_name', 'tank_auth'));
      $CI->email->to($email);
      $CI->email->subject(sprintf($this->lang->line('notification_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
      $CI->email->message($CI->load->view('email/'.$type.'-html', $data, TRUE));
      $CI->email->set_alt_message($CI->load->view('email/'.$type.'-txt', $data, TRUE));
      if(!$CI->email->send()) {

            log_message("ERROR", "email sending failed to: $email");
            log_message("ERROR", $CI->email->print_debugger());
      }
   }     

   //use leases notification email only
   function send_notification($type, $email, &$data) 
   {
      $CI =& get_instance();
      $config = array(
        'protocol'      => 'smtp',
        'smtp_host'     => '',//'192.168.2.10'//mail.catahosting.com.au,
        'smtp_port'     => 25,
        'smtp_user'     => '',
        'smtp_pass'     => '',
        'mailtype'      => 'html', 
        'charset'       => 'iso-8859-1',
        'bcc_batch_mode'    => true,
        'bcc_batch_size'    => 5
      );

      $CI->load->library('email', $config);
      $CI->email->set_newline("\r\n");
      //$CI->email->from('support@realsoft.com.au', 'Realsoft');
      //$CI->email->bcc('deon@catasoftware.com.au');
      $CI->email->to($email);
      $CI->email->subject('Lease over due notification');
      $CI->email->message($CI->load->view('email/'.$type.'-html', $data, TRUE));
      if(!$CI->email->send()) {

            log_message("ERROR", "email sending failed to: $email");
            log_message("ERROR", $CI->email->print_debugger());
      } 
      

   }

}

?>
