<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cp_post extends CI_Controller{
    
    public function __construct()
       {
            parent::__construct();
           $this->load->model('page_model');
           $this->load->model('post_model');
           $this->load->library('form_validation');
       }
        
    function index(){
        $header['title']='All Post';
        $data['konten']=$this->post_model->get_post();
        
        $this->core->render('post',$header,$data);
        
    }
    
    function submit(){
       // $upload_status = 1;
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        
        if ($this->form_validation->run()==FALSE){
            $data['error'] = TRUE;
            $data['message'] = validation_errors();
            $this->add($data);
        } else {

        //--------- cek upload image ------
        if($_FILES['img']['name']){ //--- jika ada file
           $config['upload_path'] = './assets/uploads/';
           $config['allowed_types'] = 'gif|jpg|png';
           $config['max_size']	= '2048';
           $config['encrypt_name'] = TRUE;
           
           $this->load->library('upload', $config);
           $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('img')) //-- jika gagal 
		{
			$konten['message'] = $this->upload->display_errors();
                        $konten['error'] = TRUE;
                        //$upload_status = 0;
                        $this->add($konten);
		}
		else
		{
			$data = $this->upload->data();
                
		}     	
        } else {$data['file_name']=0;}
            
                $result=$this->post_model->insert($data);    
        
        }
        }
            
    function add($param=NULL){
        $header['title'] = 'New Post';
        $konten['title'] = 'New Post';
        $konten['dropdown'] = $this->page_model->get_page();
        $konten['error'] = FALSE;
        $konten['message'] = '';
        
        if($param!=NULL){
            $konten['error'] = $param['error'];
            $konten['message'] = $param['message'];
        }
                
        $this->core->render('post_add',$header,$konten);
    }
    
    function update($param=NULL,$data_error=NULL){
        
        if($param!=NULL){ //-------- load form edit
            $result=$this->post_model->get_data(base64_decode($param));
            $data['id'] = $param;
            foreach ($result as $x){
                $data['konten'] = $x;
            }
            
            $header['title'] = 'Edit Post';
            $data['error'] = FALSE;
            $data['message'] = "";
            $data['title'] = 'Edit Post';
            $data['dropdown'] = $this->page_model->get_page();
            
            if($data_error!=NULL){
            $data['error'] = $data_error['error'];
            $data['message'] = $data_error['message'];
            }
            
            $this->core->render('post_edit',$header,$data);
            
        } else redirect(base_url().'cp_pages');
    }
    
    function submit_update(){
                
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('page', 'Page', 'required');
        
        if ($this->form_validation->run()==FALSE){
            $data['error'] = TRUE;
            $data['message'] = validation_errors();
            $this->update($this->input->post('id'),$data);
        } else {
            
            //------- cek apakah ganti gambar? -------
           if($_FILES['img']['name']){ //--- jika ada file
           $config['upload_path'] = './assets/uploads/';
           $config['allowed_types'] = 'gif|jpg|png';
           $config['max_size']	= '2048';
           $config['encrypt_name'] = TRUE;
           
           $this->load->library('upload', $config);
           $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('img')) //-- jika gagal 
		{
			$konten['message'] = $this->upload->display_errors();
                        $konten['error'] = TRUE;
                        //$upload_status = 0;
                        $this->update($this->input->post('id'),$konten);
		}
		else
		{
			$data = $this->upload->data();
                        $data['old_img']=$this->input->post('img_src');
                
		}     	
            } else {$data['file_name']=  $this->input->post('img_src');} //jika gambar tidak diganti
            //-------/. cek ganti gambar --
                       
        }
        
            if($this->post_model->update($data)){ //------ jika berhasil edit (TRUE)
                $this->session->set_flashdata('status','success');
                $this->session->set_flashdata('message','Success. Post updated');
            } else {
                $this->session->set_flashdata('status','fail');
                $this->session->set_flashdata('message','Failed. Something is wrong');
            }
            redirect(base_url().'cp_post');
    }
    
    function delete_img($idn=NULL){
        if($idn==NULL){
            redirect(base_url().'cp_post/');
        } else {
            $this->load->helper('file');
            $id=base64_decode($idn);
            
            $result=$this->post_model->get_data($id);
            $data='';
            foreach ($result as $row) {
                    $data = $row->img;
                }
                echo $data;
            if($data==''){
                $this->session->set_flashdata('status','fail');
                $this->session->set_flashdata('message','There\'s no such image');
               // redirect(base_url().'cp_post');
            } else {
                echo $data;
                unlink('./assets/uploads/'.$data);
                echo '<script>alert("image deleted!");</script>';
                //redirect(base_url().'cp_post/update/'.$idn);
            }
        }
    }
}
?>