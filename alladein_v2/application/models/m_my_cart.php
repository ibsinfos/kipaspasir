<?php
  class M_my_cart extends CI_Model {
	  
	  function getAll() {
		  $this->db->select('*');
		  $this->db->from('my_cart mc');
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
		  $this->db->from('my_cart mc');
		  $this->db->where('mc.mc_id', $id);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function add($data) {
		  if($this->db->insert('my_cart', $data)) {
			  return $this->db->insert_id();
		  } else {
			  return 0;
		  }
	  }
	  
	  function edit($id, $data) {
		  $this->db->where('mc_id', $id);
		  return $this->db->update('my_cart', $data);
	  }
	  
	  function delete($id) {
		  $this->db->where('mc_id', $id);
		  return $this->db->delete('my_cart');
	  }
	
  }

?>