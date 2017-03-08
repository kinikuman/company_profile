<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post_model extends CI_Model {
    
    function count_title($data){
        $param = array('title'=>$data);
        $query = $this->db->get_where('post',$param);
        return $query->num_rows();
    }
    
    function insert($data){
        $img=$data['file_name'];
       
        $title = $this->input->post('title');
        $permalink = $this->core->encode_permalink($title);
        
        $count =$this->count_title($title);
        if ($count>0) {
            $count+=1;
            $permalink.='-'.$count;
        }
        
        $data=array(
            'title' => $title,
            'menu_id'=>  $this->input->post('page'),
            'date'=>  date('Y-m-d'),
            'content'=>$this->input->post('content'),
            'permalink' => $permalink,
            'img'=>$img,
            'status' => $this->input->post('submit')
        );
        
        $query = $this->db->insert('post',$data);
        return $this->db->affected_rows();
        
    }
    
    function get_post(){
        $this->db->select('*')
                ->from('post')
                ->join('menu','post.menu_id=menu.menu_id','LEFT');
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_data($id){
        $query = $this->db->get_where('post',array('post_id'=>$id));
        return $query->result();
    }
    
    function update($data){
        $img=$data['file_name'];
        $old_img = $data['old_img'];
        $id =  base64_decode($this->input->post('id'));
       
        $title = $this->input->post('title');
        $permalink = $this->core->encode_permalink($title);
        
        $count =$this->count_title($title);
        if ($count>0) {
            $count+=1;
            $permalink.='-'.$count;
        }
        
        $data=array(
            'title' => $title,
            'menu_id'=>  $this->input->post('page'),
            'content'=>$this->input->post('content'),
            'content'=>$this->input->post('content'),
            'permalink' => $permalink,
            'img'=>$img,
            'status' => $this->input->post('submit')
        );
        
        if(($this->input->post('status')=='draft')&&($data['status']=='publish'))$data['date']=date('Y-m-d');
        
        $this->db->trans_start();
            $this->db->where('post_id',$id);
            $this->db->update('post',$data);
        $this->db->trans_complete();
        
        //---hapus gambar lama
        $this->load->helper('file');
        if(($img!=$old_img)&&($img!=0)){
            unlink('./assets/uploads/'.$old_img);
        }
        
        if ($this->db->affected_rows()>0) return TRUE;
        elseif ($this->db->trans_status()===FALSE) return FALSE;
        else return TRUE;
    }
}

?>
