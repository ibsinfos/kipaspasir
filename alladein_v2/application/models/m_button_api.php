<?php
  class M_button_api extends CI_Model {
	  
	  function getAll($bap_name='', $me_username='', 
                  $bap_price1='', $bap_price2='', 
                  $bap_gold1='', $bap_gold2='', 
                  $bap_silver1='', $bap_silver2='', $limit=100000, 
                  $bap_name_arr=array()) {
		  $this->db->select('*');
		  $this->db->from('button_api bap, members me');
                  $this->db->where('bap.me_id = me.me_id');
                  if ($bap_name != '') {
                      $this->db->where('UPPER(bap.bap_name) LIKE UPPER(\'%'.$bap_name.'%\')');
                  }
                  if ($me_username != '') {
                      $this->db->where('UPPER(me.me_username) LIKE UPPER(\'%'.$me_username.'%\')');
                  }
                  if ($bap_price1 != '') {
                      $this->db->where('(bap.bap_price <> \'\' AND bap.bap_price <> \'NIL\' AND bap.bap_price >= '.$bap_price1.')');
                  }
                  if ($bap_price2 != '') {
                      $this->db->where('(bap.bap_price <> \'\' AND bap.bap_price <> \'NIL\' AND bap.bap_price <= '.$bap_price2.')');
                  }
                  if ($bap_gold1 != '') {
                      $this->db->where('(bap.bap_gold <> \'\' AND bap.bap_gold <> \'NIL\' AND bap.bap_gold >= '.$bap_gold1.')');
                  }
                  if ($bap_gold2 != '') {
                      $this->db->where('(bap.bap_gold <> \'\' AND bap.bap_gold <> \'NIL\' AND bap.bap_gold <= '.$bap_gold2.')');
                  }
                  if ($bap_silver1 != '') {
                      $this->db->where('(bap.bap_silver <> \'\' AND bap.bap_silver <> \'NIL\' AND bap.bap_silver >= '.$bap_silver1.')');
                  }
                  if ($bap_silver2 != '') {
                      $this->db->where('(bap.bap_silver <> \'\' AND bap.bap_silver <> \'NIL\' AND bap.bap_silver <= '.$bap_silver2.')');
                  }
                  if (isset($bap_name_arr) && !empty($bap_name_arr)) {
                      $bna_str = "(";
                      foreach ($bap_name_arr as $bna) {
                          $bna_str .= sprintf("UPPER(bap.bap_name) LIKE UPPER('%%%s%%') AND ", $bna);
                      }
                      $bna_str .= "UPPER(bap.bap_name) LIKE UPPER('%%'))";
                      $this->db->where($bna_str);
                  }
//                  $this->db->order_by('bap.bap_id', 'DESC');
//                  $this->db->order_by('bap.bap_datetime', 'DESC');
                  $this->db->order_by('RAND()');
                  $this->db->limit($limit);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function getAll_member($me_id) {
		  $this->db->select('*');
		  $this->db->from('button_api bap, members me');
		  $this->db->where('me.me_id = bap.me_id');
		  $this->db->where('me.me_id', $me_id);
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
		  $this->db->from('button_api bap');
                  $this->db->join('members me', 'me.me_id = bap.me_id', 'left');
		  $this->db->where('bap.bap_id', $id);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function add($data) {
		  if($this->db->insert('button_api', $data)) {
			  return $this->db->insert_id();
		  } else {
			  return 0;
		  }
	  }
	  
	  function edit($id, $data) {
		  $this->db->where('bap_id', $id);
		  return $this->db->update('button_api', $data);
	  }
	  
	  function delete($id) {
		  $this->db->where('bap_id', $id);
		  return $this->db->delete('button_api');
	  }
	
  }

?>