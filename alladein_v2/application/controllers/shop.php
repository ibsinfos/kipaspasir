<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shop extends CI_Controller {

    var $parent_page = "shop";

    function __construct() {
        parent::__construct();
    }

    private function viewpage($page = 'v_main', $data = array()) {
        
        echo $this->load->view('v_header', $data, true);
        
        $category_parent = $this->m_button_api_category->getParent();
        $menus['category_parent'] = $category_parent;
        $menus['carida_str'] = ($this->input->get('carida')) ? ($this->input->get('carida')) : ("");
        echo $this->load->view($this->parent_page . '/v_menu', $menus, true);
        
        echo $this->load->view($this->parent_page . '/' . $page, $data, true);
        
        echo $this->load->view('v_footer', $data, true);
    }
    
    public function s($page='main', $bapidx='-') {
        $data = array();
        switch ($page) {
            case 'main':
                $limit = 8;
                $button_api = $this->m_button_api->getAll('', '', '', '', '', '', '', '', $limit);
//                echo "<pre>"; print_r($button_api); die();
                $data['button_api'] = $button_api;
                break;
            case 'productDetail':
                $bap_id = $this->my_func->dinarpal_decrypt($bapidx);
                $button_api = $this->m_button_api->get($bap_id);
                if (isset($button_api) && !empty($button_api)) {
                    $data['button_api'] = $button_api;
                    $bap_info_url = $button_api[0]->bap_info_url;
                    $bap_info_url = str_replace('watch?v=', 'embed/', $bap_info_url);
                    $data['bap_info_url'] = $bap_info_url;
                    $bap_name = $button_api[0]->bap_name;
                    $bap_name_arr = explode(' ', $bap_name);
                    $limit = 12;
                    $other_prod = $this->m_button_api->getAll('', '', '', '', '', '', '', '', 
                            $limit, $bap_name_arr);
                    $data['other_prod'] = $other_prod;
                } else {
                    redirect(site_url('shop'));
                }
                break;
            case 'products':
                $carida = "";
                $title = "Latest Products";
                $carida_arr = array();
                if ($this->input->get('carida')) {
                    $carida = $this->input->get('carida');
                    $carida_arr = explode(' ', $carida);
                    $title = "Search of ";
                    foreach ($carida_arr as $ca) {
                        $title .= "+" . $ca . " ";
                    }
                }
                $bac_id = -1;
                if ($this->input->get('c')) {
                    $bac_idx = $this->input->get('c');
                    $bac_id = $this->my_func->dinarpal_decrypt($bac_idx);
                    $bac = $this->m_button_api_category->get($bac_id);
                    if (isset($bac) && !empty($bac)) {
                        $title = "Category of " . $bac[0]->bac_desc;
                    }
                }
                $me_id = -1;
                if ($this->input->get('u')) {
                    $meidx = $this->input->get('u');
                    $me_id = $this->my_func->dinarpal_decrypt($meidx);
                    $me = $this->m_members->get($me_id);
                    if (isset($me) && !empty($me)) {
                        $title = "Products of " . $me[0]->me_username;
                    }
                }
                $limit = 21;
                $button_api = $this->m_button_api->getAll('', '', '', '', '', '', '', '', 
                        $limit, $carida_arr, $bac_id, $me_id);
                $data['button_api'] = $button_api;
                $data['title'] = $title;
                break;
        }
        $page = "v_".$page;
        $this->viewpage("s/".$page, $data);
    }
 
    public function index() {
        redirect(site_url('shop/s'));
    } 

    public function myCarts() {
        $this->viewpage('v_cart');
    }

    public function checkout() {
        $this->viewpage('v_checkout');
    }

    public function contact() {
        $this->viewpage('v_contact');
    }

    public function login() {
        $this->viewpage('v_login');
    }

    public function signin() {
        $this->viewpage('v_main_after_signin.php');
    }

    public function step1() {
        $this->viewpage('v_step1_term');
    }

    public function step2() {
        $this->viewpage('v_step2_address');
    }

    public function step3() {
        $this->viewpage('v_step3_confirm');
    }

    public function step4() {
        $this->viewpage('v_step4_receipt');
    }

}
