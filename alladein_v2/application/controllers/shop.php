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
}