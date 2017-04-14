<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller 
{
        var $parent_page = "shop";
	function __construct()
	{
            parent::__construct(); 
	}
        
        private function viewpage($page='v_main', $data=array())
        {
            echo $this->load->view('v_header', $data, true);
            echo $this->load->view('v_menu', $data, true);
            echo $this->load->view($this->parent_page.'/'.$page, $data, true);
            echo $this->load->view('v_footer', $data, true);
        }

        public function index()
	{
            $this->viewpage();
	}
        
        public function showProducts()
        {
            $this->viewpage('v_products');
        }
        
        public function showProductDetail()
        {
            $this->viewpage('v_product_detail');
        }
        
        public function myCarts()
        {
            $this->viewpage('v_cart');
        }
        
        public function checkout()
        {
            $this->viewpage('v_checkout');
        }
		
		public function contact()
        {
            $this->viewpage('v_contact');
        }	
		public function login()
        {
            $this->viewpage('v_login');
        }
		public function step1()
        {
            $this->viewpage('v_step1_term');
        }
		public function step2()
        {
            $this->viewpage('v_step2_address');
        }
		public function step3()
        {
            $this->viewpage('v_step3_confirm');
        }
		public function step4()
        {
            $this->viewpage('v_step4_receipt');
        }

}