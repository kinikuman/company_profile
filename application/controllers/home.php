<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
        public function __construct()
       {
            parent::__construct();
            $this->load->library('parser');
       }
    
	public function index()
	{
		$data['header']=$this->load->view('v_header','',TRUE);
                $data['menu']=$this->load->view('v_menu','',TRUE);
                $data['konten']=$this->load->view('v_konten','',TRUE);
                $data['footer']=$this->load->view('v_footer','',TRUE);
                $this->parser->parse('v_index',$data);
                redirect(base_url().'cp_admin');
	}
        
        public function ok(){
            $this->index();
            echo 'yahooo';
            }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */