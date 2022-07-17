<?php 

	Class Admin {
		var $template_data = [];
		function set($name, $value){
			$this->template_data[$name] = $value;
		}
		function load($template = '', $view = '', $view_data=[], $return=FALSE){
			$this->CI=&get_instance();
			
			$this->set('konten', $this->CI->load->view($view, $view_data, TRUE));
			return $this->CI->load->view($template, $this->template_data, $return);
		}
	}
