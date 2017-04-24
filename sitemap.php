<?php
error_reporting(0);
include 'inc/simple_html_dom.php';
include 'inc/function.php';
include 'inc/connect.php';

if(isset($_GET['no'])){
  $page = $_GET['no'];
}else{
  header("HTTP/1.1 301 Moved Permanently"); 
  header("Location: ".$site_url);
  exit();
}
$start_date = date('Y-m-d');		//Tanggal Mulai (random)
$end_date = '2016-12-31';		//Tanggal Selesai (random)
// date_default_timezone_set($timezone);
header('Content-Type: text/xml');
header('X-Robots-Tag: noindex,follow,noarchive,notranslate,noodp', true);

echo '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="'.$site_url.'/inc/css-sitemap-single.xsl"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
     ';
$url = 'https://www.goodreads.com/list/show/1.Best_Books_Ever?page='.$page.'';
  $page++;
  $data = curl_init();
  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
  $header[] = "Cache-Control: max-age=0";
  $header[] = "Connection: keep-alive";
  $header[] = "Keep-Alive: 300";
  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $header[] = "Accept-Language: en-us,en;q=0.5";
  $header[] = "Pragma: "; // browsers keep this blank.
  curl_setopt($data, CURLOPT_SSL_VERIFYHOST, FALSE);
  curl_setopt($data, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($data, CURLOPT_URL, $url);
  curl_setopt($data, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
  curl_setopt($data, CURLOPT_HTTPHEADER, $header);
  curl_setopt($data, CURLOPT_REFERER, $hasil);
  curl_setopt($data, CURLOPT_ENCODING, 'gzip,deflate');
  curl_setopt($data, CURLOPT_AUTOREFERER, true);
  curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($data, CURLOPT_CONNECTTIMEOUT, 120);
  curl_setopt($data, CURLOPT_TIMEOUT, 120);
  curl_setopt($data, CURLOPT_MAXREDIRS, 5);
  $hasil = curl_exec($data);
  curl_close($data);
  $kode_id = explode('<tr itemscope itemtype="http://schema.org/Book">',$hasil);
  $hit_array = count($kode_id);
  unset($kode_id[0]);
  
  foreach($kode_id as $linke){
    $today = randomDate($start_date, $end_date);
    $id = cutter($linke,'<div id="','" class="u-anchorTarget">');
    $judule = cutter($linke,"<span itemprop='name'>",'</span>');
    $next = cutter($linke,'<a class="','" rel="next" href="');
    $selsai = cutter($linke,'<span class="','">');
    $judul = clean_character($judule);
    $url_judul = slugify($judul);
    $today = randomDate($start_date, $end_date);
	
  echo '<url>
      <loc>
        '.$site_url.'/'.$id.'.'.$url_judul.'.html
      </loc>
      <lastmod>'.$today.'</lastmod>
      <changefreq>Daily</changefreq>
      <priority>0.9</priority>
    </url>
    ';
}
echo '
</urlset>';


?>