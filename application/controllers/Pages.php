<?php
class Pages extends CI_Controller {

	public function view($page = 'login')
	{
		if((!file_exists(APPPATH. 'views/'.$page.'.php'))) {
			show_404();
		}
		$this->load->view('templates/header');
		$this->load->view('login');
		$this->load->view('templates/footer');

	}
}
