<?php 

/**
 * 
 */
class Language extends CI_Controller
{

  public function __construct(){
    parent::__construct();
  }
  
  function index()
  {
    $uri=$this->uri->segment(3);

    // print_r($uri);die();
    $this->session->set_userdata('site_lang',$uri);
    redirect($_SERVER['HTTP_REFERER']);
  }
}