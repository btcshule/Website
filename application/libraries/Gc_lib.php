<?php 
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Gc_lib {

	
	protected $CI;

	public function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->library('email');
		$this->CI->load->model('Model');
	}

	function get_literal($day)
	{
		$day_name="";
		switch ($day) {
			case '0':
				# code...
			$day_name="Lundi";
			break;
			case '1':
				# code...
			$day_name="Mardi";
			break;
			
			case '2':
				# code...
			$day_name="Mercredi";
			break;
			case '3':
				# code...
			$day_name="Jeudi";
			break;
			case '4':
			$day_name="Vendredi";
				# code...
			break;
			case '5':
				# code...
			$day_name="Samedi";
			break;
			case '6':
				# code...
			$day_name="Dimanche";
			break;
			default:
			# code...
			$day_name="Inconnu";
			break;


		}

		return $day_name;
	}




	function get_month($mois)
	{
		$month_name="";
		switch ($mois) {
			case '1':
				# code...
			$month_name="Janvier";
			break;
			case '2':
				# code...
			$month_name="Février";
			break;
			
			case '3':
				# code...
			$month_name="Mars";
			break;
			case '4':
				# code...
			$month_name="Avril";
			break;
			case '5':
			$month_name="Mai";
				# code...
			break;
			case '6':
				# code...
			$month_name="Juin";
			break;
			case '7':
				# code...
			$month_name="Juillet";
			break;
			case '8':
				# code...
			$month_name="Août";
			break;

			case '9':
				# code...
			$month_name="Septembre";
			break;
			case '10':
				# code...
			$month_name="Octobre";
			break;
			case '11':
				# code...
			$month_name="Novembre";
			break;
			case '12':
				# code...
			$month_name="Décembre";
			break;
			default:
			# code...
			$month_name="Inconnu";
			break;


		}

		return $month_name;
	}


	function base64url_encode($str) {
		return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
	}

	function generate_jwt($headers, $payload, $secret = 'secret') {

		$headers_encoded = $this->base64url_encode(json_encode($headers));
		$payload_encoded = $this->base64url_encode(json_encode($payload));

		$signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
		$signature_encoded = $this->base64url_encode($signature);

		$jwt = "$headers_encoded.$payload_encoded.$signature_encoded";

		return $jwt;
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








}