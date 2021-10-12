<?php

class Team_model extends CI_Model{
	
	function get_team(){
		$query = $this->db->get('tbl_team');
		return $query;
	}

	function insert_team($nama,$jabatan,$content,$gambar,$twitter,$facebook,$instagram,$linked){
		$data = array(
			'team_name' => $nama,
			'team_org' => $jabatan,
			'team_content' => $content, 
			'team_image' => $gambar,
            'team_twitter' => $twitter,
            'team_facebook' => $facebook,
            'team_instagram' => $instagram,
            'team_linked' => $linked,
		);
		$this->db->insert('tbl_team',$data);
	}

	function update_team($id,$nama,$jabatan,$content,$gambar,$twitter,$facebook,$instagram,$linked){
		$this->db->set('team_name',$nama);
		$this->db->set('team_org',$jabatan);
		$this->db->set('team_content',$content);
		$this->db->set('team_image',$gambar);
        $this->db->set('team_twitter',$twitter);
        $this->db->set('team_facebook',$facebook);
        $this->db->set('team_instagram',$instagram);
        $this->db->set('team_linked',$linked);
		$this->db->where('team_id',$id);
		$this->db->update('tbl_team');
	}

	function update_team_noimg($id,$nama,$jabatan,$content,$twitter,$facebook,$instagram,$linked){
		$this->db->set('team_name',$nama);
		$this->db->set('team_org',$jabatan);
		$this->db->set('team_content',$content);
        $this->db->set('team_twitter',$twitter);
        $this->db->set('team_facebook',$facebook);
        $this->db->set('team_instagram',$instagram);
        $this->db->set('team_linked',$linked);
		$this->db->where('team_id',$id);
		$this->db->update('tbl_team');
	}

	function delete_team($team_id){
		$this->db->where('team_id',$team_id);
		$this->db->delete('tbl_team');
	}
}