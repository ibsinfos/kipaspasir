<?php
  class M_members extends CI_Model {
      
          function deleteMemberAllAccount($me_id) {
              
              // delete members
              $this->db->where('me_id', $me_id);
              $this->db->delete('members');
              
              // delete account
              $this->db->where('me_id', $me_id);
              $this->db->delete('dinarpal_account');
              
              // delete emails
              $this->db->where('me_id', $me_id);
              $this->db->delete('emails');
              
              // delete geneology
              $this->db->where('me_id', $me_id);
              $this->db->delete('geneology_aff');
              
              // geneology back to admin hq
              $data = array('me_id_parent' => 1);
              $this->db->where('me_id_parent', $me_id);
              $this->db->update('geneology_aff', $data);
              
              // delete waris
              $this->db->where('me_id', $me_id);
              $this->db->delete('bene_info_waris');
              
              // delete amanah deal
              $this->db->where('me_id_from', $me_id);
              $this->db->or_where('me_id_to', $me_id);
              $this->db->delete('amanah_deal');
              
              // delete bank member
              $this->db->where('me_id', $me_id);
              $this->db->delete('banks_members');
              
              // delete bid
              $this->db->where('me_id', $me_id);
              $this->db->delete('bid_member');
              
              // delete button api
              $this->db->where('me_id', $me_id);
              $this->db->delete('button_api');
              
              // delete cards
              $this->db->where('me_id', $me_id);
              $this->db->delete('cards');
              
              // delete deposit
              $this->db->where('me_id', $me_id);
              $this->db->delete('deposit');
              
              // delete dinarpal_document
              $this->db->where('me_id', $me_id);
              $this->db->delete('dinarpal_document');
              
              // delete dinarpal_transaction
              $this->db->where('me_id', $me_id);
              $this->db->delete('dinarpal_transaction');
              
              // delete item_storage
              $this->db->where('me_id', $me_id);
              $this->db->delete('item_storage');
              
              // delete keep
              $this->db->where('me_id', $me_id);
              $this->db->delete('keep');
              
              // delete liquid_item
              $this->db->where('me_id', $me_id);
              $this->db->delete('liquid_item');
              
              // delete members_verification
              $this->db->where('me_id', $me_id);
              $this->db->delete('members_verification');
              
              // delete merchant
              $this->db->where('me_id', $me_id);
              $this->db->delete('merchant');
              
              // delete pawn
              $this->db->where('me_id', $me_id);
              $this->db->delete('pawn');
              
              // delete sellbuy_board
              $this->db->where('me_id', $me_id);
              $this->db->delete('sellbuy_board');
              
              // delete send_payment_gram
              $this->db->where('me_id_to', $me_id);
              $this->db->or_where('me_id_from', $me_id);
              $this->db->delete('send_payment_gram');
              
              // delete souq
              $this->db->where('me_id', $me_id);
              $this->db->delete('souq');
              
              // delete transaction
              $this->db->where('me_id_from', $me_id);
              $this->db->or_where('me_id_to', $me_id);
              $this->db->delete('transaction');
              
              // delete used_item
              $this->db->where('me_id', $me_id);
              $this->db->delete('used_item');
              
              // delete withdrawal_gram
              $this->db->where('me_id', $me_id);
              $this->db->delete('withdrawal_gram');
              
              // delete members_group
              $this->db->where('me_id', $me_id);
              $this->db->delete('members_group');
              
              // update vault to admin
              $data1 = array('me_id' => 1, 'vt_id' => 2);
              $this->db->where('me_id', $me_id);
              $this->db->update('vault', $data1);
          }
          
          function isTopBallons($limit=1000, $me_id=0) {
              /**
               * SELECT me_id, me_username 
                    FROM members 
                    WHERE ml_id = 3 
                    AND me_type = 'NU' 
                    AND (me_activation_status = 2 OR me_activation_status = 3) 
                    ORDER BY me_id ASC 
                    LIMIT 1000 
               */
                  $this->db->select('me.me_id, me.me_username');
		  $this->db->from('members me');
                  $this->db->where('me.ml_id', '3');
                  $this->db->where('me.me_type', 'NU');
                  $this->db->where("(me_activation_status = '2' OR me_activation_status = '3')");
                  $this->db->order_by('me.me_id', 'ASC');
                  $this->db->limit($limit);
                  $q = $this->db->get();
		  if($q->num_rows() > 0) {
                      $d = array();
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
                          if (isset($d[$limit-1]) && !empty($d[$limit-1])) {
                            if ($me_id == $d[$limit-1]->me_id) {
                                return true;
                            } else {
                                return false;
                            }
                          } else {
                              return false;
                          }
		  } else {
                      return false;
                  }
          }
          
          function getAll_users($username='', $ma_id=-1, $address=array(), 
                  $limit=500, $mas_ids=array(), $cols=array()) {
                  if (isset($cols) && !empty($cols)) {
                      $str_cols = "";
                      foreach ($cols as $c) {
                          $str_cols .= $c . ", ";
                      }
                      $str_cols .= "me.me_id";
                      $this->db->select($str_cols);
                  } else {
                      $this->db->select('*');
                  }
                  if ($ma_id != -1) {
                      $this->db->from('members me, members_agent ma');
                      $this->db->where('me.ma_id = ma.ma_id');
                  } else {
                      $this->db->from('members me');
                  }
                  if ($username != '') {
                      $this->db->where('me.me_username', $username);
                  }
                  if (isset($mas_ids) && !empty($mas_ids)) {
                      $str_mas = "(";
                      foreach ($mas_ids as $mas_id) {
                          $str_mas .= sprintf("me.me_activation_status = '%s' OR ", $mas_id);
                      }
                      $str_mas .= "1<>1)";
                      $this->db->where($str_mas);
                  }
                  if ($ma_id != -1) {
                      if ($ma_id == -2) {
                          $this->db->where(sprintf("me.ma_id <> 0"));
                      } else {
                          $this->db->where('me.ma_id', $ma_id);
                      }
                  }
                  if (isset($address['address'])) {
                      $me_address = $address['address'];
                      $this->db->where(sprintf("(UPPER(me.me_address1) LIKE UPPER('%%%s%%') OR UPPER(me.me_address2) LIKE UPPER('%%%s%%'))", $me_address, $me_address));
                  }
                  if (isset($address['city'])) {
                      $me_city = $address['city'];
                      $this->db->where(sprintf("(UPPER(me.me_city1) LIKE UPPER('%%%s%%') OR UPPER(me.me_city2) LIKE UPPER('%%%s%%'))", $me_city, $me_city));
                  }
                  if (isset($address['state'])) {
                      $me_state = $address['state'];
                      $this->db->where(sprintf("(UPPER(me.me_state1) LIKE UPPER('%%%s%%') OR UPPER(me.me_state2) LIKE UPPER('%%%s%%'))", $me_state, $me_state));
                  }
                  if (isset($address['postcode'])) {
                      $me_postcode = $address['postcode'];
                      $this->db->where(sprintf("(UPPER(me.me_postcode1) LIKE UPPER('%%%s%%') OR UPPER(me.me_postcode2) LIKE UPPER('%%%s%%'))", $me_postcode, $me_postcode));
                  }
                  if (isset($address['country'])) {
                      $me_country = $address['country'];
                      $this->db->where(sprintf("(UPPER(me.me_country1) LIKE UPPER('%%%s%%') OR UPPER(me.me_country2) LIKE UPPER('%%%s%%'))", $me_country, $me_country));
                  }
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
	  
	  function getAll($ml_id=-1, $me_status=-1, $mas_id=-1, $me_register_date='', 
                  $search_username='', $isCount=false, $me_type='', $me_account_type=-1, 
                  $limit=100, $cols=array()) {
		  
                  if (isset($cols) && !empty($cols)) {
                      $strs = "";
                      foreach ($cols as $co) {
                          $strs .= $co . ", ";
                      }
                      $strs .= "me.me_id";
                      $this->db->select($strs);
                  } else {
                    if ($isCount == true) {
                        $this->db->select('COUNT(me.me_id) AS numCount');
                    } else {
                        $this->db->select('*');
                    }
                  }
		  $this->db->from('members me, dinarpal_account da, '
                          . 'geneology_aff ga, bene_info_waris biw, '
                          . 'members_type mt, members_activation_status mas, '
                          . 'members_online_status mos ');
                  $this->db->where('me.mos_id = mos.mos_id');
		  $this->db->where('me.me_activation_status = mas.mas_id');
		  $this->db->where('me.me_id = da.me_id');
		  $this->db->where('me.me_id = ga.me_id');
		  $this->db->where('me.me_id = biw.me_id');
		  $this->db->where('me.me_type = mt.mt_code');
		  if ($ml_id != -1) {
			  $this->db->where('me.ml_id', $ml_id);
		  }
		  if ($me_status != -1) {
			  $this->db->where('me.me_status', $me_status);
		  }
		  if ($mas_id != -1) {
			  $this->db->where('me.me_activation_status', $mas_id);
		  }
		  if ($me_account_type != -1) {
			  $this->db->where('me.me_account_type', $me_account_type);
		  }
		  if ($me_type != '') {
			  $this->db->where('me.me_type', $me_type);
		  }
                  if ($me_register_date != '') {
                      $this->db->where('DATE(me.me_register_date) = DATE(\''.$me_register_date.'\')');
                  }
                  if ($search_username != '') {
                      $this->db->where(sprintf("UPPER(me.me_username) LIKE UPPER('%%%s%%') ", $search_username));
                  }
		  $this->db->group_by('me.me_id');
                  $this->db->order_by('RAND()');
                  $this->db->order_by('me.mos_id DESC, me.me_register_date DESC, me.me_lat_lon DESC');
                  $this->db->limit($limit);
		  $q = $this->db->get();
                  if ($isCount == true) {
                      if($q->num_rows() > 0) {
                            foreach($q->result() as $r) {
                                    $d[] = $r;
                            }
                            return ((is_numeric($d[0]->numCount)) ? ($d[0]->numCount) : (0));
                    } else {
                        return 0;
                    }
                  } else {
                    if($q->num_rows() > 0) {
                            foreach($q->result() as $r) {
                                    $d[] = $r;
                            }
                            return $d;
                    }
                  }
	  }
          
          function getUniqueRegisterDate($me_register_date='', 
                  $year='0000', $month='00', $date='00', $mas_id=-1, 
                  $limit=100000) {
                /**
                 * SELECT DISTINCT(DATE(me_register_date)) FROM members
                 */
                if ($me_register_date != '') {
                    $this->db->select('COUNT(me.me_id) AS total_me');
                } else {
                    $this->db->select('DISTINCT(DATE(me.me_register_date)) AS unique_me_register_date');
                }
                $this->db->from('members me');
                if ($mas_id != -1) {
                    $this->db->where('me.me_activation_status', $mas_id);
                }
                if ($me_register_date != '' || $year != '0000' || $month != '00' || $date != '00') {
                    if ($me_register_date != '') {
                        $this->db->where(sprintf('DATE(me.me_register_date) = DATE("%s")', $me_register_date));
                    }
                    if ($year != '0000') {
                        $year = (is_numeric($year)) ? ($year) : (date('Y'));
                        $this->db->where(sprintf('YEAR(me.me_register_date) = "%s"', $year));
                    }
                    if ($month != '00') {
                        $month = (is_numeric($month)) ? ($month) : (date('m'));
                        $this->db->where(sprintf('MONTH(me.me_register_date) = "%s"', $month));
                    }
                    if ($year != '0000' && $month != '00' && $date != '00') {
                        $year = (is_numeric($year)) ? ($year) : (date('Y'));
                        $month = (is_numeric($month)) ? ($month) : (date('m'));
                        $date = (is_numeric($date)) ? ($date) : (date('d'));
                        $me_register_date = $year . '-' . $month . '-' . $date . ' 01:01:01';
                        $this->db->where(sprintf('DATE(me.me_register_date) = DATE("%s")', $me_register_date));
                    }
                }
                $this->db->limit($limit);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
          }
          
          function getAll_Staff($ml_id=-1, $me_type='GA', $sl_id=-1) {
		  $this->db->select('*');
		  $this->db->from('members me, members_level ml, '
                          . 'storage_location sl, members_online_status mos ');
		  $this->db->where('me.ml_id = ml.ml_id');
		  $this->db->where('me.sl_id = sl.sl_id');
		  $this->db->where('me.mos_id = mos.mos_id');
		  $this->db->where('me.me_type', $me_type);
		  if ($ml_id != -1) {
			  $this->db->where('me.ml_id', $ml_id);
		  }
		  if ($sl_id != -1) {
			  $this->db->where('me.sl_id', $sl_id);
		  }
		  $this->db->group_by('me.me_id');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function get_StaffWorks($me_id=-1, $year='0000', $month='00', $date='00') {
              /**
               * SELECT 
                    me.me_username, 
                    me.me_firstname, 
                    me.me_lastname, 
                    tt.tt_desc, 
                    COUNT(tt.tt_id), 
                    tr.tr_datetime 
                    FROM transaction tr, members me, transaction_type tt 
                    WHERE tr.me_id_staff = me.me_id 
                    AND tr.tt_id = tt.tt_id 
                    AND MONTH(tr.tr_datetime) = '12' 
                    AND YEAR(tr.tr_datetime) = '2016' 
                    AND me.me_username LIKE '%ur%' 
                    GROUP BY tt.tt_id 
                    ORDER BY me.me_id ASC 
                    LIMIT 10000
               */
		  $this->db->select('me.me_username, 
                    me.me_firstname, 
                    me.me_lastname, 
                    tt.tt_desc, 
                    COUNT(tt.tt_id) AS count_tt_tt_id');
		  $this->db->from('transaction tr, members me, transaction_type tt ');
		  $this->db->where('tr.me_id_staff = me.me_id');
		  $this->db->where('tr.tt_id = tt.tt_id');
		  $this->db->where('me.ml_id', 2);
		  $this->db->where('me.me_type', 'GA');
                  $this->db->where('me.me_id', $me_id);
                  if ($year != '0000') {
                      $this->db->where('YEAR(tr.tr_datetime)', $year);
                  }
                  if ($month != '00') {
                      $this->db->where('MONTH(tr.tr_datetime)', $month);
                  }
                  if ($year != '0000' && $month != '00' && $date != '00') {
                      $dates = $year . '-' . $month . '-' . $date;
                      $this->db->where('tr.tr_datetime', $dates);
                  }
		  $this->db->group_by('tt.tt_id');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function get_Staff($me_id=-1) {
		  $this->db->select('*');
		  $this->db->from('members me, members_level ml, '
                          . 'storage_location sl, members_online_status mos ');
		  $this->db->where('me.ml_id = ml.ml_id');
		  $this->db->where('me.sl_id = sl.sl_id');
		  $this->db->where('me.mos_id = mos.mos_id');
                  $this->db->where('me.me_id', $me_id);
		  $this->db->group_by('me.me_id');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function getAll_DP($me_type='') {
		  $this->db->select('*');
		  $this->db->from('members me, '
                          . 'dinarpal_account da, '
                          . 'geneology_aff ga, '
                          . 'bene_info_waris biw, '
                          . 'members_type mt, '
//                          . 'storage_location sl, '
                          . 'members_status ms');
		  $this->db->where('me.me_id = da.me_id');
		  $this->db->where('me.me_id = ga.me_id');
		  $this->db->where('me.me_id = biw.me_id');
		  $this->db->where('me.me_type = mt.mt_code');
//		  $this->db->where('me.sl_id = sl.sl_id');
		  $this->db->where('me.me_status = ms.ms_id');
                  $this->db->where('me.ml_id', 3);
                  if ($me_type != '') {
                      $this->db->where('me.me_type', $me_type);
                  }
		  $this->db->group_by('me.me_id');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function getAll_Amil($me_id=-1) {
		  $this->db->select('*');
		  $this->db->from('members me, members_type mt, '
                          . 'storage_location sl, members_status ms');
		  $this->db->where('me.me_type = mt.mt_code');
		  $this->db->where('me.sl_id = sl.sl_id');
		  $this->db->where('me.me_status = ms.ms_id');
                  $this->db->where("(me.me_type = 'DP' OR me.me_type = 'GA')");
                  $this->db->where('me.me_is_amil', 'yes');
                  if ($me_id != -1) {
                      $this->db->where('me.me_id', $me_id);
                  }
		  $this->db->group_by('me.me_id');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function get($id, $isStaff=-1, $me_register_date='', $ml_id=-1, $me_type='') {
		  $this->db->select('*');
                  if ($isStaff == -1) {
                    $this->db->from('members me, dinarpal_account da, '
                            . 'geneology_aff ga, bene_info_waris biw, '
                            . 'members_type mt, members_activation_status mas, '
                            . 'members_online_status mos ');
                    $this->db->where('me.me_id = da.me_id');
                    $this->db->where('me.me_id = ga.me_id');
                    $this->db->where('me.me_id = biw.me_id');
                  } else {
                    $this->db->from('members me, members_type mt, '
                            . 'members_activation_status mas, '
                            . 'members_online_status mos');
                  }
                  $this->db->where('me.mos_id = mos.mos_id');
		  $this->db->where('me.me_activation_status = mas.mas_id');
		  $this->db->where('me.me_type = mt.mt_code');
		  $this->db->where('me.me_id', $id);
                  if ($me_register_date != '') {
                      $this->db->where('DATE(me.me_register_date) = DATE(\'$me_register_date\')');
                  }
                  if ($ml_id != -1) {
                      $this->db->where('me.ml_id', $ml_id);
                  }
                  if ($me_type != '') {
                      $this->db->where('me.me_type', $me_type);
                  }
                  if ($isStaff != -1) {
                      $this->db->where("(me.me_type = 'GA')");
                  }
		  $this->db->group_by('me.me_id');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function getStaff($me_id) {
		  $this->db->select('*');
		  $this->db->from('members me, '
                          . 'members_type mt');
		  $this->db->where('me.me_type = mt.mt_code');
		  $this->db->where('me.me_id', $me_id);
		  $this->db->where('me.me_type', 'GA');
		  $this->db->group_by('me.me_id');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function getSL($sl_id) {
		  $this->db->select('*');
		  $this->db->from('members me, dinarpal_account da, '
                          . 'geneology_aff ga, bene_info_waris biw, '
                          . 'members_type mt, members_activation_status mas, '
                          . 'members_online_status mos ');
                  $this->db->where('me.mos_id = mos.mos_id');
		  $this->db->where('me.me_activation_status = mas.mas_id');
		  $this->db->where('me.me_id = da.me_id');
		  $this->db->where('me.me_id = ga.me_id');
		  $this->db->where('me.me_id = biw.me_id');
		  $this->db->where('me.me_type = mt.mt_code');
		  $this->db->where('me.sl_id', $sl_id);
		  $this->db->where('me.me_type', 'DP');
		  $this->db->group_by('me.me_id');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function getByName($username, $ml_id=-1, $me_type='') {
		  $this->db->select('*');
		  $this->db->from('members me, dinarpal_account da, '
                          . 'geneology_aff ga, bene_info_waris biw, '
                          . 'members_type mt, members_activation_status mas, '
                          . 'members_online_status mos ');
                  $this->db->where('me.mos_id = mos.mos_id');
		  $this->db->where('me.me_activation_status = mas.mas_id');
		  $this->db->where('me.me_id = da.me_id');
		  $this->db->where('me.me_id = ga.me_id');
		  $this->db->where('me.me_id = biw.me_id');
		  $this->db->where('me.me_type = mt.mt_code');
		  $this->db->where('me.me_username', $username);
                  if ($ml_id != -1) {
                      $this->db->where('me.ml_id', $ml_id);
                  }
                  if ($me_type != '') {
                      $this->db->where('me.me_type', $me_type);
                  }
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function getPoints($me_id=-1, $at_ids=array()) {
              /**
               * 
               * SELECT tr.tr_datetime, tr_amount, me.me_username, tt.tt_desc, tr.ts_id 
                    FROM `transaction` tr, members me, transaction_type tt 
                    WHERE (me.me_id = tr.me_id_to OR me.me_id = tr.me_id_from) 
                    AND tr.ts_id = 1 
                    AND tr.tt_id = tt.tt_id 
                    AND me.me_id = 6
               */
                  $this->db->select('*');
		  $this->db->from('transaction tr, members me, transaction_type tt ');
                  $str_atid = "tr.at_id = 1";
                  if (!empty($at_ids)) {
                      $str_atid = "(";
                      foreach ($at_ids as $at_id) {
                          $str_atid .= "tr.at_id = '" . $at_id . "' OR ";
                      }
                      $str_atid .= "1<>1)";
                  }
                  $this->db->where($str_atid);
                  $this->db->where('(me.me_id = tr.me_id_to OR me.me_id = tr.me_id_from) ');
		  $this->db->where('tr.ts_id = 1');
		  $this->db->where('tr.tt_id = tt.tt_id');
                  if ($me_id != -1) {
                      $this->db->where('me.me_id', $me_id);
                  }
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
          }
          
          function getAccountAdjustment($me_id=-1, $at_ids=array()) {
              /**
               * 
               * SELECT tr.tr_datetime, tr_amount, me.me_username, tt.tt_desc, tr.ts_id 
                    FROM `transaction` tr, members me, transaction_type tt 
                    WHERE (me.me_id = tr.me_id_to OR me.me_id = tr.me_id_from) 
                    AND tr.ts_id = 1 
                    AND tr.tt_id = tt.tt_id 
                    AND me.me_id = 6
               */
                  $this->db->select('*');
		  $this->db->from('transaction tr, members me, transaction_type tt ');
                  $this->db->where('(me.me_id = tr.me_id_to OR me.me_id = tr.me_id_from) ');
		  $str_atid = "tr.at_id = 1";
                  if (!empty($at_ids)) {
                      $str_atid = "(";
                      foreach ($at_ids as $at_id) {
                          $str_atid .= "tr.at_id = '" . $at_id . "' OR ";
                      }
                      $str_atid .= "1<>1)";
                  }
                  $this->db->where($str_atid);
		  $this->db->where('tr.ts_id = 1');
		  $this->db->where('tr.tt_id = 40');
		  $this->db->where('tr.tt_id = tt.tt_id');
                  if ($me_id != -1) {
                      $this->db->where('me.me_id', $me_id);
                  }
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
          }
          
          function getPointSelfTransfer($me_id=-1, $at_ids=array()) {
              /**
               * 
               * SELECT tr.tr_datetime, tr_amount, me.me_username, tt.tt_desc, tr.ts_id 
                    FROM `transaction` tr, members me, transaction_type tt 
                    WHERE (me.me_id = tr.me_id_to OR me.me_id = tr.me_id_from) 
                    AND tr.ts_id = 1 
                    AND tr.tt_id = tt.tt_id 
                    AND me.me_id = 6
               */
                  $this->db->select('*');
		  $this->db->from('transaction tr, members me, transaction_type tt ');
                  $this->db->where('(me.me_id = tr.me_id_to OR me.me_id = tr.me_id_from) ');
                  $str_atid = "tr.at_id = 1";
                  if (!empty($at_ids)) {
                      $str_atid = "(";
                      foreach ($at_ids as $at_id) {
                          $str_atid .= "tr.at_id = '" . $at_id . "' OR ";
                      }
                      $str_atid .= "1<>1)";
                  }
                  $this->db->where($str_atid);
		  $this->db->where('tr.ts_id = 1');
		  $this->db->where('(tr.tt_id = 47 OR tr.tt_id = 48 OR tr.tt_id = 49)');
		  $this->db->where('tr.tt_id = tt.tt_id');
                  if ($me_id != -1) {
                      $this->db->where('me.me_id', $me_id);
                  }
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
          }
          
          function getByUsername($username, $isStaff=-1) {
		  $this->db->select('*');
		  $this->db->from('members me');
		  $this->db->where('me.me_username', $username);
                  if ($isStaff != -1) {
                      $this->db->where('me.me_type', 'GA');
                  } else {
                      $this->db->where("(me.me_type = 'NU' OR me.me_type = 'DP')");
                  }
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function getAudit($stat=1, $me_id=-1, $at_ids=array()) {
		  if ($stat == 1) {
                        $this->db->select('COUNT(*) AS numAH');
                        $this->db->from('members me');
                        $this->db->where('(me.me_activation_status = 2 OR me.me_activation_status = 3)');
                        $this->db->where('me.me_type', 'NU');
                        $this->db->where('me.ml_id', '3');
                        $q = $this->db->get();
                        if($q->num_rows() > 0) {
                            foreach($q->result() as $r) {
                                    $d[] = $r;
                            }
                            return ((is_numeric($d[0]->numAH)) ? ($d[0]->numAH) : (0));
                        } else {
                            return 0;
                        }
                  } else if ($stat == 2) {
                        $this->db->select('SUM(da.da_gold_balance + da.da_silver_balance) AS balance');
                        $this->db->from('members me, dinarpal_account da');
                        $this->db->where('(me.me_activation_status = 2 OR me.me_activation_status = 3)');
                        $this->db->where('me.me_id = da.me_id');
                        $this->db->where('me.me_type', 'NU');
                        $this->db->where('me.ml_id', '3');
                        $q = $this->db->get();
                        if($q->num_rows() > 0) {
                            foreach($q->result() as $r) {
                                    $d[] = $r;
                            }
                            return ((is_numeric($d[0]->balance)) ? ($d[0]->balance) : (0));
                        } else {
                            return 0;
                        }
                  } else if ($stat == 3) {
                        $this->db->select('SUM(tr.tr_amount) AS tr_amount_total');
                        $this->db->from('transaction tr, members me, transaction_type tt ');
                        $str_atid = "tr.at_id = 1";
                        if (!empty($at_ids)) {
                            $str_atid = "(";
                            foreach ($at_ids as $at_id) {
                                $str_atid .= "tr.at_id = '" . $at_id . "' OR ";
                            }
                            $str_atid .= "1<>1)";
                        }
                        $this->db->where($str_atid);
                        $this->db->where('(me.me_id = tr.me_id_to OR me.me_id = tr.me_id_from) ');
                        $this->db->where('tr.ts_id = 1');
                        $this->db->where('(tr.tt_id <> 40 AND tr.tt_id <> 47 AND tr.tt_id <> 48 AND tr.tt_id <> 49)');
                        $this->db->where('tr.tt_id = tt.tt_id');
                        if ($me_id != -1) {
                            $this->db->where('me.me_id', $me_id);
                        }
                        $q = $this->db->get();
                        if($q->num_rows() > 0) {
                            foreach($q->result() as $r) {
                                  $d[] = $r;
                            }
                            return ((is_numeric($d[0]->tr_amount_total)) ? ($d[0]->tr_amount_total) : (0));
                        } else {
                            return 0;
                        }
                  } else {
                      return 0;
                  }
	  }
          
          function getByUsernameLike($search_user) {
		  $this->db->select('*');
		  $this->db->from('members me');
		  $this->db->where("(UPPER(me.me_username) LIKE '%" 
                              . strtoupper($search_user) 
                              . "%' OR UPPER(me.me_firstname) LIKE '%" 
                              . strtoupper($search_user) 
                              . "%' OR UPPER(me.me_lastname) LIKE '%" 
                              . strtoupper($search_user) 
                              . "%')");
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function getByMAS($mas_id) {
		  $this->db->select('*');
		  $this->db->from('members me');
		  $this->db->where('me.me_activation_status', $mas_id);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }

	  function getByIC($ic) {
		  $this->db->select('*');
		  $this->db->from('members me, dinarpal_account da, '
                          . 'geneology_aff ga, bene_info_waris biw, '
                          . 'members_type mt, members_activation_status mas, '
                          . 'members_online_status mos ');
                  $this->db->where('me.mos_id = mos.mos_id');
		  $this->db->where('me.me_activation_status = mas.mas_id');
		  $this->db->where('me.me_id = da.me_id');
		  $this->db->where('me.me_id = ga.me_id');
		  $this->db->where('me.me_id = biw.me_id');
		  $this->db->where('me.me_type = mt.mt_code');
		  $this->db->where('me.me_government_issue_id', $ic);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function getByEmail($email) {
		  $this->db->select('*');
		  $this->db->from('members me, dinarpal_account da, '
                          . 'geneology_aff ga, bene_info_waris biw, '
                          . 'members_type mt, members_activation_status mas, '
                          . 'members_online_status mos ');
                  $this->db->where('me.mos_id = mos.mos_id');
		  $this->db->where('me.me_activation_status = mas.mas_id');
		  $this->db->where('me.me_id = da.me_id');
		  $this->db->where('me.me_id = ga.me_id');
		  $this->db->where('me.me_id = biw.me_id');
		  $this->db->where('me.me_type = mt.mt_code');
		  $this->db->where('me.me_email', $email);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
          
          function getByEmailOrUsername($me_email, $me_username) {
		  $this->db->select('*');
		  $this->db->from('members me');
		  $this->db->where('me.me_email', $me_email);
		  $this->db->or_where('me.me_username', $me_username);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }

	  function searchByName($name) {
		  $this->db->select('*');
		  $this->db->from('members me, dinarpal_account da, '
                          . 'geneology_aff ga, bene_info_waris biw, '
                          . 'members_type mt, members_activation_status mas, '
                          . 'members_online_status mos ');
                  $this->db->where('me.mos_id = mos.mos_id');
		  $this->db->where('me.me_activation_status = mas.mas_id');
		  $this->db->where('me.me_id = da.me_id');
		  $this->db->where('me.me_id = ga.me_id');
		  $this->db->where('me.me_id = biw.me_id');
		  $this->db->where('me.me_type = mt.mt_code');
		  $this->db->like('me.me_firstname', $name);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function getUsername($me_id) {
		  $this->db->select('*');
		  $this->db->from('members me, dinarpal_account da, '
                          . 'geneology_aff ga, bene_info_waris biw, '
                          . 'members_type mt, members_activation_status mas, '
                          . 'members_online_status mos ');
                  $this->db->where('me.mos_id = mos.mos_id');
		  $this->db->where('me.me_activation_status = mas.mas_id');
		  $this->db->where('me.me_id = da.me_id');
		  $this->db->where('me.me_id = ga.me_id');
		  $this->db->where('me.me_id = biw.me_id');
		  $this->db->where('me.me_type = mt.mt_code');
		  $this->db->where('me.me_id', $me_id);
		  $this->db->group_by('me.me_id');
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d[0]->me_username;
		  } else {
			  return 'Dinarpal Administrator';
		  }
	  }
	  
	  function add($data) {
		  if($this->db->insert('members', $data)) {
			  return $this->db->insert_id();
		  } else {
			  return 0;
		  }
	  }
	  
	  function edit($id, $data) {
		  $this->db->where('me_id', $id);
		  return $this->db->update('members', $data);
	  }
          
          function editAll($data) {
		  return $this->db->update('members', $data);
	  }
	  
	  function delete($id) {
		  $this->db->where('me_id', $id);
		  return $this->db->delete('members');
	  }
          
      function deleteByEmail($me_email) {
		  $this->db->where('me_email', $me_email);
		  return $this->db->delete('members');
	  }

	  function overview(){

		$this->db->select('me.me_id as id , me.me_activation_status as verify , me_status as status');
		$this->db->from('members me');
		$this->db->where('me.ml_id', 3);
		$this->db->where('me.me_type', 'NU');
		$q = $this->db->get();
		if($q->num_rows() > 0) {
			foreach($q->result() as $r) {
			  $d[] = $r;
			}
		}
		else{
			return null;
		}
		
		$num = array(0,0,0,0,0,0);
		for ($i = 0; $i < sizeof($d) ; $i++) { 
			if ($d[$i]->status == 1) {
				$num[4] ++;
			}
			switch ($d[$i]->verify) {
				case '1': 
					$num[0] ++;
					break;
				case '2': 
					$num[1] ++;
					break;
				case '3': 
					$num[2] ++;
					break;
				case '4': 
					$num[3] ++;
					break;
				default:
					# code...
					break;
			}
		}

		$num[5] = sizeof($d);
		$num[5] -= $num[4];// not active

		return $num;
	  }

	  function overviewDetail($verify = -1 , $status = -1)
	  {
	  	$this->db->select('me.* , mvs.* , count(dd.dd_id) as Total');
		$this->db->from('members me, members_activation_status mas');
		$this->db->join('dinarpal_document dd', 'dd.me_id = me.me_id', 'left');
		$this->db->where('mas.mas_id = me.me_activation_status');
		$this->db->where('me.ml_id', 3);
//		$this->db->where('me.me_type', 'NU');
		$this->db->group_by('me.me_id');
		if ($verify != -1) {
			$this->db->where('me.me_activation_status', $verify);
		}
		if ($status != -1) {
			$this->db->where('me.me_status', $status);
		}
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $r) {
				$d[] = $r;
			}
			return $d;
		}else{
			return null;
		}		
	  }	  
  }

?>