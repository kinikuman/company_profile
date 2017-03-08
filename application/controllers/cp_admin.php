<?php
class Cp_admin extends CI_Controller {
   
    public function __construct()
       {
            parent::__construct();
            $this->load->library('core');
       }
        
    function index(){
        $header['title'] = 'Admin Panel';
        $this->core->render('konten',$header);   
    }
    
}
?>
