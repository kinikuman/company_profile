<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Core {
    
    var $admin_view = 'cp_admin/';
    
    public function render($view_konten,$data_header=NULL,$data_konten=NULL){
        $CI =& get_instance();
        
        $CI->load->view($this->admin_view.'header',$data_header);
        $CI->load->view($this->admin_view.'menu');
        $CI->load->view($this->admin_view.$view_konten,$data_konten);
        $CI->load->view($this->admin_view.'footer');
        
    }
    
    public function encode_permalink($data){
        $char = array(' ','_','.','!','@','#','%','^','&','*');
        $permalink=  str_ireplace($char,'-', $data);
        return $permalink;
    }
}
/** End of file Render.php */
?>
