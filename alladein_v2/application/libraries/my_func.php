<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_Func {
	
	public function __construct(){
		$this->obj = &get_instance();
	}
        
        public function getMilisecondsDatetime($datetime='') {
            if ($datetime == '') {
                $now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
                $mil = $now->format("Y-m-d H:i:s.u");
                return $mil;
            } else {
                $now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
                $mil = $now->format("Y-m-d H:i:s.u", $datetime);
                return $mil;
            }
        }
	
	public function getFace($menubar, $content) {
		$CI = $this->obj;
		$data['menu_content'] = $menubar;
		$data['main_content'] = $content;
		$CI->load->view('v_main',$data);
	}
	
	public function getAmil($am_id=null)
	{
		$CI = $this->obj;
		$am = $CI->m_amil->get($am_id);
		if(!empty($am))
		return $am[0]->am_name;
	}

	public function getPurityDesc($pu_id=null)
	{
		$CI = $this->obj;
		$pu = $CI->m_purity->get($pu_id);
		if(!empty($pu))
		return $pu[0]->pu_desc;
	}

	//function definition goes after here
	public function getTransactionStatus($ts_id) {
		$CI = $this->obj;
		$ts = $CI->m_transaction_status->get($ts_id);
		if ($ts) {
			return $ts[0]->ts_desc;
		} else {
			return '-';
		}
	}
        
        public function isAgentConsignment($v_weight=0.5, $it_id=1, $pu_id=1, $ivt_id=1) {
            // is agent consignment 0.5 gram gold
            if ($v_weight == 0.5 && $it_id == 1 && $pu_id == 1 && $ivt_id == 1) {
                return true;
            } else {
                return false;
            }
        }
	
	public function getMinimumBuyItemAgent() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        $dc_minimum_buy_item_agent = $dc[0]->dc_minimum_buy_item_agent;
                        $dc_minimum_buy_item_agent = (is_numeric($dc_minimum_buy_item_agent)) ? ($dc_minimum_buy_item_agent) : (0);
			return $dc_minimum_buy_item_agent;
		} else {
			return 0;
		}
	}
        
	public function getNumberGiveItemAgent() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        $dc_number_give_item_agent = $dc[0]->dc_number_give_item_agent;
                        $dc_number_give_item_agent = (is_numeric($dc_number_give_item_agent)) ? ($dc_number_give_item_agent) : (0);
			return $dc_number_give_item_agent;
		} else {
			return 0;
		}
	}
	
	public function getCurrency() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
			return $dc[0]->dc_currency_type;
		} else {
			return 'MYR';
		}
	}
        
        public function getLimitRows() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
                $rows_x = 100;
		if (isset($dc) && !empty($dc)) {
                        $rows = $dc[0]->dc_limit_rows;
                        $rows = (is_numeric($rows)) ? ($rows) : ($rows_x);
			return $rows;
		} else {
			return $rows_x;
		}
	}
        
        public function getCurrentPrice() {
		$CI = $this->obj;
		$itp_price = $CI->m_item_type_purity->getRate(1, 1);
                $gst_rate = (is_numeric($this->getGST())) ? ($this->getGST()) : (0);
		if (isset($itp_price) && !empty($itp_price) && is_numeric($itp_price)) {
                        $gst_tax = $gst_rate * $itp_price;
                        $itp_price_total = $itp_price + $gst_tax;
			return number_format($itp_price_total, 2);
		} else {
			return "0.00";
		}
	}
        
        public function getMarhunRate() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        $num = $dc[0]->dc_marhun_rate;
                        $num = (is_numeric($num)) ? ($num) : (0);
			return $num;
		} else {
			return 0.00;
		}
	}
        
        public function getBuybackRate() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        $num = $dc[0]->dc_buyback_rate;
                        $num = (is_numeric($num)) ? ($num) : (0);
			return $num;
		} else {
			return 0.00;
		}
	}
        
        public function getGST() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        $num = $dc[0]->dc_gst_rate;
                        $num = (is_numeric($num)) ? ($num) : (0);
			return $num;
		} else {
			return 0.06;
		}
	}
        
        public function getDpsRate() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        $num = $dc[0]->dc_dpsrate;
                        $num = (is_numeric($num)) ? ($num) : (0);
			return $num;
		} else {
			return 0.5;
		}
	}
        
        public function getLatestDatetimeLiveprice() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        $datetime = $dc[0]->dc_liveprice_datetime;
                        $datetime = $this->sql_time_to_datetime($datetime);
			return $datetime;
		} else {
			return date('Y-m-d H:i:s');
		}
	}
        
        public function getLivePrice($it_id=1) {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                    $num = 0;
                    if ($it_id == 1) {
                        $num = $dc[0]->dc_liveprice;
                    } else if ($it_id == 2) {
                        $num = $dc[0]->dc_liveprice_silver;
                    }
                    $num = (is_numeric($num)) ? ($num) : (0);
                    return $num;
		} else {
                    return 100.00;
		}
	}
        
        public function getMintingMaximum() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
			$num = $dc[0]->dc_minting_maximum;
                        $num = (is_numeric($num)) ? ($num) : (0);
			return $num;
		} else {
			return 100.00;
		}
	}
        
        public function getMinimumTrans() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        $num = $dc[0]->dc_minimum_trans;
                        $num = (is_numeric($num)) ? ($num) : (0);
			return $num;
		} else {
			return 1.00;
		}
	}
        
        public function getAdminBankAccount() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
			return $dc[0]->dc_admin_bank_account;
		} else {
			return "04042010006119";
		}
	}
        
        public function getAdminBankName() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
			return $dc[0]->dc_admin_bank_name;
		} else {
			return "Koperasi DinarPal Melaka Berhad";
		}
	}
        
        public function getMaintenance() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        if ($dc[0]->dc_maintenance == 1) {
                            return true;
                        } else {
                            return false;
                        }
		} else {
			return false;
		}
	}
        
        public function getCommissionGramRate($it_id=1, $weight=0) {
		$CI = $this->obj;
                $agentCommRate = $this->getAgentCommRate();
                $agentCommRate = (is_numeric($agentCommRate)) ? ($this->getDisplayNumber($agentCommRate, 6)) : (0.000000);
                $weight = (is_numeric($weight)) ? ($this->getDisplayNumber($weight, 4)) : (0.0000);
                $commissionGram = $agentCommRate * $weight;
                $priceDPGpergram = $CI->m_item_type_purity->getPriceDpgDps(1, 1);
                $priceDPSpergram = $CI->m_item_type_purity->getPriceDpgDps(2, 1);
                $minGram = 0.1;
                $minMyr = 0.01;
                $commMyr = 0.00;
                if ($it_id == 1) {
                    if ($commissionGram < $minGram) {
                        $commMyr = 0.5 * $priceDPSpergram;
                    } else {
                        $commissionGram = $this->getDisplayNumber($commissionGram, 1);
                        $commMyr = $commissionGram * $priceDPGpergram;
                    }
                } else if ($it_id == 2) {
                    if ($commissionGram < $minGram) {
                        $commMyr = $commissionGram * $priceDPSpergram;
                        $commMyr = ($commMyr < $minMyr) ? (0.01) : ($commMyr);
                        $commMyr = $this->getDisplayNumber($commMyr, 2);
                    } else {
                        $commissionGram = $this->getDisplayNumber($commissionGram, 1);
                        $commMyr = $commissionGram * $priceDPSpergram;
                    }
                }
                return $commMyr;
                
//		$it = $CI->m_item_type->get($it_id);
//		if (isset($it) && !empty($it)) {
//			$rate_gram = $it[0]->it_comm_rate_gram;
//                        $rate_money = $it[0]->it_comm_rate_money;
//                        $pay_rate = ($rate_money * 1.0 / $rate_gram) * $weight;
//                        $pay_rate = 0.00;
//                        return $pay_rate;
//		} else {
//			return 0.00;
//		}
	}
        
        public function getAgentCommRate() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
                        $num = $dc[0]->dc_agent_comm_rate;
                        $num = (is_numeric($num)) ? ($num) : (0);
			return $num;
		} else {
			return 0.015000;
		}
	}
        
        public function getVerificationRate() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
			return $dc[0]->dc_verification_rate;
		} else {
			return 10.00;
		}
	}
        
        public function getGeneologyRate() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
		if (isset($dc) && !empty($dc)) {
			return $dc[0]->dc_geneology_rate;
		} else {
			return 0.10;
		}
	}
        
        public function getMeAdminHQ() {
		$CI = $this->obj;
		$dc = $CI->m_dinarpal_config->getAll();
                $me_username_hq = (isset($dc) && !empty($dc)) ? ($dc[0]->dc_hq_username) : ("dphq");
                $me_hq = $CI->m_members->getByName($me_username_hq);
                $me_id_hq = (isset($me_hq) && !empty($me_hq)) ? ($me_hq[0]->me_id) : (0);
                return $me_id_hq;
	}
	
	public function trim_array($arr) {
		$newArr = array();
		foreach ($arr as $key => $ar) {
			if (empty($ar) || NULL == $ar || '' == $ar) {
				$newArr[$key] = '-';
			} else {
				$newArr[$key] = strtoupper($ar);
			}
		}
		return $newArr;
	}
	
	public function pemecahArRahnu($code, $stat) {
		if ($stat == 'PP') {
			$codes = $code[2].$code[3].$code[4];
			return number_format($codes);
		}
		return 0;
	}
	
	public function getMe($me_id, $me_to, $me_from) {
		if ($me_id == $me_to) {
			return $me_from;
		} else if ($me_id == $me_from) {
			return $me_to;
		} else {
			return 0;
		}
	}
        
        public function isInputValidation_array($arr=array(), $field=array()) {
            $bol = true;
            $output = array();
            foreach ($arr as $akey => $aval) {
                $bol_check = false;
                if (!empty($field)) {
                    foreach ($field as $bkey => $bval) {
                        if ($akey == $bkey) {
                            $bol_check = true;
                            break;
                        }
                    }
                } else {
                    $bol_check = true;
                }
                if ($bol_check) {
                    $bol = $this->isInputValidation($aval);
                    if ($bol == false) {
                        $field_name = explode("_", $akey);
                        $output[] = "Field " . $field_name[1] . " is blank!";
                    }
                }
            }
            return $output;
        }
        
        public function isInputValidation($input="") {
            $bol = true;
            if ("-" == $input || "" == $input) {
                $bol = false;
            }
            return $bol;
        }
	
	public function paymentToFrom($me_id, $me_to, $me_from) {
		if ($me_to == 0 || $me_from == 0) {
                        if ($me_to == 0) {
                            return 'To';
                        } else {
                            return 'From';
                        }
                }
                if ($me_id == $me_to && $me_id == $me_from && $me_to == $me_from) {
                        return 'Self';
		} else if ($me_id == $me_to) {
			return 'From';
		} else if ($me_id == $me_from) {
			return 'To';
                } else {
			return '-';
		}
	}

	public function getItemTypeName($id){
		$CI = $this->obj;
		$CI->db->select('it_name');
		$CI->db->from('item_type it');
		$CI->db->where('it.it_id', $id);
		$q = $CI->db->get();
		if($q->num_rows() > 0) {
			foreach($q->result() as $r) {
				return $r->it_name;
			}

		}
	}


	public function getItemTypeChildName($id){
		$CI = $this->obj;
		$CI->db->select('itc_name');
		$CI->db->from('item_type_child itc');
		$CI->db->where('itc.itc_id', $id);
		$q = $CI->db->get();
		if($q->num_rows() > 0) {
			foreach($q->result() as $r) {
				return $r->itc_name;
			}

		}
	}
        
        public function getAtId($itc_id) {
                $CI = $this->obj;
                $itc = $this->m_item_type_child->get($itc_id);
                if (isset($itc) && !empty($itc)) {
                    return $itc[0]->it_id;
                } else {
                    return 0;
                }
        }

	public function getItemItctName($id){
		$CI = $this->obj;
		$CI->db->select('itct_name');
		$CI->db->from('itc_type itct');
		$CI->db->where('itct.itct_id', $id);
		$q = $CI->db->get();
		if($q->num_rows() > 0) {
			foreach($q->result() as $r) {
				return $r->itct_name;
			}

		}
	}

	public function getAccountTypeName($at_id)
	{
		$CI = $this->obj;
		$CI->db->select('at_desc');
		$CI->db->from('account_type at');
		$CI->db->where('at.at_id', $at_id);
		$q = $CI->db->get();
		if($q->num_rows() > 0) {
			foreach($q->result() as $r) {
				return $r->at_desc;
			}

		}
	}
	
	
	public function isValidPassword($pwd) {
		$error = '';
		if( strlen($pwd) < 8 ) {
			$error .= "Password too short!<br />";
		}
		if( strlen($pwd) > 20 ) {
			$error .= "Password too long!<br />";
		}
		
		if( !preg_match("#[0-9]+#", $pwd) ) {
			$error .= "Password must include at least one number!<br />";
		}
		if( !preg_match("#[a-z]+#", $pwd) ) {
			$error .= "Password must include at least one letter!<br />";
		}
		if( !preg_match("#[A-Z]+#", $pwd) ) {
			$error .= "Password must include at least one CAPS!<br />";
		}
		if( !preg_match("#\W+#", $pwd) ) {
			$error .= "Password must include at least one symbol!<br />";
		}
		
		if(isset($error) && $error != ''){
			return "Password validation failure ( your choise is weak ) <br /><br />$error";
		} else {
			return "Your password is strong.";
		}
	}
	
	public function format_digit($num) {
		if ($num < 10) {
			return "0000".$num;
		} else if ($num < 100) {
			return "000".$num;
		} else if ($num < 1000) {
			return "00".$num;
		} else if ($num < 10000) {
			return "0".$num;
		} else {
			return $num;
		}
	}
        
        public function format_digit_all($num, $size_digit=11) {
            $size_num = strlen($num);
            $zero = "";
            $diff_size = $size_digit - $size_num;
            for ($is = 0; $is < $diff_size; $is++) {
                $zero .= "0";
            }
            $new_num = $zero . $num;
            return $new_num;
	}
	
	public function format_digit_puluh($num) {
		if ($num < 10) {
			return "0".$num;
		} else {
			return $num;
		}
	}

	public function getGrandTotalWeight($itct_id,$q)
	{
		$CI = $this->obj;
		$CI->db->select('itct.itct_weight');
		$CI->db->from('itc_type itct');
		$CI->db->where('itct.itct_id', $itct_id);
		$qz = $CI->db->get();
		
		$weight=0;
		if($qz->num_rows() > 0) {

			foreach($qz->result() as $r) {
				$weight= $r->itct_weight;
			}
			
			return $weight*$q;
		}
	}
        
        public function getTimer($time) {
//            $minute = $time / 60;
//            $hour = $minute / 60;
//            $str_time = date('Y-m-d H:i:s', strtotime('+6 hour'));
//            $str_time = $time;
//            return $str_time;
//            list($months, $days, $hours, $minutes, $seconds) = explode(" ",date("n j H i s",$time));
//            $months--;$days--;
            $seconds1 = $time / 60;
            $seconds = $time % 60;
            $minutes1 = $seconds1 / 60;
            $minutes = $seconds1 % 60;
            $hours1 = $minutes1 / 24;
            $hours = $minutes1 % 24;
            $days1 = $hours1 / 30;
            $days = $hours1 % 30;
            $months1 = $days1 / 12;
            $months = $days1 % 12;
            $str_time = $seconds . " seconds ago";
            if ($minutes > 0) {
                $str_time = $minutes . " minutes, " . $str_time;
            }
            if ($hours > 0) {
                $str_time = $hours . " hours, " . $str_time;
            }
            if ($days > 0) {
                $str_time = $days . " days, " . $str_time;
            }
            if ($months > 0) {
                $str_time = $months . " months, " . $str_time;
            }
//            $str_time = "$months months - $days days - $hours hours - $minutes minutes - $seconds seconds left";
            return $str_time;
        }
        
        public function getTimer2($time) {
//            $minute = $time / 60;
//            $hour = $minute / 60;
//            $str_time = date('Y-m-d H:i:s', strtotime('+6 hour'));
//            $str_time = $time;
//            return $str_time;
//            list($months, $days, $hours, $minutes, $seconds) = explode(" ",date("n j H i s",$time));
//            $months--;$days--;
            $seconds1 = $time / 60;
            $seconds = $time % 60;
            $minutes1 = $seconds1 / 60;
            $minutes = $seconds1 % 60;
            $hours1 = $minutes1 / 24;
            $hours = $minutes1 % 24;
            $days1 = $hours1 / 30;
            $days = $hours1 % 30;
            $months1 = $days1 / 12;
            $months = $days1 % 12;
            $str_time = $seconds . " seconds";
            if ($minutes > 0) {
                $str_time = $minutes . " minutes, " . $str_time;
            }
            if ($hours > 0) {
                $str_time = $hours . " hours, " . $str_time;
            }
            if ($days > 0) {
                $str_time = $days . " days, " . $str_time;
            }
            if ($months > 0) {
                $str_time = $months . " months, " . $str_time;
            }
//            $str_time = "$months months - $days days - $hours hours - $minutes minutes - $seconds seconds left";
            return $str_time;
        }
        
        public function getTimer3($time) {
//            $minute = $time / 60;
//            $hour = $minute / 60;
//            $str_time = date('Y-m-d H:i:s', strtotime('+6 hour'));
//            $str_time = $time;
//            return $str_time;
//            list($months, $days, $hours, $minutes, $seconds) = explode(" ",date("n j H i s",$time));
//            $months--;$days--;
            $seconds1 = $time / 60;
            $seconds = $time % 60;
            $minutes1 = $seconds1 / 60;
            $minutes = $seconds1 % 60;
            $hours1 = $minutes1 / 24;
            $hours = $minutes1 % 24;
            $days1 = $hours1 / 30;
            $days = $hours1 % 30;
            $months1 = $days1 / 12;
            $months = $days1 % 12;
            $str_time = $seconds . "s";
            if ($minutes > 0) {
                $str_time = $minutes . "m, " . $str_time;
            }
            if ($hours > 0) {
                $str_time = $hours . "h, " . $str_time;
            }
            if ($days > 0) {
                $str_time = $days . "d, " . $str_time;
            }
            if ($months > 0) {
                $str_time = $months . "M, " . $str_time;
            }
//            $str_time = "$months months - $days days - $hours hours - $minutes minutes - $seconds seconds left";
            return $str_time;
        }
        
	public function date_to_sql_time($date, $time) {
		$tarikh = explode('/', $date);
		return $tarikh[2] . '-' . $tarikh[1] . '-' . $tarikh[0] . ' ' . date('H:i:s');
	}
	
	public function sql_time_to_date($date) {
		$tarikh1 = explode(' ', $date);
		$tarikh2 = explode('-', $tarikh1[0]);
		return $tarikh2[2] . '/' . $tarikh2[1] . '/' . $tarikh2[0];
	}
	
	public function sql_time_to_datetime($date) {
		$tarikh1 = explode(' ', $date);
		$tarikh2 = explode('-', $tarikh1[0]);
                if (isset($tarikh2[2])) {
                    if ($tarikh2[2] != '00') {
                        return $tarikh2[2] . '/' . $tarikh2[1] . '/' . $tarikh2[0] . ' ' . $tarikh1[1];
                    } else {
                        return "";
                    }
                } else {
                    return "";
                }
	}
        
        public function get_next_day($year=0, $month=0, $day=0) {
            $year = (is_numeric($year)) ? ($year) : (0);
            $month = (is_numeric($month)) ? ($month) : (0);
            $day = (is_numeric($day)) ? ($day) : (0);
            $nexttime = date('Y-m-d H:i:s', strtotime('+'.$year.' year, +'.$month.' month, +'.$day.' day'));
            return $nexttime;
        }
	
	public function trim_username($me_firstname) {
		return strtolower(str_replace(" ", "", $me_firstname));
	}
	
	public function do_upload($name='', $upload_path='./assets/uploads/profile/', 
                $allowed_types='gif|jpg|jpeg|png|pdf|txt|text|doc|docx|word|xls|xlsx')
	{
		$CI = $this->obj;
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $allowed_types;
		$config['max_size']	= '1000000';
//		$config['max_width']  = '1500';
//		$config['max_height']  = '2000';
                $config['encrypt_name'] = TRUE;

		$CI->load->library('upload');
		$CI->upload->initialize($config);

		$data = '';

		if ( ! $CI->upload->do_upload($name))
		{
			$data = array('error' => $CI->upload->display_errors());

			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $CI->upload->data());
                        
                        $conf['image_library'] = 'gd2';
                        $conf['source_image'] = $upload_path . $data['upload_data']['file_name'];
                        $conf['create_thumb'] = TRUE;
                        $conf['maintain_ratio'] = TRUE;
                        $conf['width'] = 100;
                        $conf['height'] = 75;
                        $CI->load->library('image_lib', $conf);
                        $CI->image_lib->resize();

                        //$this->load->view('upload_success', $data);
		}
		
		return $data;
	}
	
	public function dinarpal_encrypt($text) {
		$CI = $this->obj;
		//$data = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $CI->config->item('encryption_key'), $text, MCRYPT_MODE_ECB, '1');
        //return base64_encode($data);
		$val1 = $CI->encrypt->encode($text);
		$val2 = '';
		for ($i=0; $i<strlen($val1); $i++) {
			if ($val1[$i] == '/') {
				$val2 .= '_';
			} else if ($val1[$i] == '+') {
				$val2 .= '-';
			} else {
				$val2 .= $val1[$i];
			}
		}
		return $val2;
	}
	
	public function dinarpal_decrypt($text) {
		$CI = $this->obj;
		//$text = base64_decode($text);
        //return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $CI->config->item('encryption_key'), $text, MCRYPT_MODE_ECB, '1');
		$val1 = '';
		for ($i=0; $i<strlen($text); $i++) {
			if ($text[$i] == '_') {
				$val1 .= '/';
			} else if ($text[$i] == '-') {
				$val1 .= '+';
			} else {
				$val1 .= $text[$i];
			}
		}
		$val2 = $CI->encrypt->decode($val1);
		return $val2;
	}
        
        public function getUploadPath($path='items') {
            return base_url()."assets/uploads/".$path."/";
        }
        
        public function getRandomVal($type='alnum', $length=16) {
            return random_string($type, $length);
        }
        
        public function getCaptchaIndex() {
            $CI = $this->obj;
            $index = random_string('numeric');
            $index = $index % 16;
            return $index;
        }
        
        public function isCaptcha($index, $str) {
            $cArr = array(
                "ZKW4",                
                "BMVHKY",                
                "944531",                
                "7d6bf",                
                "RAE3",                
                "3-2 parks",                
                "advses",                
                "3nc9z",                
                "quxg4h",                
                "2CCEX",                
                "2PVCb",                
                "slythygomi",                
                "trustother",                
                "apricot",                
                "pmymku"                
            );
            return (strcmp(strtoupper($cArr[$index-1]), strtoupper($str)) == 0);
        }
        
        public function getMeAdmin($sl_id) {
            $CI = $this->obj;
            $me_admin = $CI->m_members->getSL($sl_id);
            $me_id_admin = (isset($me_admin) && !empty($me_admin)) ? ($me_admin[0]->me_id) : (0);
            return $me_id_admin;
        }
        
        public function getSlAdmin($me_id_admin) {
            $CI = $this->obj;
            $me_admin = $CI->m_members->get($me_id_admin);
            $sl_id_admin = (isset($me_admin) && !empty($me_admin)) ? ($me_admin[0]->sl_id) : (0);
            return $sl_id_admin;
        }
        
        public function url_https($url) {
            return str_replace('http://', 'https://', $url);
        }
        
        public function getNoImage($type=-1) {
//            return "NoImageAvailable.png";
            return "No_image_available.png";
        }
        
        public function QRCode($str) {
            include('QRGenerator.php');
            $ayat = (isset($str) && !empty($str)) ? ($str) : ("-");
            $qrcode = new QRGenerator($ayat, 100);  // 100 is the qr size
            $code = $qrcode->generate();
            print "<a href='" . $code . "' target='_blank'><img src='". $code ."'></a>";
        }
        
        public function getQRCode($str) {
            include('QRGenerator.php');
            $ayat = (isset($str) && !empty($str)) ? ($str) : ("-");
            $qrcode = new QRGenerator($ayat, 100);  // 100 is the qr size
            $code = $qrcode->generate();
            return $code;
        }
        
        public function QRCode2($str) {
            include('QRGenerator.php');
            $ayat = (isset($str) && !empty($str)) ? ($str) : ("-");
            $qrcode = new QRGenerator($ayat, 100);  // 100 is the qr size
            $code = $qrcode->generate();
            return "<span style='color: #FAD1A6;'><img width='150' height='150' src='". $code ."'></span>";
        }
        
        public function get_config_email() {
            /*
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'webmail.dinarpal.com',
                'smtp_port' => 25,
                'smtp_user' => 'support@dinarpal.com',
                'smtp_pass' => '#@!321Cba',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );
            //*/
            /*
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'umar@tuffah.info',
                'smtp_pass' => 'kalimas123',
                'mailtype'  => 'html', 
                'charset'   => 'UTF-8'
            );
            //*/
            //*
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'dinarpal13@gmail.com',
                'smtp_pass' => 'Abcd1234!@#$',
                'mailtype'  => 'html', 
                'charset'   => 'UTF-8'
            );
            //*/
            /*
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'umaqgeek@gmail.com',
                'smtp_pass' => '#@!321Cba',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );
            //*/
            return $config;
        }
        
        //send email activation
        function send_email($to, $subject, $msg) {
            
            $to = $to . ", dinarpal13@gmail.com";
            
//            print_r($to); die();
            
            $this->CI = & get_instance();

            $config = $this->get_config_email();
            
            $this->CI->load->library('email', $config);
            $this->CI->email->set_newline("\r\n");
            $this->CI->email->from('support@dinarpal.com', 'DinarPal');
            $this->CI->email->to($to);

            $this->CI->email->subject($subject);

            $message = $msg;
            $this->CI->email->message($message);

            // Set to, from, message, etc

            if (ENVIRONMENT != 'development') {
                if (!$this->CI->email->send()) {
    //                print_r($this->CI->email->print_debugger());
                    return false;
                } else {
                    return true;
                }
            }
            return true;
        }
        
        function send_email_allAdmins($subject, $msg, $tr_datetime) {
            $CI = $this->obj;
            $all_admins = $CI->m_members->getAll_Staff(2);
            if (isset($all_admins) && !empty($all_admins)) {
                foreach ($all_admins as $aa) {
                    $me_id = $aa->me_id;
//                    if ($me_id == 5) {
                        // send email
                        $to = $aa->me_email;
                        $msg1 = "[" . $this->sql_time_to_datetime($tr_datetime) . "] " . $msg;
                        $this->send_email($to, $subject, $msg1);
//                    }
                }
            }
        }
        
        function getRounded($amount) {
//            echo $amount . "<br />";
            $t1 = $amount * 100.0000;
//            echo $t1 . "<br />";
            $t2 = ceil($t1);
//            echo $t2 . "<br />";
            $t3 = $t2 * 1.0 / 10.0000;
//            echo $t3 . "<br />";
            $t4 = floor($t3);
//            echo $t4 . "<br />";
            $t5 = $t4 * 1.0 / 10.0000;
//            echo $t5 . "<br />";
            return $t5;
        }
        
        function getRoundDown($amount, $precision=1) {
//            echo $amount . "<br />";
            $t1 = $amount * (pow(10.0000, $precision));
//            echo $t1 . "<br />";
            $t2 = floor($t1);
//            echo $t2 . "<br />";
            $t3 = $t2 * 1.0 / (pow(10.0000, $precision));
//            echo $t3 . "<br />";
            return $t3;
        }
        
        function getFormulaPts($me_id) {
            $CI = $this->obj;
            $points = $CI->m_members->getPoints($me_id);
            $points_deduct = $CI->m_members->getAccountAdjustment($me_id);
            $points_deduct2 = $CI->m_members->getPointSelfTransfer($me_id);
            $pts = 0.00;
            $pts_deduct = 0.00;
            $pts_deduct2 = 0.00;
            if (isset($points) && !empty($points)) {
                foreach ($points as $pt) {
                    $pts += $pt->tr_amount;
                }
            }
            if (isset($points_deduct) && !empty($points_deduct)) {
                foreach ($points_deduct as $pt_d) {
                    $pts_deduct += $pt_d->tr_amount;
                }
            }
            if (isset($points_deduct2) && !empty($points_deduct2)) {
                foreach ($points_deduct2 as $pt_d2) {
                    $pts_deduct2 += $pt_d2->tr_amount;
                }
            }
            $pts -= $pts_deduct;
            $pts -= $pts_deduct2;
            
            // gain 100 points per 1 downline
            $geneology_aff = $CI->m_geneology_aff->getAll($me_id);
            $num_downline = sizeof($geneology_aff);
            $pts_downline = $num_downline * 100;
            $pts += $pts_downline;
            
            return $pts;
        }
        
        function getFormulaRank($i) {
//            $formula = 500 * pow(10, $i-1);
            if ($i == 1) {
                $formula = 100;
            } else if ($i >= 2 && $i <= 18) {
                $formula = 90 * pow(10, $i-1);
            } else {
                $formula = 1000 * pow(10, $i-1);
            }
            return $formula;
        }
        
        function getFormulaX($pts) {
            $X = 0;
            $B = 0;
            $A = 0;
            if ($pts > 0) {
                for ($i = 1; $i <= $this->getMaximumRank(); $i++) {
                    $X = $this->getFormulaRank($i);
                    $B += $X;
                    $A = $B - $X;
                    if ($pts > $A && $pts <= $B) {
                        break;
                    }
                }
            } else {
                $X = $this->getFormulaRank(1);
            }
            return $X;
        }
        
        function getFormulaB($pts) {
            $X = 0;
            $B = 0;
            $A = 0;
            if ($pts > 0) {
                for ($i = 1; $i <= $this->getMaximumRank(); $i++) {
                    $X = $this->getFormulaRank($i);
                    $B += $X;
                    $A = $B - $X;
                    if ($pts > $A && $pts <= $B) {
                        break;
                    }
                }
            } else {
                $X = $this->getFormulaRank(1);
                $B += $X;
            }
            return $B;
        }
        
        function getFormulaA($pts) {
            $X = 0;
            $B = 0;
            $A = 0;
            if ($pts > 0) {
                for ($i = 1; $i <= $this->getMaximumRank(); $i++) {
                    $X = $this->getFormulaRank($i);
                    $B += $X;
                    $A = $B - $X;
                    if ($pts > $A && $pts <= $B) {
                        break;
                    }
                }
            } else {
                $X = $this->getFormulaRank(1);
                $B += $X;
                $A = $B - $X;
            }
            return $A;
        }
        
        function getMaximumRank() {
            return 18;
        }
        
        function getMembersRank($me_id) {
            $CI = $this->obj;
            $pts = $this->getFormulaPts($me_id);
            $lvl = $this->getLevel($pts);
            $ranks = $CI->m_ranks->get($lvl);
            if ($me_id == 7) { //arash
                $ranks = $CI->m_ranks->get(19);
            } else if ($me_id == 6) { //umaq
                $ranks = $CI->m_ranks->get(20);
            }
//            echo $me_id.' '.$lvl.' '.$ranks;
            return $ranks;
        }
        
        function getLevel($pts) {
            $X = 0;
            $B = 0;
            $A = 0;
            $lvl = 1;
            if ($pts > 0) {
                for ($i = 1; $i <= $this->getMaximumRank(); $i++) {
                    $X = $this->getFormulaRank($i);
                    $B += $X;
                    $A = $B - $X;
                    if ($pts > $A && $pts <= $B) {
                        $lvl = $i;
                        break;
                    }
                }
            } else {
                $X = $this->getFormulaRank(1);
                $B += $X;
                $A = $B - $X;
                $lvl = 1;
            }
            return $lvl;
        }
        
        function getSalutationGender($me_id) {
            $CI = $this->obj;
            $me = $CI->m_members->get($me_id);
            $g_id = (isset($me) && !empty($me)) ? ($me[0]->g_id) : (1);
            if ($g_id == 1) {
                return "his";
            } else if ($g_id == 2) {
                return "her";
            } else {
                return "its";
            }
        }
        
        function getSalutationGender2($me_id) {
            $CI = $this->obj;
            $me = $CI->m_members->get($me_id);
            $g_id = (isset($me) && !empty($me)) ? ($me[0]->g_id) : (1);
            if ($g_id == 1) {
                return "he";
            } else if ($g_id == 2) {
                return "she";
            } else {
                return "it";
            }
        }
        
        function getMonthInYear() {
            $months = array(
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            );
            return $months;
        }
        
        function changeDate($sqlDate='1970-01-01 01:01:01', 
                $isYear=true, $isMonth=true, $isDate=true, 
                $isHour=false, $isMinute=false, $isSecond=false) {
            $str = "";
            $months = $this->getMonthInYear();
            $tarikh = explode(' ', $sqlDate);
            if (isset($tarikh[0]) && !empty($tarikh[0])) {
                $hari = explode('-', $tarikh[0]);
                if ($isDate) {
                    $day = date('d');
                    if (isset($hari[2]) && !empty($hari[2])) {
                        $day = $hari[2];
                    }
                    $str .= $day . ' ';
                }
                if ($isMonth) {
                    $month = date('m');
                    if (isset($hari[1]) && !empty($hari[1])) {
                        $month = $hari[1];
                    }
                    $strMonth = $months[$month-1];
                    $str .= $strMonth;
                }
                if ($isYear) {
                    $year = date('Y');
                    if (isset($hari[0]) && !empty($hari[0])) {
                        $year = $hari[0];
                    }
                    $str .= ' ' . $year;
                }
            }
            return $str;
        }
        
        function getDisplayNumber($num, $points=2) {
            $a = (is_numeric($num)) ? ($num) : (0);
            $a = number_format($a, $points);
            $a = str_replace(',', '', $a);
            return $a;
        }
        
        function getScaleNumber($num) {
            if ($num >= 100000) {
                $x = round($num);
                $x_number_format = number_format($x);
                $x_array = explode(',', $x_number_format);
                $x_parts = array('k', 'm', 'b', 't', 'q', 'qt');
                $x_count_parts = count($x_array) - 1;
                $x_display = $x;
//                $x_display = $x_count_parts;
                $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
                $x_display = number_format($x_display);
                $x_display .= $x_parts[$x_count_parts - 1];
            } else {
                $x_display = number_format($num);
            }
            return $x_display;
        }
        
        function getItemLife($start_date, $end_date) {
            $todaysDate = date('Y-m-d H:i:s');
            $t_a = strtotime($start_date);
            $t_x = strtotime($todaysDate);
            $t_b = strtotime($end_date);
            if (isset($t_a) && !empty($t_a) && isset($t_b) && !empty($t_b)) {
                $b_a = $t_b - $t_a;
                $b_b = $t_b - $t_x;
                $p_a = ($b_b * 1.0 / $b_a) * 100;
                return $p_a;
            } else {
                return 0;
            }
        }
        
        function getItemLifeSpan($v_id) {
            $CI = $this->obj;
            $kc = $CI->m_keep_child->getVault($v_id);
            $k_startdate = "";
            $k_enddate = "";
            if (isset($kc) && !empty($kc)) {
                if (isset($kc[0]->k_startdate) && !empty($kc[0]->k_startdate)) {
                    $k_startdate = $kc[0]->k_startdate;
                }
                if (isset($kc[0]->k_enddate) && !empty($kc[0]->k_enddate)) {
                    $k_enddate = $kc[0]->k_enddate;
                }
            }
            $itemLife = $this->getItemLife($k_startdate, $k_enddate);
            $str = $this->getLifeSpan($itemLife);
            return $str;
        }
        
        function getPawnLifeSpan($v_id) {
            $CI = $this->obj;
            $pcc = $CI->m_pawn_child_child->getVault($v_id);
            $pcc_startdate = "";
            $pcc_enddate = "";
            if (isset($pcc) && !empty($pcc)) {
                if (isset($pcc[0]->pcc_start_date) && !empty($pcc[0]->pcc_start_date)) {
                    $pcc_startdate = $pcc[0]->pcc_start_date;
                }
                if (isset($pcc[0]->pcc_end_date) && !empty($pcc[0]->pcc_end_date)) {
                    $pcc_enddate = $pcc[0]->pcc_end_date;
                }
            }
            $itemLife = $this->getItemLife($pcc_startdate, $pcc_enddate);
            $str = $this->getLifeSpan($itemLife);
            return $str;
        }
        
        function getLifeSpan($num) {
            $color = "none";
            if ($num <= 20) {
                $color = "#a00";
            } else if ($num > 20 && $num <= 50) {
                $color = "#ea0";
            } else if ($num > 50 && $num <= 80) {
                $color = "none";
            } else {
                $color = "#0a0";
            }
            $str = "<div class=\"progress\" style=\"background-color: rgba(0,0,0,0.1);\">
                    <div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"" . number_format($num, 2) . "\"
                        aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"background-color: " . $color . "; width:" . number_format($num, 2) . "%\">
                        " . number_format($num, 2) . "% time left
                    </div>
                </div>";
            return $str;
        }
        
        function getAllItemLifeSpan($me_id) {
            $CI = $this->obj;
            $vault = $CI->m_vault->getAll_personalDetail(3, $me_id);
            $avg = 0.00;
//            $num_item = sizeof($vault);
            $num_item = 0;
            if (isset($vault) && !empty($vault)) {
                foreach ($vault as $v) {
                    $ivmt_id = $v->ivmt_id;
                    if ($ivmt_id != 2) {
                        $num_item += 1;
                        $kc = $CI->m_keep_child->getVault($v->v_id);
                        $k_startdate = "";
                        $k_enddate = "";
                        if (isset($kc) && !empty($kc)) {
                            if (isset($kc[0]->k_startdate) && !empty($kc[0]->k_startdate)) {
                                $k_startdate = $kc[0]->k_startdate;
                            }
                            if (isset($kc[0]->k_enddate) && !empty($kc[0]->k_enddate)) {
                                $k_enddate = $kc[0]->k_enddate;
                            }
                        }
                        $itemLife = $this->getItemLife($k_startdate, $k_enddate);
                        $avg += $itemLife;
                    }
                }
                if ($num_item > 0) {
                    $avg /= $num_item;
                } else {
                    $avg = 0;
                }
            }
            return $this->getLifeSpan($avg);
        }
        
        function getItemConsignmentIcon($v_id, $stat_notice=1) {
            $CI = $this->obj;
            $vault = $CI->m_vault->get($v_id);
            if (isset($vault) && !empty($vault)) {
                $vat_id = $vault[0]->vat_id;
                $notice = "This item is the ";
                $vat = $CI->m_vault_agent_type->get($vat_id);
                $vat_str = (isset($vat) && !empty($vat)) ? (strtolower($vat[0]->vat_desc)) : (" unknown item ");
                $notice .= $vat_str . ". Cannot be sold until it had been purchased.";
                if ($vat_id != 0) {
                    return "<span class='top-tooltip bottom-tooltip' data-tooltip='".$notice."' style='cursor: pointer;'>"
                            . "<img width='25' height='25' src='".base_url()."assets/images/agent_star.png' />"
//                            . "<span class='fa fa-codepen'></span>"
                            . "</span>";
                } else {
                    return "";
                }
            } else {
                return "";
            }
        }
        
        function getMintingIcon($v_id, $stat_notice=1) {
            $CI = $this->obj;
            $vault = $CI->m_vault->get($v_id);
            if (isset($vault) && !empty($vault)) {
                $ivmt_id = $vault[0]->ivmt_id;
                $gram_max = $this->getMintingMaximum();
                $notice = "This item is part of Gold Affordable Campaign. ";
                if ($stat_notice == 2) {
//                    $notice .= "This item should be made till it reaches "
//                            . number_format($gram_max, 2)
//                            . " grams before it can be withdrawn as a solid item.";
                } else if ($stat_notice == 3) {
                    $notice .= "It does not subject to the keep fee.";
                }
                if ($ivmt_id == 2) {
                    return "<span class='top-tooltip bottom-tooltip' data-tooltip='".$notice."' style='cursor: pointer;'>"
//                            . "<img width='25' height='25' src='".base_url()."assets/images/minting3.png' />"
                            . "<span class='fa fa-building-o'></span>"
                            . "</span>";
                } else {
                    return "";
                }
            } else {
                return "";
            }
        }
        
        function getVaucher($code) {
            $CI = $this->obj;
            $str = $this->dinarpal_decrypt($code);
//            echo $str;
            $strpecah = explode('|', $str);
            $v_id = 0;
            $v_cert = '-';
            if (isset($strpecah[0]) && !empty($strpecah[0])) {
                $strpecah2 = explode('V', $strpecah[0]);
                if (isset($strpecah2[1]) && !empty($strpecah2[1])) {
                    $v_id = $strpecah2[1];
                }
            }
            if (isset($strpecah[1]) && !empty($strpecah[1])) {
                $v_cert = $strpecah[1];
            }
//            echo $v_id . ':' . $v_cert;
            $vault = $CI->m_vault->getVaucher($v_id, $v_cert);
            if (isset($vault) && !empty($vault)) {
                $v = array();
                foreach ($vault[0] as $vkey => $vval) {
                    $v[$vkey] = $vval;
                }
                return $v;
            } else {
                return array();
            }
        }
        
        function getVaultImages($v_id, $isStaff=false) {
            $CI = $this->obj;
            $vault = $CI->m_vault->get($v_id);
            $v_idx = $this->dinarpal_encrypt($v_id);
            $imgs = "";
            if (isset($vault) && !empty($vault)) {
                $items = $vault[0];
                $noImage = $this->getNoImage(1);
                $vimg1 = (isset($items->v_image) && !empty($items->v_image) && $items->v_image != null && $items->v_image != "") ?
                        ($items->v_image) : ($noImage);
                $vimg2 = (isset($items->v_image2) && !empty($items->v_image2) && $items->v_image2 != null && $items->v_image2 != "") ?
                        ($items->v_image2) : ($noImage);
                $vimg3 = (isset($items->v_image3) && !empty($items->v_image3) && $items->v_image3 != null && $items->v_image3 != "") ?
                        ($items->v_image3) : ($noImage);
                $vimg4 = (isset($items->v_image4) && !empty($items->v_image4) && $items->v_image4 != null && $items->v_image4 != "") ?
                        ($items->v_image4) : ($noImage);
                $vimg5 = (isset($items->v_image5) && !empty($items->v_image5) && $items->v_image5 != null && $items->v_image5 != "") ?
                        ($items->v_image5) : ($noImage);
                $linkImages = site_url('login/viewProduct/?v='.$v_idx) . '" target="_blank';
                if ($CI->simpleloginsecure->is_logged_in()) {
                    if ($isStaff) {
                        $linkImages = site_url('staff/keep/viewProduct2/513view/?v='.$v_idx) . '';
                    } else {
                        $linkImages = site_url('member/dinarDirham/viewProduct2/513view/?v='.$v_idx) . '';
                    }
                }
                if (isset($items->v_image) && !empty($items->v_image) && $items->v_image != null && $items->v_image != "" && $items->v_image != $noImage) {
                    $imgs .= '<a href="' . $linkImages 
                            . '" rel="zoom-id:MagicZoomPlusImage14063;caption-source:a:title;zoom-width:550;zoom-height:550;show-title:false;" '
                            . 'rev="'. base_url() . 'assets/uploads/items/' 
                            . $vimg1 .'" class="MagicThumb-swap" style="outline: none; display: inline-block;">
                            <img src="'. base_url() . 'assets/uploads/items/'. $vimg1 
                            . '" alt="" style="max-height: 50px; max-width: 50px"></a>';
                } 
                if (isset($items->v_image2) && !empty($items->v_image2) && $items->v_image2 != null && $items->v_image2 != "" && $items->v_image2 != $noImage) {
                    $imgs .= '<a href="' . $linkImages 
                            . '" rel="zoom-id:MagicZoomPlusImage14063;caption-source:a:title;zoom-width:550;zoom-height:550;show-title:false;" '
                            . 'rev="'. base_url() . 'assets/uploads/items/' 
                            . $vimg2 .'" class="MagicThumb-swap" style="outline: none; display: inline-block;">
                            <img src="'. base_url() . 'assets/uploads/items/'. $vimg2 
                            . '" alt="" style="max-height: 50px; max-width: 50px"></a>';
                } 
                if (isset($items->v_image3) && !empty($items->v_image3) && $items->v_image3 != null && $items->v_image3 != "" && $items->v_image3 != $noImage) {
                    $imgs .= '<a href="' . $linkImages 
                            . '" rel="zoom-id:MagicZoomPlusImage14063;caption-source:a:title;zoom-width:550;zoom-height:550;show-title:false;" '
                            . 'rev="'. base_url() . 'assets/uploads/items/' 
                            . $vimg3 .'" class="MagicThumb-swap" style="outline: none; display: inline-block;">
                            <img src="'. base_url() . 'assets/uploads/items/'. $vimg3 
                            . '" alt="" style="max-height: 50px; max-width: 50px"></a>';
                } 
                if (isset($items->v_image4) && !empty($items->v_image4) && $items->v_image4 != null && $items->v_image4 != "" && $items->v_image4 != $noImage) {
                    $imgs .= '<a href="' . $linkImages 
                            . '" rel="zoom-id:MagicZoomPlusImage14063;caption-source:a:title;zoom-width:550;zoom-height:550;show-title:false;" '
                            . 'rev="'. base_url() . 'assets/uploads/items/' 
                            . $vimg4 .'" class="MagicThumb-swap" style="outline: none; display: inline-block;">
                            <img src="'. base_url() . 'assets/uploads/items/'. $vimg4 
                            . '" alt="" style="max-height: 50px; max-width: 50px"></a>';
                } 
                if (isset($items->v_image5) && !empty($items->v_image5) && $items->v_image5 != null && $items->v_image5 != "" && $items->v_image5 != $noImage) {
                    $imgs .= '<a href="' . $linkImages 
                            . '" rel="zoom-id:MagicZoomPlusImage14063;caption-source:a:title;zoom-width:550;zoom-height:550;show-title:false;" '
                            . 'rev="'. base_url() . 'assets/uploads/items/' 
                            . $vimg5 .'" class="MagicThumb-swap" style="outline: none; display: inline-block;">
                            <img src="'. base_url() . 'assets/uploads/items/'. $vimg5 
                            . '" alt="" style="max-height: 50px; max-width: 50px"></a>';
                } 
            }
            return $imgs;
        }
        
        function getAmountToDpgDps($amount=0) {
            $CI = $this->obj;
            $pricePerGramDPG = $CI->m_item_type_purity->getPriceDpgDps(1, 1);
            $pricePerGramDPG = (is_numeric($pricePerGramDPG)) ? ($pricePerGramDPG) : (0);
            $pricePerGramDPG = $this->getDisplayNumber($pricePerGramDPG, 2);
            $p10dpg = $pricePerGramDPG * 1.0 / 10;
            $p10dpg = $this->getDisplayNumber($p10dpg, 2);
            $pricePerGramDPS = $CI->m_item_type_purity->getPriceDpgDps(2, 1);
            $pricePerGramDPS = (is_numeric($pricePerGramDPS)) ? ($pricePerGramDPS) : (0);
            $pricePerGramDPS = $this->getDisplayNumber($pricePerGramDPS, 2);
            $p10dps = $pricePerGramDPS * 1.0 / 10;
            $p10dps = $this->getDisplayNumber($p10dps, 2);
            $amount = (is_numeric($amount)) ? ($amount) : (0);
            $dpg = 0.0;
            $dps = 0.0;
            $myr = 0.00;
            if ($amount >= $p10dpg) {
                $dpg = $amount * 1.0 / $pricePerGramDPG;
                $dpg = $this->getDisplayNumber($dpg, 1);
                $lebihan = $amount - ($pricePerGramDPG * $dpg);
                $dps = $lebihan * 1.0 / $pricePerGramDPS;
                $dps = $this->getDisplayNumber($dps, 1);
                $myr = $lebihan - ($pricePerGramDPS * $dps);
                $myr = $this->getDisplayNumber($myr, 2);
            } else if ($amount < $p10dpg && $amount >= $p10dps) {
                $dps = $amount * 1.0 / $pricePerGramDPS;
                $dps = $this->getDisplayNumber($dps, 1);
                $myr = $amount - ($dps * $pricePerGramDPS);
                $myr = $this->getDisplayNumber($myr, 2);
            } else if ($amount < $p10dpg && $amount < $p10dps && $amount > 0) {
                $myr = $amount;
                $myr = $this->getDisplayNumber($myr, 2);
            }
            $dpg = ($dpg <= 0) ? (0) : ($dpg);
            $dps = ($dps <= 0) ? (0) : ($dps);
            $myr = ($myr <= 0) ? (0) : ($myr);
            $data_out = array(
                'dpg' => $dpg,
                'dps' => $dps,
                'myr' => $myr
            );
            return $data_out;
        }
        
        function getFee($ft_id, $amount=1, $it_id=-1) {
            $CI = $this->obj;
            $ft = $CI->m_fee_type->get($ft_id);
            $ft_price = 0.00;
            $amount = (is_numeric($amount)) ? ($amount) : (0);
            if (isset($ft) && !empty($ft)) {
                $ft_type = $ft[0]->ft_type;
                $ft_price = $ft[0]->ft_price;
                $ft_price = (is_numeric($ft_price)) ? ($ft_price) : (0);
                $ft_dpgdps = $ft[0]->ft_dpgdps;
                $ft_dpgdps = (is_numeric($ft_dpgdps)) ? ($ft_dpgdps) : (0);
                $id_id = $ft[0]->id_id;
                if ($ft_type == 'STATIC') {
                    $ft_price_pergram = $CI->m_item_type_purity->getPriceDpgDps($id_id, 1);
                    $ft_price_pergram = (is_numeric($ft_price_pergram)) ? ($ft_price_pergram) : (0);
                    $ft_price = $ft_price_pergram * $ft_dpgdps;
                } else if ($ft_type == 'DYNAMIC') {
                    $ft_dpgdps = $ft_dpgdps * $amount;
//                    print_r("$ft_dpgdps $it_id<br />");
                    if ($it_id == 1 && $ft_dpgdps < 0.1) {
                        $ft_dpgdps = 0.5;
                        $it_id = 2;
                    } else if ($it_id == 2 && $ft_dpgdps < 0.1) {
                        $ft_dpgdps = 0.1;
                        $it_id = 2;
                    }
//                    print_r("$ft_dpgdps $it_id<br />");
                    $ft_price_pergram = $CI->m_item_type_purity->getPriceDpgDps($it_id, 1);
                    $ft_price_pergram = (is_numeric($ft_price_pergram)) ? ($ft_price_pergram) : (0);
                    $ft_price = $ft_price_pergram * $ft_dpgdps;
                }
            }
            $ft_price = (is_numeric($ft_price)) ? ($ft_price) : (0);
            return $ft_price;
        }
        
        function getFeeDPGDPS($ft_id, $weight=1, $it_id=-1) {
            $CI = $this->obj;
            $ft = $CI->m_fee_type->get($ft_id);
            $ft_price = array(
                'ft_dpgdps' => 0.00,
                'id_id' => 0
            );
            $weight = (is_numeric($weight)) ? ($weight) : (0);
            if (isset($ft) && !empty($ft)) {
                $ft_type = $ft[0]->ft_type;
                $ft_dpgdps = $ft[0]->ft_dpgdps;
                $ft_dpgdps = (is_numeric($ft_dpgdps)) ? ($ft_dpgdps) : (0);
                $id_id = ($it_id != -1) ? ($it_id) : ($ft[0]->id_id);
                if ($ft_type == 'STATIC') {
                    $ft_dpgdps = $ft_dpgdps;
                } else if ($ft_type == 'DYNAMIC') {
                    $ft_dpgdps = $ft_dpgdps * $weight;
                }
//                echo "$ft_dpgdps $weight;<br />";
                $ft_price['ft_dpgdps'] = $ft_dpgdps;
                $ft_price['id_id'] = $id_id;
                if ($id_id == 1 && $ft_dpgdps < 0.1) {
                    $ft_price['ft_dpgdps'] = $this->getDpsRate();
                    $ft_price['id_id'] = 2;
                } else if ($id_id == 2 && $ft_dpgdps < 0.1) {
                    $ft_price['ft_dpgdps'] = 0.1;
                    $ft_price['id_id'] = 2;
                }
            }
//            print_r($ft_price); echo "<br />";
            return $ft_price;
        }
        
        function getVaultSpecCommission($v_weight='', $it_id=1, $pu_id=1, $ivt_id=1, $vb_id=1, $amount='', $ivmt_id=-1, $id_id=-1) {
            $CI = $this->obj;
            $vs = $CI->m_vault_spec->getAll($v_weight, $it_id, $pu_id, $ivt_id, $vb_id, $ivmt_id, $id_id);
//            echo "<pre>"; print_r($vs);
            $vs_discount = 0.00;
            $amount = (is_numeric($amount)) ? ($amount) : (0);
            if (isset($vs) && !empty($vs)) {
                $vs_discount_type = $vs[0]->vs_discount_type;
                $vs_discount = $vs[0]->vs_discount;
                $vs_discount = (is_numeric($vs_discount)) ? ($vs_discount) : (0);
                if ($vs_discount_type == 'STATIC') {
                    $vs_discount = $vs_discount;
                } else if ($vs_discount_type == 'DYNAMIC') {
                    $vs_discount = $vs_discount * $amount;
                }
            }
            $vs_discount = (is_numeric($vs_discount)) ? ($vs_discount) : (0);
            $vs_discount = $this->getDisplayNumber($vs_discount, 2);
            return $vs_discount;
        }
        
        function getBallon($me_id) {
            $CI = $this->obj;
            $ft = $CI->m_fee_type->get($ft_id);
            $ft_price = 0.00;
            $amount = (is_numeric($amount)) ? ($amount) : (0);
            if (isset($ft) && !empty($ft)) {
                $ft_type = $ft[0]->ft_type;
                $ft_price = $ft[0]->ft_price;
                $ft_price = (is_numeric($ft_price)) ? ($ft_price) : (0);
                if ($ft_type == 'STATIC') {
                    $ft_price = $ft_price;
                } else if ($ft_type == 'DYNAMIC') {
                    $ft_price = $ft_price * $amount;
                }
            }
            $ft_price = (is_numeric($ft_price)) ? ($ft_price) : (0);
            return $ft_price;
        }
        
        function getFeeDecription($ft_id) {
            $CI = $this->obj;
            $ft = $CI->m_fee_type->get($ft_id);
            $fee_desc = "0%";
            $currency = $this->getCurrency();
            if (isset($ft) && !empty($ft)) {
                $ft_type = $ft[0]->ft_type;
                $ft_price = $ft[0]->ft_price;
                $ft_price = (is_numeric($ft_price)) ? ($ft_price) : (0);
                if ($ft_type == 'STATIC') {
                    $fee_desc = $currency . ' ' . number_format($ft_price, 2);
                } else if ($ft_type == 'DYNAMIC') {
                    $fee_desc = number_format($ft_price*100, 2) . '%';
                }
            }
            return $fee_desc;
        }
        
        function getShortString($str, $limit=20) {
            $s = "";
            for ($i=0; $i<$limit && $i<strlen($str); $i++) {
                $s .= $str[$i];
            }
            if (strlen($str) >= $limit) {
                $s .= "...";
            }
            return $s;
        }
        
        function getLoadingIcon() {
            $str = "<center><h4>.. Connecting ..</h4><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i></center>";
            return $str;
        }
        
        function distance($lat1, $lon1, $lat2, $lon2, $unit) {

            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper(strtolower($unit));

            if ($unit == "K") {
                // kilometers
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                // nautica
                return ($miles * 0.8684);
            } else if ($unit == "M") {
                // meters
                return (($miles * 1.609344) * 1000);
            } else {
                return $miles;
            }
        }
        
        function checkLivePrice($tt_id, $v_weight, $it_id, $pu_id, $ivt_id, $vb_id) {
            $CI = $this->obj;
            $vs = $CI->m_vault_spec->getAll($v_weight, $it_id, $pu_id, $ivt_id, $vb_id);
            $v_price_rate = 0.00;
            $currency = $this->getCurrency();
            $gst_rate = $this->getGST();
            $gst_rate = (is_numeric($gst_rate)) ? ($gst_rate) : (0);
            $gst_rate = $this->getDisplayNumber($gst_rate, 2);
            if (isset($vs) && !empty($vs)) {
                $v_price_rate = (is_numeric($vs[0]->vs_sell)) ? ($vs[0]->vs_sell) : (0);
                $v_price_rate = $this->getDisplayNumber($v_price_rate, 2);
                switch ($tt_id) {
                    // walk-in purchase & pickup
                    case 41:
                        $gst_tax = $gst_rate * $v_price_rate;
                        $gst_tax = $this->getDisplayNumber($gst_tax, 2);
                        $total_price = $v_price_rate + $gst_tax;
                        $total_price = number_format($total_price, 2);
                        return $currency . ' ' . $total_price;
                    case 7:
                        $gst_tax_price = $gst_rate * $v_price_rate;
                        $gst_tax_price = $this->getDisplayNumber($gst_tax_price, 2);
                        $keep_fee = $this->getFee(7, $v_price_rate);
                        $keep_fee = $this->getDisplayNumber($keep_fee, 2);
                        $gst_fee = $gst_rate * $keep_fee;
                        $gst_fee = $this->getDisplayNumber($gst_fee, 2);
                        $total_price = $v_price_rate + $gst_tax_price + $keep_fee + $gst_fee;
                        $total_price = number_format($total_price, 2);
                        return $currency . ' ' . $total_price;
                    case 10:
                        $gst_tax = $gst_rate * $v_price_rate;
                        $gst_tax = $this->getDisplayNumber($gst_tax, 2);
                        $total_price = $v_price_rate + $gst_tax;
                        $total_price = number_format($total_price, 2);
                        return $currency . ' ' . $total_price;
                    default:
                        return "n/a";
                }
            } else {
                return "n/a";
            }
        }
        
        function isValidtoDPGDPS($it_id, $pu_id) {
            if (($it_id == 1 || $it_id == 2) && $pu_id == 1) {
                return true;
            } else {
                return false;
            }
        }
        
        function deleteAllMembers($secondsBeforeDateline=999999, 
                $me_activation_status=-1, $me_type='', $ml_id=-1, 
                $me_account_type=-1) {
            $CI = $this->obj;
            $members = $CI->m_members->getAll($ml_id, -1, $me_activation_status, '', '', false, $me_type, $me_account_type);
            $kira = 1;
            if (isset($members) && !empty($members)) {
                foreach ($members as $me) {
                    $me_id = $me->me_id;
                    $me_reg_date = strtotime($me->me_register_date);
                    $today = strtotime(date('Y-m-d H:i:s'));
                    $diff = $today - $me_reg_date;
                    $diff = ($diff <= 0) ? (0) : ($diff);
                    if ($diff > $secondsBeforeDateline) {
//                        echo ($kira++) . ' | ' . $me_id . ' | ' . $diff . ' | ' . $me->me_register_date . '<br />';
                        $CI->m_members->deleteMemberAllAccount($me_id);
                    }
                }
            }
//            die();
        }
        
        function remindMembersVerify($secondsBeforeDateline=999999, 
                $me_activation_status=-1, $me_type='', $ml_id=-1, 
                $me_account_type=-1) {
            $CI = $this->obj;
            $members = $CI->m_members->getAll($ml_id, -1, $me_activation_status, '', '', false, $me_type, $me_account_type);
            $kira = 1;
            if (isset($members) && !empty($members)) {
                foreach ($members as $me) {
                    $me_id = $me->me_id;
                    $me_reg_date = strtotime($me->me_register_date);
                    $today = strtotime(date('Y-m-d H:i:s'));
                    $diff = $today - $me_reg_date;
                    $diff = ($diff <= 0) ? (0) : ($diff);
                    if ($diff > $secondsBeforeDateline) {
//                        echo ($kira++) . ' | ' . $me_id . ' | ' . $diff . ' | ' . $me->me_register_date . '<br />';
                        
//                        $to = $me->me_email;
//                        $subject = "DinarPal - Reminder of Account Verification!";
//                        $msg = "Please be informed that you need to immediately "
//                                . "upload your account so that your account is considered inactive accounts. go to the menu profile and upload documents copies of identity cards and other related documents, and we will confirm that your account.";
//                        $this->send_email($to, $subject, $msg)
                    }
                }
            }
//            die();
        }
        
        //gets the data from a URL  
        function get_tiny_url($url)  {  
            $ch = curl_init();  
            $timeout = 5;  
            curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
            $data = curl_exec($ch);  
            curl_close($ch);  
            return $data;  
        }
        
        function getAgentID($str_num) {
            $ga_ul_new = "";
            for ($gg=0; $gg<strlen($str_num); $gg++) {
                $ga_ul_new .= $str_num[$gg];
                if ($gg==3 || $gg==7 || $gg==11) {
                    $ga_ul_new .= "-";
                }
            }
            return $ga_ul_new;
        }
        
        function isValidVerify($me_id) {
            $status = true;
            
            $CI = $this->obj;
            $mems = $CI->m_members->get($me_id);
//            echo "<pre>"; print_r($mems); die();
            
            $status_arr = array();
            
            /**
                1. Profile Picture
                2. Full Name (First and Last name)
                3. Gender
                4. Date of Birth
                5. Address (Permanent and Mailing)
                6. Beneficiary Info
                7. Uploading your document of National Issuer ID or Passport
                8. Uploading your document of 2nd Supporting Document (any document that related to you)
                9. Banks Account Info
               10. At least bank in to buy 3.5g DPS
             */
            
            // 1.
            $me_image = $mems[0]->me_image;
            if ($me_image == 'default-img.jpg' || $me_image == NULL || $me_image == '' || $me_image == "") {
                $status_arr[0] = false;
            } else {
                $status_arr[0] = true;
            }
            
            // 2.
            $me_firstname = $mems[0]->me_firstname;
            $me_lastname = $mems[0]->me_lastname;
            $me_username = $mems[0]->me_username;
            if (($me_firstname == $me_username && $me_lastname == $me_username) 
                    || $me_firstname == "" || $me_firstname == '' || $me_firstname == NULL || empty($me_firstname) 
                    || $me_lastname == "" || $me_lastname == '' || $me_lastname == NULL || empty($me_lastname)) {
                $status_arr[1] = false;
            } else {
                $status_arr[1] = true;
            }
            
            // 3.
            $g_id = $mems[0]->g_id;
            if ($g_id == 0 || $g_id == NULL || $g_id == "" || $g_id == '' || empty($g_id)) {
                $status_arr[2] = false;
            } else {
                $status_arr[2] = true;
            }
            
            // 4.
            $me_birth_date = $mems[0]->me_birth_date;
            if ($me_birth_date == "" || $me_birth_date == NULL || $me_birth_date == '' 
                    || $me_birth_date == '0000-00-00 00:00:00' || empty($me_birth_date)) {
                $status_arr[3] = false;
            } else {
                $status_arr[3] = true;
            }
            
            // 5.
            $me_address1 = $mems[0]->me_address1;
            $me_city1 = $mems[0]->me_city1;
            $me_state1 = $mems[0]->me_state1;
            $me_postcode1 = $mems[0]->me_postcode1;
            $me_country1 = $mems[0]->me_country1;
            $me_address2 = $mems[0]->me_address2;
            $me_city2 = $mems[0]->me_city2;
            $me_state2 = $mems[0]->me_state2;
            $me_postcode2 = $mems[0]->me_postcode2;
            $me_country2 = $mems[0]->me_country2;
            if ($me_address1 == "" || $me_address1 == '' || $me_address1 == NULL || empty($me_address1) 
                    || $me_city1 == "" || $me_city1 == '' || $me_city1 == NULL || empty($me_city1)
                    || $me_state1 == "" || $me_state1 == '' || $me_state1 == NULL || empty($me_state1)
                    || $me_postcode1 == "" || $me_postcode1 == '' || $me_postcode1 == NULL || empty($me_postcode1)
                    || $me_country1 == "" || $me_country1 == '' || $me_country1 == NULL || empty($me_country1)
                    || $me_address2 == "" || $me_address2 == '' || $me_address2 == NULL || empty($me_address2) 
                    || $me_city2 == "" || $me_city2 == '' || $me_city2 == NULL || empty($me_city2)
                    || $me_state2 == "" || $me_state2 == '' || $me_state2 == NULL || empty($me_state2)
                    || $me_postcode2 == "" || $me_postcode2 == '' || $me_postcode2 == NULL || empty($me_postcode2)
                    || $me_country2 == "" || $me_country2 == '' || $me_country2 == NULL || empty($me_country2)) {
                $status_arr[4] = false;
            } else {
                $status_arr[4] = true;
            }
            
            // 6.
            $biw_firstname = $mems[0]->biw_firstname;
            $biw_lastname = $mems[0]->biw_lastname;
            $g_id_biw = $mems[0]->g_id_biw;
            $biw_relationship = $mems[0]->biw_relationship;
            $biw_email = $mems[0]->biw_email;
            $biw_phone = $mems[0]->biw_phone;
            $biw_address = $mems[0]->biw_address;
            $biw_city = $mems[0]->biw_city;
            $biw_state = $mems[0]->biw_state;
            $biw_postcode = $mems[0]->biw_postcode;
            $biw_country = $mems[0]->biw_country;
            if ($biw_firstname == "" || $biw_firstname == '' || $biw_firstname == NULL || empty($biw_firstname) 
                    || $biw_lastname == "" || $biw_lastname == '' || $biw_lastname == NULL || empty($biw_lastname)
                    || $g_id_biw == "" || $g_id_biw == '' || $g_id_biw == NULL || empty($g_id_biw)
                    || $biw_relationship == "" || $biw_relationship == '' || $biw_relationship == NULL || empty($biw_relationship)
                    || $biw_email == "" || $biw_email == '' || $biw_email == NULL || empty($biw_email)
                    || $biw_phone == "" || $biw_phone == '' || $biw_phone == NULL || empty($biw_phone) 
                    || $biw_address == "" || $biw_address == '' || $biw_address == NULL || empty($biw_address)
                    || $biw_city == "" || $biw_city == '' || $biw_city == NULL || empty($biw_city)
                    || $biw_state == "" || $biw_state == '' || $biw_state == NULL || empty($biw_state)
                    || $biw_postcode == "" || $biw_postcode == '' || $biw_postcode == NULL || empty($biw_postcode)
                    || $biw_country == "" || $biw_country == '' || $biw_country == NULL || empty($biw_country)) {
                $status_arr[5] = false;
            } else {
                $status_arr[5] = true;
            }
            
            // 7.
            $dd1 = $CI->m_dinarpal_document->get_member($me_id, 1);
            if (!isset($dd1) || empty($dd1)) {
                $status_arr[6] = false;
            } else {
                $status_arr[6] = true;
            }
            
            // 8.
            $dd2 = $CI->m_dinarpal_document->get_member($me_id, 2);
            if (!isset($dd2) || empty($dd2)) {
                $status_arr[7] = false;
            } else {
                $status_arr[7] = true;
            }
            
            // 9.
            $bm = $CI->m_banks_members->getAll_basedMe($me_id);
            if (!isset($bm) || empty($bm)) {
                $status_arr[8] = false;
            } else {
                $status_arr[8] = true;
            }
            
            // 10.
            $dinarpal_account = $CI->m_dinarpal_account->get_member($me_id);
            $da_gold_balance = (is_numeric($dinarpal_account[0]->da_gold_balance)) ? ($dinarpal_account[0]->da_gold_balance) : (0);
            $vault_dpg = $CI->m_vault->getAll_personal(8, $me_id, 2, 1, -1, '', 100000, '', '-1', '', true);
            $totalWeightVault_dpg = 0.0;
            if (isset($vault_dpg) && !empty($vault_dpg)) {
                $totalWeightVault_dpg = (isset($vault_dpg[0]->sum_v_weight)) ? ($vault_dpg[0]->sum_v_weight) : (0);
                $totalWeightVault_dpg = (is_numeric($vault_dpg[0]->sum_v_weight)) ? ($vault_dpg[0]->sum_v_weight) : (0);
            }
            $vault_dps = $CI->m_vault->getAll_personal(8, $me_id, 2, 2, -1, '', 100000, '', '-1', '', true);
            $totalWeightVault_dps = 0.0;
            if (isset($vault_dps) && !empty($vault_dps)) {
                $totalWeightVault_dps = (isset($vault_dps[0]->sum_v_weight)) ? ($vault_dps[0]->sum_v_weight) : (0);
                $totalWeightVault_dps = (is_numeric($vault_dps[0]->sum_v_weight)) ? ($vault_dps[0]->sum_v_weight) : (0);
            }
            $ft_id = 1; // verification fee
            $fee_myr = $this->getFee($ft_id);
            $gst_rate = $this->getGST();
            $fee_myr_gst = $fee_myr * $gst_rate;
            $fee_myr_gst = $this->getDisplayNumber($fee_myr_gst, 2);
            $fee_myr_gst = ceil($fee_myr_gst);
            $fee_myr += $fee_myr_gst;
            $fee_myr = (is_numeric($fee_myr)) ? ($this->getDisplayNumber($fee_myr, 2)) : ($fee_myr);
            $fee_myr = ceil($fee_myr);
            $fee_dpgdps = $this->getFeeDPGDPS($ft_id);
            $ft_dpgdps = $fee_dpgdps['ft_dpgdps'];
            $id_id = $fee_dpgdps['id_id'];
            $isVault = false;
            if ($id_id == 1 && $totalWeightVault_dpg >= $ft_dpgdps && $da_gold_balance >= $fee_myr_gst) {
                $isVault = true;
            } else if ($id_id == 2 && $totalWeightVault_dps >= $ft_dpgdps && $da_gold_balance >= $fee_myr_gst) {
                $isVault = true;
            } else if ($da_gold_balance >= $fee_myr) {
                $isVault = true;
            } else {
                $isVault = false;
            }
//            echo "$id_id == 2 && $totalWeightVault_dps >= $ft_dpgdps && $da_gold_balance >= $fee_myr_gst <br /> $da_gold_balance > $fee_myr"; die();
//            echo "<pre>$fee_myr $fee_myr_gst <br />"; print_r($fee_dpgdps); die(); 
            $status_arr[9] = $isVault;
            
            // result
            foreach ($status_arr as $sa) {
                if ($sa == false) {
                    $status = false;
                    break;
                }
            }
            
            $data_out = array(
                'status' => $status,
                'status_arr' => $status_arr
            );
            
            return $data_out;
        }
}
?>