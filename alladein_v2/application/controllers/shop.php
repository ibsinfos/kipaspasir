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
            echo $this->load->view($this->parent_page.'/'.'v_header', $data, true);
            echo $this->load->view($this->parent_page.'/'.'v_menu', $data, true);
            echo $this->load->view($this->parent_page.'/'.$page, $data, true);
            echo $this->load->view($this->parent_page.'/'.'v_footer', $data, true);
        }


        public function index()
	{
            $this->viewpage();
	}
        
}