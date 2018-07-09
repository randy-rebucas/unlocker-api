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

class Mdl_Sessions extends CI_Model {

    public function auth($email, $password)
    {
        $this->db->where('user_email', $email);

        $query = $this->db->get('fi_users');

        if ($query->num_rows())
        {
            $user = $query->row();

            $this->load->library('sessions/my_crypt');

            /**
             * Password hashing changed after 1.2.0
             * Check to see if user has logged in since the password change
             */
            if (!$user->user_psalt)
            {
                /**
                 * The user has not logged in, so we're going to attempt to
                 * update their record with the updated hash
                 */
                if (md5($password) == $user->user_password)
                {
                    /**
                     * The md5 login validated - let's update this user 
                     * to the new hash
                     */
                    $salt = $this->my_crypt->salt();
                    $hash = $this->my_crypt->generate_password($password, $salt);

                    $db_array = array(
                        'user_psalt'    => $salt,
                        'user_password' => $hash
                    );
                    
                    $this->db->where('user_id', $user->user_id);
                    $this->db->update('fi_users', $db_array);
                    
                    $this->db->where('user_email', $email);
                    $user = $this->db->get('fi_users')->row();
                    
                }
                else
                {
                    /**
                     * The password didn't verify against original md5
                     */
                    return FALSE;
                }
            }

            if ($this->my_crypt->check_password($user->user_password, $password))
            {
                $session_data = array(
                    'user_type' => $user->user_type,
                    'user_id'   => $user->user_id,
                    'user_name' => $user->user_name
                );

                $this->session->set_userdata($session_data);

                return TRUE;
            }
        }

        return FALSE;
    }

}

?>