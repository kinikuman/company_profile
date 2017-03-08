<?php

class cp_pages extends CI_Controller {
    
    public function __construct()
       {
            parent::__construct();
        $this->load->library('form_validation');
       // $this->load->library('core');
        $this->load->helper('form');
        $this->load->model('page_model');
       }
    
      public function index(){
        $header['title'] = 'Page management';
        $konten['title'] = 'Page management';
        $konten['table'] = $this->page_model->get_page();
                
        $this->core->render('page',$header,$konten);
    }
    
    function add(){
        $result=$this->page_model->insert();
        if($result>0){
            $this->session->set_flashdata('status','success');
            $this->session->set_flashdata('message','Success. New page added');
        } else {
            $this->session->set_flashdata('status','fail');
            $this->session->set_flashdata('message','Failed. Something is wrong');
        }
       redirect(base_url().'cp_pages');
    }
    
    function update($param=NULL){
        
        if($param!=NULL){ //-------- load form edit
            $result=$this->page_model->get_data(base64_decode($param));
            $data['id'] = $param;
            foreach ($result as $x){
                $data['konten'] = $x;
            }
            
            $header['title'] = 'Page management';
            $konten['title'] = 'Page management';
            $this->core->render('page_edit',$header,$data);
            
        } elseif ($this->input->post('submit')=='update') { //--- form update disubmit
            if($this->page_model->update()){ //------ jika berhasil edit (TRUE)
                $this->session->set_flashdata('status','success');
                $this->session->set_flashdata('message','Success. Page updated');
            } else {
                $this->session->set_flashdata('status','fail');
                $this->session->set_flashdata('message','Failed. Something is wrong');
            }
            redirect(base_url().'cp_pages');
        } else redirect(base_url().'cp_pages');
    }
    
    function delete($param){
       $data=  array('menu_id'=>base64_decode($param));
       $result = $this->page_model->delete($data);
       if($result>0){
            $this->session->set_flashdata('status','success');
            $this->session->set_flashdata('message','Success. Page deleted');
        } else {
            $this->session->set_flashdata('status','fail');
            $this->session->set_flashdata('message','Failed. Something is wrong');
        }
        
        redirect(base_url().'cp_pages');
       
    }
    
    function submit(){
        
    }
}

?>
