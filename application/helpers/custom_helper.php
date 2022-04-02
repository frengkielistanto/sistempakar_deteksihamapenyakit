<?php

function is_logged()
{
	$CI = &get_instance();

	if ($CI->session->userdata('is_login') == false && empty($CI->session->userdata('userdata'))) {
		return false;
	} else {
		return true;
	}
}

function users(){
	$CI = &get_instance();

	return $CI->session->userdata('userdata');
}
