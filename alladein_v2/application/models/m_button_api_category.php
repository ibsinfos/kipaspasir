<?php
  class M_button_api_category extends CI_Model {
	  
	  function getAll() {
		  $this->db->select('*');
		  $this->db->from('button_api_category bac');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function getParent($bac_parent=0) {
		  $this->db->select('*');
		  $this->db->from('button_api_category bac');
                  $this->db->where('bac.bac_parent', $bac_parent);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function get($id) {
		  $this->db->select('*');
		  $this->db->from('button_api_category bac');
		  $this->db->where('bac.bac_id', $id);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function add($data) {
		  if($this->db->insert('button_api_category', $data)) {
			  return $this->db->insert_id();
		  } else {
			  return 0;
		  }
	  }
	  
	  function edit($id, $data) {
		  $this->db->where('bac_id', $id);
		  return $this->db->update('button_api_category', $data);
	  }
	  
	  function delete($id) {
		  $this->db->where('bac_id', $id);
		  return $this->db->delete('button_api_category');
	  }
	
  }

?>