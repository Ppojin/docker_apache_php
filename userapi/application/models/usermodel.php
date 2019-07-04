<?php

class usermodel extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($page)
    {
        $offset = ($page*10)-10;
        return $this->db->get('users', 10, $offset)->result();
    }

    public function insert_user($data)
    {
        foreach($data as $element => $value){
            if ($value == ""){
                unset($data[$element]);
            }
        }
        return $this->db->insert('users', $data);
    }

    public function update_user($id, $data)
    {
        foreach($data as $element => $value){
            if ($value == ""){
                unset($data[$element]);
            }
        }
        $this->db->where('id',$id);
        return $this->db->update('users',$data);        
    }

    public function find_user($id)
    {
        return $this->db->get_where('users', array('id' => $id))->row();
    }

    public function delete_user($id)
    {
        return $this->db->delete('users', array('id' => $id));
    }
}
?>