<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Vendor extends CI_Controller {



	 public function __construct()

    {

        parent::__construct();

        $this->load->helper('url');

        $this->load->model('vendormodel');

        $this->load->library(array('session', 'form_validation'));

        $this->no_cache();

		$this->load->library("pagination");

    }

	

	public function index()

	{

		//$this->load->view('navigation');

		$this->load->view('index');

		//$this->load->view('footer');

	}

	function dashboard(){

		$this->load->view('dashboard');

		}



	function login(){
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('username','Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password','Password', 'required|trim|xss_clean');



        if($this->form_validation->run()==FALSE)

        {

           $this->load->view('index');

        }

        else

        {

            $username = $this->input->post('username');

            $password = md5($this->input->post('password'));

            $cek = $this->vendormodel->loginUser($username, $password);

            if($cek <> 0)

            {

                redirect('vendor/dashboard');

            }

            else

            {
				$dat['message']="Failed Login: Check your Username and password!";
			   $this->load->view('index',$dat);
            }

        }

    }

	function logout(){

		$this->session->unset_userdata('username');

		$this->session->unset_userdata('verdorid');

		$this->session->sess_destroy();

		header("Location: ".$this->config->site_url());

	}

	function ajax_postdata(){
		

		$this->load->view('ajax_postdata');

		}

	function add_user(){

		if($this->session->userdata('username')== FALSE)

			{

				header("Location: ".$this->config->site_url());

			}

		else{

				$this->load->view('add_user');

			}

		}

	function edit_user(){

		if($this->session->userdata('username')== FALSE)

			{

				header("Location: ".$this->config->site_url());

			}

		else{

				$this->load->view('edit_user');

			}

		}

	function userlist(){

			 if($this->session->userdata('username')== FALSE)

			{

				header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('user_management');

			}

		}

	function add_vendor(){

		if($this->session->userdata('username')== FALSE)

			{

				header("Location: ".$this->config->site_url());

			}

		else{

			$this->load->view('add_vendor');

			}

		}

	function edit_vendor(){

		 if($this->session->userdata('username')== FALSE)

			{

				header("Location: ".$this->config->site_url());

			}

		else{

				$this->load->view('edit_vendor');

		    }

		}

	function vendorlist(){

			 if($this->session->userdata('username')== FALSE)

			{

				header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('company_list');

			}

		}

	function manage_order(){

			  if($this->session->userdata('username')== FALSE)

			{

				 header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('manage_order');

			}

		}
		
	function file_view($id){

			if($this->session->userdata('username')== FALSE)

			{
				 header("Location: ".$this->config->site_url());
			}

			else{
			     $data['id'] = $id;
				$this->load->view('file_view', $data);

			}

	}

	function add_entry(){

			 if(($this->session->userdata('verdorid')== "0") || ($this->session->userdata('username')== "byer"))

			{

				 redirect('vendor/dashboard');

			}

			else{

				$this->load->view('add_entry');

			}

		}

	function update_entry(){

			  if($this->session->userdata('username')== FALSE)

			{

				 header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('edit_order');

			}

		}

	function view_order(){

			  if($this->session->userdata('username')== FALSE)

			{

				 header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('view_order');

			}

		}

	function print_sample(){

			  if($this->session->userdata('username')== FALSE)

			{

				 header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('print_sample');

			}

		}

		

	function manage_supplier(){

			  if($this->session->userdata('username')== FALSE)

			{

				 header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('manage_supplier');

			}

		}

	function add_supplier(){

			 if(($this->session->userdata('verdorid')== "0") || ($this->session->userdata('username')== "byer"))

			{

				 redirect('vendor/dashboard');

			}

			else{

				$this->load->view('suplier_entry');

			}

		}

	function update_supplier(){

			  if($this->session->userdata('username')== FALSE)

			{

				 header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('edit_supplier');

			}

		}

	function view_supplier(){

			  if($this->session->userdata('username')== FALSE)

			{

				 header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('view_supplier');

			}

		}

	function print_supplier(){

			  if($this->session->userdata('username')== FALSE)

			{

				 header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('print_supplier');

			}

		}

	function manageprofile(){

			 if($this->session->userdata('username')== FALSE)

			{

				header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('manage_profile');

			}

		}

	function changepass(){

			 if($this->session->userdata('username')== FALSE)

			{

				header("Location: ".$this->config->site_url());

			}

			else{

				$this->load->view('change_pass');

			}

		}

    protected function no_cache(){

        header('Cache-Control: no-store, no-cache, must-revalidate');

        header('Cache-Control: post-check=0, pre-check=0',false);

        header('Pragma: no-cache');

    }



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */