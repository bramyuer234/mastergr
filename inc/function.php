<?php
function debug($result) {
	echo '<pre>'; print_r($result); echo '</pre>';
}

function cutter($content, $start, $end) {
	if($content && $start && $end) {
		$r = explode($start, $content);
		if (isset($r[1])) {
			$r = explode($end, $r[1]);
			return $r[0];
		}
		return false;
	}
}


function baca($url, $referer = 'http://www.google.com/firefox?client=firefox-a&rls=org.mozilla:fr:official', $ua = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.18) Gecko/20110614 Firefox/3.6.18') {
	if(function_exists('curl_exec')) {
		$curl = curl_init();
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Keep-Alive: 300";
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$header[] = "Accept-Language: en-us,en;q=0.5";
		$header[] = "Pragma: ";
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_USERAGENT, $ua);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_REFERER, $referer);
		curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		$content = curl_exec($curl);
		curl_close($curl);
	} else {
		ini_set('user_agent', $ua);
		$content = file_get_contents($url);
	}
	return $content;
}

//fungsi untuk follow redirect
function get_final_url( $url, $timeout = 5 ){
	$url = str_replace( "&amp;", "&", urldecode(trim($url)) );
	$cookie = tempnam ("/tmp", "CURLCOOKIE");
	
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt( $ch, CURLOPT_ENCODING, "" );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
	curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
	curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
	$content = curl_exec( $ch );
	$response = curl_getinfo( $ch );
	curl_close ( $ch );

	if ($response['http_code'] == 301 || $response['http_code'] == 302){
		ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
		$headers = get_headers($response['url']);

		$location = "";
		foreach( $headers as $value ){
			if ( substr( strtolower($value), 0, 9 ) == "location:" )
				return get_final_url( trim( substr( $value, 9, strlen($value) ) ) );
		}
	}

	if (	preg_match("/window\.location\.replace\('(.*)'\)/i", $content, $value) ||
			preg_match("/window\.location\=\"(.*)\"/i", $content, $value)
	){
		return get_final_url ( $value[1] );
	}else{
		return $response['url'];
	}
}

//fungsi membersihkan karakter
function clean_character($content){
	$content = propdf_replaceSpecial($content);
	$a = array('”', '“', 'â€œ', 'â€', '‘', 'â€˜', 'â€', ' ™', '™', '¦', 'â€', 'Â½', 'Ã©', 'Ã', '¢', '•', 'ã', '—', '[', ']', 'â€™', '’', '–', '&#8211;', '&#8230;', '&#8220;', '&#8221;', '&#8217;', '&#038;', '&#8212;', '&#8216;', '&#8242;', '&#8243;', '&#8482;', '&#174;','&#39');
	$b = array('', '', '', '', '', '', ' ', "'", "'", '', '', ' 1/2', 'e', 'a', '-', '*', 'a', '-', '', '', "'", "'", '-', '-', '...', '"', '"', "'", '', '-', "'", "'", '"', '', '','');
	$content = str_replace($a, $b, $content);
	$content = preg_replace('/&#(.*?);/', ' ', $content);
	$content = htmlspecialchars_decode($content, ENT_QUOTES | ENT_HTML5);
	return $content;
}
function propdf_replaceSpecial($str){
	$chunked = str_split($str,1);
	$str = ""; 
	foreach($chunked as $chunk){
		$num = ord($chunk);
		// Remove non-ascii & non html characters
		if ($num >= 32 && $num <= 123){
				$str.=$chunk;
		}
	}   
	return $str;
}


//fungsi spintax
function spintax( $s )
{
    preg_match( "#{(.+?)}#is", $s, $m );
    if ( empty( $m) )
    {
        return $s;
    }
    $t = $m[1];
    if ( strpos( $t, "{" ) !== false )
    {
        $t = substr( $t, strrpos( $t, "{" ) + 1 );
    }
    $parts = explode( "|", $t );
    $s = preg_replace( "+{".preg_quote( $t )."}+is", $parts[array_rand( $parts )], $s, 1 );
    return spintax( $s );
}


//Fungsi Generate URL
function slugify($text)
{ 
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
}

/* Function Encode and Decode ID */

function enco($a,$b,$id){
$a = array("1","2","3","4","5","6","7","8","9","0");
$b = array("a","i","u","e","o","c","l","w","s","b");
$id = str_replace($a,$b,$id);
return $id;
}
function deco($a,$b,$id){
$a = array("a","i","u","e","o","c","l","w","s","b");
$b = array("1","2","3","4","5","6","7","8","9","0");

$id = str_replace($a,$b,$id);
return $id;
}


function randomDate($start_date, $end_date)
{
    // Convert to timetamps
    $min = strtotime($start_date);
    $max = strtotime($end_date);

    // Generate random number using above bounds
    $val = rand($min, $max);
	
    // Convert back to desired date format
    // return date('Y-m-d\TH:i:s\Z', $val);
    return gmdate('Y-m-d\TH:i:s+00:00', $val);
}

?>