<?php 
class Page_model extends CI_Model {
    
    public function get_page(){
        //SELECT c.menu_id, c.name as name, IFNULL(p.name,0) as p_name, c.permalink FROM menu as c LEFT JOIN menu as p ON p.menu_id=c.parent_id
            $query = $this->db->get('menu');
            return $query->result();
    }
    
        
    public function insert(){
        $nama = $this->input->post('name');
        $permalink = $this->core->encode_permalink($nama);
        
        $count =$this->count_page($nama);
        if ($count>0) {
            $count+=1;
            $permalink.='-'.$count;
        }
//        echo $count;
//        echo $permalink;
        $data=array(
            'name' => $nama,
            'permalink' => $permalink
        );
        
        $query = $this->db->insert('menu',$data);
        //$this->db->last_query();
        return $this->db->affected_rows();
    }
    
    public function count_page($data){
        $param = array('name'=>$data);
        $query = $this->db->get_where('menu',$param);
        return $query->num_rows();
    }
    
    public function delete($param){
        $this->db->delete('menu',$param);
        return $this->db->affected_rows();
    }
    
    public function get_data($id){
        $query = $this->db->get_where('menu',array('menu_id'=>$id));
            return $query->result();
    }
    
    public function update(){
        $id=  base64_decode($this->input->post('id'));
        $name = $this->input->post('name');
        
        $permalink = $this->core->encode_permalink($name);
        
        $count =$this->count_page($name);
        if ($count>0) {
            $count+=1;
            $permalink.='-'.$count;
        }
//        echo $count;
//        echo $permalink;
        $data=array(
            'name' => $name,
            'permalink' => $permalink
        );
        
        $this->db->trans_start();
            $this->db->where('menu_id',$id);
            $this->db->update('menu',$data);
        $this->db->trans_complete();
        
        if ($this->db->affected_rows()>0) return TRUE;
        elseif ($this->db->trans_status()===FALSE) return FALSE;
        else return TRUE;
        
    }
}

?>
