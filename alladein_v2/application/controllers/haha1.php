<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Haha1 extends MY_Controller 
{
        var $parent_page = "haha1";
	function __construct()
	{
            parent::__construct(); 
	}
        
        function index() {
            echo "saya di index";
        }
        
        function method2() {
            echo "method 2 haha";
        }
        
        function panggilView($param1=1, $param2=1)
        {
            $a = $param1;
            $b = $param2;
            $c = $a + $b;
            
            $data['a'] = $a;
            $data['b'] = $b;
            $data['c'] = $c;
            $data['dah'] = "aku";
            $data['arr']['var1'] = "hai kkk";
            
            $this->load->view('v_header');
            echo $this->load->view('haha1/v_page1', $data, true);
        }
}
