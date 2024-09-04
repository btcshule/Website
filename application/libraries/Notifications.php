<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications
{
    protected $CI;

    public function __construct()
    {
   $this->CI = & get_instance();
   $this->CI->load->library('email');
   $this->CI->load->model('Model');
 }



 function send_mail($emailTo = array(), $subjet, $cc_emails = array(), $message, $attach = array()) {

          $config['protocol'] = 'smtp';
          $config['smtp_host'] = 'smtp.hostinger.com';
          $config['smtp_port'] = 587;
          $config['smtp_user'] = 'no-reply@gc.mme-mag.com';
          $config['smtp_pass'] = 'Gstock@2023';
          $config['mailtype'] = 'html';
          $config['charset'] = 'UTF-8';
          $config['wordwrap'] = TRUE;
          $config['smtp_timeout'] = 20;
          $config['newline'] = "\r\n";
          $this->CI->email->initialize($config);
          $this->CI->email->set_mailtype("html");


          $this->CI->email->from('no-reply@gc.mme-mag.com', 'GESTION DE STOCK');
          $this->CI->email->to($emailTo);
         
          if (!empty($cc_emails)) {
              foreach ($cc_emails as $key => $value) {
                  $this->CI->email->cc($value);
              }
          }
          $this->CI->email->subject($subjet);
          $this->CI->email->message($message);
          if (!empty($attach)) {
              foreach ($attach as $att)
                //print_r($att);die();
                  $this->CI->email->attach($att);
          }
          if (!$this->CI->email->send()) {
              show_error($this->CI->email->print_debugger());
          }
              else;
      }


public function send_sms($string_tel = NULL,$string_msg)
{
  $data = '{"urns": ["' . $string_tel . '"],"text":"' . $string_msg . '"}';

  $header = array();
        $header [0] = 'Authorization:Token 8ae3e567ec75aeac4fab42a43c64edf52f0eb736';  //pas d'espace entre Authori et : et Token
        $header [1] = 'Content-Type:application/json';
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://sms.ubuviz.com/api/v2/broadcasts.json');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($curl);
       // $result = json_decode($result);

        return $result;
      }


      public function generate_UIID($taille)
      {
       $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
       $QuantidadeCaracteres = strlen($Caracteres); 
       $QuantidadeCaracteres--; 

       $Hash=NULL; 
       for($x=1;$x<=$taille;$x++){ 
        $Posicao = rand(0,$QuantidadeCaracteres); 
        $Hash .= substr($Caracteres,$Posicao,1); 
      }

      return $Hash; 
    }

    public function generate_password($taille)
    {
     $Caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMOPQRSTUVXWYZ0123456789,.@{-_/#'; 
     $QuantidadeCaracteres = strlen($Caracteres); 
     $QuantidadeCaracteres--; 

     $Hash=NULL; 
     for($x=1;$x<=$taille;$x++){ 
      $Posicao = rand(0,$QuantidadeCaracteres); 
      $Hash .= substr($Caracteres,$Posicao,1); 
    }
    return $Hash; 
  }


  function get_unread_notifications()
  {

    $get_unread=$this->CI->Model->getRequete("SELECT n.NOTIFICATION_ID,n.MESSAGE,n.DATE_ENVOI FROM notifications_stock n WHERE n.STATUT=0");

    $content='<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
    <i class="dripicons-bell noti-icon"></i>
    '.$indicator = (!empty($get_unread)) ? '<span class="noti-icon-badge"></span>' : ''.'
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

    <div class="dropdown-item noti-title">
    <h5 class="m-0">
    <span class="float-end">
    <a href="javascript: void(0);" class="text-dark">
    <small>Effacer tous</small>
    </a>
    </span>Notifications
    </h5>
    </div>
    <div style="max-height: 230px;" data-simplebar>';

    // $total=0;
    // foreach ($get_unread as $key) {
    //   # code...
    //   $total++;

    //   $content.='<a href="javascript:void(0);" class="dropdown-item notify-item">
    //   <div class="notify-icon bg-primary">
    //   <i class="mdi mdi-comment-account-outline"></i>
    //   </div>
    //   <p class="notify-details">'.$key['MESSAGE'].'
    //   <small class="text-muted">1 min ago</small>
    //   </p>
    //   </a>';

    // }

    $content.='</div>
    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
    Voir tous
    </a>

    </div>
    </li>';

    echo $content;


  }










}

?>
