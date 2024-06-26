<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('header');
		$this->load->view('contact');
		$this->load->view('footer');
		
	}
	public function form()
	{
		if (empty($_POST)) {
			redirect(base_url());
		}

		// Storing google recaptcha response
		// in $recaptcha variable

		$this->load->library('email');

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user'] = 'theodinjaipur@gmail.com';
		$config['smtp_pass'] = 'ilhphiqmihlvezxk';
		$config['charset'] = 'utf-8';
		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not

		$this->email->initialize($config);

		$from = 'theodinjaipur@gmail.com';
		// $to = 'anshulkumar969602@gmail.com';
		$to = '3dn@3desirenetworks.com';

		$subject = 'Job Form Mailbox';
		$message = 'Hello Team, <br /> You have a contact request on 3 Desire Network Portal. <br />';
		unset($_POST['g-recaptcha-response']);

		foreach ($_POST as $key => $value) {
			$message = $message . $key . '- ' . $value . '<br>';
		}



		$this->email->set_newline("\r\n");
		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
		echo '<script>alert("Thank you for your submission!");</script>';
		redirect(base_url(''));

	}
}
