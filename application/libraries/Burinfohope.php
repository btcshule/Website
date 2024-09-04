<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Burinfohope
{
	protected $CI;

	public function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->library('email');
		$this->CI->load->model('Model');
	}

	public function generate_password($taille)
	{
    // $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
		$Caracteres = '0123456789';
		$QuantidadeCaracteres = strlen($Caracteres);
		$QuantidadeCaracteres--;

		$Hash=NULL;
		for($x=1;$x<=$taille;$x++){
			$Posicao = rand(0,$QuantidadeCaracteres);
			$Hash .= substr($Caracteres,$Posicao,1);
		}
		return $Hash;
	}


	public function generateQrcode($data,$name)
	{
      if(!is_dir('uploads/QRCODE')) //create the folder if it does not already exists
      {
      	mkdir('uploads/QRCODE',0777,TRUE);
      }

      $Ciqrcode = new Ciqrcode();
      $params['data'] = $data;
      $params['level'] = 'H';
      $params['size'] = 15;
      $params['overwrite'] = TRUE;
      $params['savename'] = FCPATH . 'uploads/QRCODE/' . $name . '.png';
      $Ciqrcode->generate($params);
  }



  function accent2ascii(string $str, string $charset = 'utf-8'): string
   {
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;
  }



  // celle ci extraire le texte et le separer par les traits en ignorant les accents

function extractKeywords($str){

    $strArray = preg_split("/[\s,;\.\:\"\'\?\!]+/", $str);
    $return = "";

     $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð',
                'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã',
                'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë','és','ées','ée', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ',
                'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ',
                'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę',
                'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī',
                'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ',
                'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ',
                'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 
                'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 
                'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ',
                'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');

  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O',
                'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c',
                'e', 'e', 'e', 'e','es','ees','ee', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u',
                'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D',
                'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g',
                'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K',
                'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o',
                'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S',
                's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W',
                'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i',
                'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');

    if(count($strArray)>0){
      foreach($strArray as $s){
        
      if(!empty($return)) $return.="-";
        $return.=$s;
        
      }
    }
    return str_replace($a,$b,$return);
  }




function get_mois_string($name)
{
  
    switch ($name) {
      case '01':
      return 'Janvier'; 
      break;
      case '02':
      return 'Février';
      break;
      case '03':
      return "Mars";
      break;
      case '04':
      return "Avril"; 
      break;
      case '05':
      return "Mai";
      break;
      case '06':
      return "Juin";
      break;
      case '07':
      return "Juillet";
      break;
      case '08':
      return "Août";
      break;
      case '09':
      return "Septembre";
      break;
      case '10':
      return "Octobre";
      break;
      case '11':
      return "Novembre";
      break;
      case '12':
      return "Décembre";
      break;
      
      default:
        
      break;
    
    
  }
}








function get_mois_litterale($param)
{
  
    switch ($param) {
      case '01':
      return 'Jan'; 
      break;
      case '02':
      return 'Févr';
      break;
      case '03':
      return "Mars";
      break;
      case '04':
      return "Avril"; 
      break;
      case '05':
      return "Mai";
      break;
      case '06':
      return "Juin";
      break;
      case '07':
      return "Juil";
      break;
      case '08':
      return "Août";
      break;
      case '09':
      return "Sempt";
      break;
      case '10':
      return "Oct";
      break;
      case '11':
      return "Nov";
      break;
      case '12':
      return "Déc";
      break;
      
      default:
        
      break;
    
    
  }
}




















}