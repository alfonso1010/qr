<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('phpass-0.3/PasswordHash.php');

//define('PHPASS_HASH_STRENGTH', 8);
//define('PHPASS_HASH_PORTABLE', false);

/**
 * SimpleLoginSecure Class
 *
 * Makes authentication simple and secure.
 *
 * Simplelogin expects the following database setup. If you are not using 
 * this setup you may need to do some tweaking.
 *   
 * For MYSQL 5.0 and 5.5 use :
 *
 *   CREATE TABLE `users` (
 *     `user_id` int(10) unsigned NOT NULL auto_increment,
 *     `user_email` varchar(255) NOT NULL default '',
 *     `user_pass` varchar(60) NOT NULL default '',
 *     `user_date` datetime NOT NULL default '0000-00-00 00:00:00',
 *     `user_modified` datetime NOT NULL default '0000-00-00 00:00:00',
 *     `user_last_login` datetime NULL default NULL,
 *     PRIMARY KEY  (`user_id`),
 *     UNIQUE KEY `user_email` (`user_email`),
 *   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 *
 * For MYSQL 5.6 and more use :
 *
 *   CREATE TABLE `users` (
 *     `user_id` int(10) unsigned NOT NULL auto_increment,
 *     `user_email` varchar(255) NOT NULL default '',
 *     `user_pass` varchar(60) NOT NULL default '',
 *     `user_date` datetime NOT NULL default CURRENT_TIMESTAMP,
 *     `user_modified` datetime NOT NULL default CURRENT_TIMESTAMP,
 *     `user_last_login` datetime NULL default NULL,
 *     PRIMARY KEY  (`user_id`),
 *     UNIQUE KEY `user_email` (`user_email`),
 *   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 * 
 * @package   SimpleLoginSecure
 * @version   2.1.1
 * @author    Stéphane Bourzeix, Pixelmio <stephane[at]bourzeix.com>
 * @copyright Copyright (c) 2012-2013, Stéphane Bourzeix
 * @license   http://www.gnu.org/licenses/gpl-3.0.txt
 * @link      https://github.com/DaBourz/SimpleLoginSecure
 */
class SimpleLoginSecure
{
	protected $CI; // CodeIgniter object
	protected $user_table = 'usuarios'; // Table name
	
	/**
	* Constructor
	* Get the current CI object
	*/
	public function __construct()
    {
        // Assign the CodeIgniter super-object
		$this->CI =& get_instance();
	}


	/**
	 * Login and sets session variables
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function login($user_email = '', $user_pass = '') 
	{
		//$this->CI->session->sess_create();
		//session_start();
		if($user_email == '' OR $user_pass == '')
			return false;

		//Check against user table
		$this->CI->db->where('email', $user_email); 
		$query = $this->CI->db->get_where($this->user_table);

		
		if ($query->num_rows() > 0) 
		{
			$user_data = $query->row_array(); 

			$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

			if(!$hasher->CheckPassword($user_pass, $user_data['password']))
				return false;

			//Create a fresh, brand new session
			if (CI_VERSION >= '3.0') {
				//$this->CI->session->sess_regenerate(TRUE);
			} else {
				//Destroy old session
				$this->CI->session->sess_destroy();
				$this->CI->session->sess_create();
			}

			$this->CI->db->simple_query('UPDATE ' . $this->user_table  . ' SET user_last_login = "' . date('c') . '" WHERE id = ' . $user_data['id']);

			//Set session data
			unset($user_data['password']);
			$user_data['user'] = $user_data['email']; // for compatibility with Simplelogin
			$user_data['logged_in'] = true;
			//$this->CI->session->set_userdata($user_data);
			
			return $user_data;
		} 
		else 
		{
			return false;
		}	

	}

	/**
	 * Logout user
	 *
	 * @access	public
	 * @return	void
	 */
	function logout() {	
		$this->CI->session->sess_destroy();
	}

	
	
}
?>
